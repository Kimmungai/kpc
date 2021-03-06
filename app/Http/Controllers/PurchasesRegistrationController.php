<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StorePurchase;
use App\Purchase;
use App\Expense;
use App\Product;
use App\Dept;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class PurchasesRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortField='created_at';$sortValue='DESC';
        $status =' id != "" ';
        $sortBy = $request->filter_sort;
        $startDate = $request->filter_from != null ?  Carbon::create($request->filter_from) : null;
        $endDate = $request->filter_to != null ?  Carbon::create($request->filter_to) : null;
        if($sortBy)
        {
          if( $sortBy == 'oldNew' ){$sortField='created_at';$sortValue='ASC';}
          if( $sortBy == 'paidOnly' ){ $status ='amountDue-amountPaid <= 0'; }
          if( $sortBy == 'pendingOnly' ){ $status ='amountDue-amountPaid > 0'; }
          if( $sortBy == 'overPaidOnly' ){ $status ='amountDue-amountPaid < 0'; }
        }

        if(Session('deptID') != null ){
          $dept = Dept::find(Session('deptID'));
          if( $startDate && $endDate)
          {

            $purchases = Purchase::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

          }elseif($startDate){

            $purchases = Purchase::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

          }else{

            $purchases = Purchase::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

          }
          return view('purchases.index',compact('purchases','dept','sortBy','startDate','endDate'));
        }else{

          $purchases = Purchase::paginate(env('ITEMS_PER_PAGE',5));

        }

        return view('purchases.index',compact('purchases','sortBy','startDate','endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session('deptID') == null )
        {
          Session::flash('error', 'Please select a department');
          return redirect('/');
        }
        $dept = Dept::find(Session('deptID'));
        return view('purchases.create',compact('dept'));
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
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase, $id)
    {
        $purchase = Purchase::with(['user','expense.product'])->where('id',$id)->first();
        $dept = Dept::find(Session('deptID'));
        return view('purchases.show',compact('purchase','dept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase, $id)
    {
      $purchase = Purchase::with(['user','expense.product'])->where('id',$id)->first();
      $dept = Dept::find(Session('deptID'));
      return view('purchases.edit',compact('purchase','dept'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $validated = $request->validate([
          'amountPaid' => 'required|numeric',
          'paymentMethod' => 'required|numeric',
          'remarks' => 'nullable',
        ]);

        $purchase = Purchase::find($id);

        $validated['amountPaid'] = $purchase->amountPaid + $request->amountPaid;

        if(!$purchase->update($validated)){
          Session::flash('error', env("SAVE_SUCCESS_MSG","An error occured, please try again!"));
          return back();
        }

        $purchase = $purchase->refresh();

        if( $purchase->amountDue <= $validated['amountPaid'] )
        {
          $purchase->update(['paid'=>1]);
          Expense::where('purchase_id',$purchase->id)->update(['paid'=>1]);
        }

        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase,$id)
    {
      $purchase = Purchase::find($id);
      Expense::where('purchase_id',$id)->forceDelete();
      Product::where('purchases_id',$id)->forceDelete();
      $purchase->forceDelete();
      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect('/purchases-registration');
    }

    public function download($id)
    {
      $doc = Purchase::find($id);
      $pdf = PDF::loadView('pdf.purchase-report',compact('doc'));
      return $pdf->download();
    }
}
