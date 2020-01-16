<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

use App\DeptSales;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Dept;
use App\Revenue;
use PDF;
use App\Mail\SalesReport;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
      $sortField='created_at';$sortValue='DESC';
      $status =' id != "" ';
      $sortBy = $request->filter_sort;
      $startDate = $request->filter_from != null ?  Carbon::create($request->filter_from) : null;
      $endDate = $request->filter_to != null ?  Carbon::create($request->filter_to) : null;
      if($sortBy)
      {
        if( $sortBy == 'oldNew' ){$sortField='created_at';$sortValue='ASC';}
        if( $sortBy == 'paidOnly' ){ $status ='saleAmountDue-saleAmountReceived <= 0'; }
        if( $sortBy == 'pendingOnly' ){ $status ='saleAmountDue-saleAmountReceived > 0'; }
        if( $sortBy == 'overPaidOnly' ){ $status ='saleAmountDue-saleAmountReceived < 0'; }
      }

      if(Session('deptID') != null ){
        $dept = Dept::find(Session('deptID'));
        if( $startDate && $endDate)
        {

          $sales = DeptSales::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }elseif($startDate){

          $sales = DeptSales::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }else{

          $sales = DeptSales::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }
        return view('sales.index',compact('sales','dept','sortBy','startDate','endDate'));
      }else{

        $sales = DeptSales::paginate(env('ITEMS_PER_PAGE',5));

      }

      return view('sales.index',compact('sales','sortBy','startDate','endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeptSales  $deptSales
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $sale = DeptSales::find($id);
        return view('sales.show',compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeptSales  $deptSales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = DeptSales::find($id);
        return view('sales.edit',compact($sale));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeptSales  $deptSales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
           'saleAmountReceived' => 'required|numeric',
           'modeOfPayment' => 'required|numeric',
           'remarks' => 'nullable',
         ]);

        $sale = DeptSales::find($id);

        $validated['saleAmountReceived'] = $sale->saleAmountReceived + $request->saleAmountReceived;

        if(!$sale->update($validated)){
          Session::flash('error', env("SAVE_SUCCESS_MSG","An error occured, please try again!"));
          return back();
        }

        $sale = $sale->refresh();

        if( $sale->saleAmountDue <= $validated['saleAmountReceived'] )
        {
          $sale->update(['paid'=>1]);
          Revenue::where('dept_sales_id',$sale->id)->update(['paid'=>1]);
        }

        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeptSales  $deptSales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $sale = DeptSales::find($id);
      if($sale->Revenue)
        Revenue::where('dept_sales_id',$sale->id)->delete();

      $sale->delete();

      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect(route('sale.index'));
    }

    public function download(Request $request)
    {
      $dt = Carbon::now();

      if($request->duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $sales= DeptSales::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $sales= DeptSales::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $sales= DeptSales::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }
        $sales= DeptSales::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $sales= DeptSales::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      }


      $docs = $sales;

      $pdf = PDF::loadView('pdf.sales-report',compact('docs','startDate','endDate'));
      return $pdf->download();
    }

    public function share(Request $request)
    {
      $request->validate([
        'email' => 'required|email|max:255',
        'duration_sort' => 'required|max:255',
        'filter_from' => 'nullable|max:255',
        'filter_to' => 'nullable|max:255',
      ]);

      $email = $request->email;
      $duration_sort =$request->duration_sort;
      $filter_from =$request->filter_from;
      $filter_to = $request->filter_to;

      //send email
      $pathToPDF = $this->tmp_pdf_path($duration_sort,$filter_from,$filter_to);
      Mail::to($email)->queue(new SalesReport($pathToPDF));
      unlink($pathToPDF);
      return 1;
    }

    public function tmp_pdf_path($duration_sort,$filter_from,$filter_to)
    {
      $dt = Carbon::now();

      if($duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $sales= DeptSales::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $sales= DeptSales::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $sales= DeptSales::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($filter_from != ''){ $startDate = Carbon::create($filter_from);}
        $endDate = Carbon::now();
        if($filter_to != ''){ $endDate =Carbon::create($filter_to); }
        $sales= DeptSales::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $sales= DeptSales::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      }


      $docs = $sales;
      $pdf = PDF::loadView('pdf.sales-report',compact('docs','startDate','endDate'));
      $pdf->save('doc-'.$dt.'.pdf');
      $pathToPDF = 'doc-'.$dt.'.pdf';
      return $pathToPDF;
    }
}
