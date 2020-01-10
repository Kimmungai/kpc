<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Expense;
use App\Dept;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
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
        if( $sortBy == 'paidOnly' ){ $status ='balance <= 0'; }
        if( $sortBy == 'pendingOnly' ){ $status ='balance > 0'; }
        if( $sortBy == 'overPaidOnly' ){ $status ='balance < 0'; }
      }

      if(Session('deptID') != null ){
        $dept = Dept::find(Session('deptID'));
        if( $startDate && $endDate)
        {

          $expenses = Expense::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }elseif($startDate){

          $expenses = Expense::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }else{

          $expenses = Expense::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }
        return view('expenditure.index',compact('expenses','dept','sortBy','startDate','endDate'));
      }else{

        $expenses = Expense::paginate(env('ITEMS_PER_PAGE',5));

      }

      return view('expenditure.index',compact('expenses','sortBy','startDate','endDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $dept = Dept::find(Session('deptID'));
      return view('expenditure.create',compact('dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validated = $this->validate_revenue($request);
      $validated['balance'] = $validated['amountDue'] - $validated['amountPaid'];

      if( $validated['balance'] <= 0 )
        $validated['paid'] = 1;
      else
        $validated['paid'] = 0;


      $expense = Expense::create($validated);
      Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
      return redirect(route('expenditure.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $expense = Expense::find( $id );
        $dept = Dept::find(Session('deptID'));
        return view('expenditure.show',compact('dept','expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
      $expense = Expense::find( $id );
      $dept = Dept::find(Session('deptID'));
      return view('expenditure.edit',compact('dept','expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        $validated = $this->validate_revenue($request);
        $validated['amountPaid'] += $expense->amountPaid;
        $validated['balance'] = $validated['amountDue'] - $validated['amountPaid'];

        if( $validated['balance'] <= 0 )
          $validated['paid'] = 1;
        else
          $validated['paid'] = 0;


        $expense->update($validated);
        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
      $expense = Expense::find($id);
      $expense->forceDelete();
      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect(route('expenditure.index'));
    }

    /**
    *Validate revenue request data
    *
    *@param $request
    *@return $validated
    */
    private function validate_revenue($request)
    {
      $validated = $request->validate([
         'title' => 'required',
         'dept_id' => 'required|numeric',
         'description' => 'nullable',
         'amountDue' => 'required|numeric',
         'amountPaid' => 'nullable|numeric',
         'paymentDueDate' => 'nullable',
         'modeOfPayment' => 'nullable|numeric',
         'transactionCode' =>'nullable'
       ]);
      return $validated;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function expense_payment(Request $request, Expense $expense)
    {
      $validated = $request->validate([
         'amountPaid' => 'required|numeric',
         'modeOfPayment' => 'nullable|numeric',
         'transactionCode' =>'nullable'
       ]);
      $validated['amountPaid'] += $expense->amountPaid;
      $validated['balance'] = $expense->amountDue - $validated['amountPaid'];

      if( $validated['balance'] <= 0 )
        $validated['paid'] = 1;
      else
        $validated['paid'] = 0;


      $expense->update($validated);
      Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
      return back();
    }
}
