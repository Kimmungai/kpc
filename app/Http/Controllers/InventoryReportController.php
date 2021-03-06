<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use App\Product;
use Illuminate\Http\Request;
use App\Mail\InventoryReport;
use Carbon\Carbon;
use PDF;
class InventoryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $inventory = Product::all();
      return view('Reports.inventory-report',compact('inventory'));
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function report(Request $request)
    {
      $dt = Carbon::now();
      if( count($request->all()) )
      {

        if($request->duration_sort === 'thisWeek'){
          $inventory= Product::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
          return view('Reports.inventory-report',compact('inventory'));
        }
        if($request->duration_sort === 'thisYear') {
          $inventory= Product::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
          return view('Reports.inventory-report',compact('inventory'));
        }
        if($request->duration_sort === 'today'){
          $inventory= Product::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
          return view('Reports.inventory-report',compact('inventory'));
        }
      }
      if($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }

        $inventory= Product::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
        return view('Reports.inventory-report',compact('inventory'));
      }

      return redirect(route('inventory-report.index'));
    }

    public function download(Request $request)
    {
      $dt = Carbon::now();

      if($request->duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $products= Product::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $products= Product::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $products= Product::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }
        $products= Product::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $products= Product::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      }

      $docs = $products;
      $pdf = PDF::loadView('pdf.all-inventory-report',compact('docs','startDate','endDate'));
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
      Mail::to($email)->queue(new InventoryReport($pathToPDF));
      unlink($pathToPDF);
    }

    public function tmp_pdf_path($duration_sort,$filter_from,$filter_to)
    {
      $dt = Carbon::now();

      if($duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->copy()->endOfWeek();
        $products= Product::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->copy()->endOfYear();
        $products= Product::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->copy()->today();
        $products= Product::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
      }
      elseif($duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($filter_from != ''){ $startDate = Carbon::create($filter_from);}
        $endDate = Carbon::now();
        if($filter_to != ''){ $endDate =Carbon::create($filter_to); }
        $products= Product::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->copy()->endOfMonth();
        $products= Product::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      }

      $docs = $products;
      $pdf = PDF::loadView('pdf.all-inventory-report',compact('docs','startDate','endDate'));
      $pathToPDF = 'doc-'.$dt.'.pdf';
      $pdf->save($pathToPDF);
      return $pathToPDF;
    }
}
