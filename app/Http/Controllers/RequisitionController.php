<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Requisition;
use App\RequisitionProducts;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequisition;
use App\Dept;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dept = Dept::find(Session('deptID'));
        return view('requisition.create',compact('dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequisition $request)
    {
        $data = $request->only([
          'dept_id',
          'request_by',
          'vat_percent',
          'vat_total',
          'description',
          'company_name',
          'company_addr',
          'company_city',
          'doc_title',
          'supplier_name',
          'requisition_number',
          'supplier_addr',
          'supplier_phone',
          'req_subtotal',
          'req_grandtotal',
          'no_products',
        ]);
       $requisition = Requisition::create($data);
       $this->save_requisition_products( $request, $requisition->id );
       Session::flash('message', "Requisition form submitted succesfully!");
       return redirect(route('product-registration.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }

    /**
    *Save products associated to a given requisition
    *
    *@param $request
    *@return $success or $fail
    */
    private function save_requisition_products( $request, $requisition_id )
    {
      $no_prods = $request->no_products;

      for( $i = 1; $i <= $no_prods; $i++ )
      {
        //first check wether sale price, cost and quantities have been specified
        if( $request['col-'.$i.'-3'] == null || $request['col-'.$i.'-4'] == null || $request['col-'.$i.'-5'] == null ){continue;}

        $new_prod = new RequisitionProducts;
        $new_prod->requisition_id = $requisition_id;
        $new_prod->name = $request['col-'.$i.'-1'];
        $new_prod->description = $request['col-'.$i.'-2'];
        $new_prod->price = $request['col-'.$i.'-3'];
        $new_prod->cost = $request['col-'.$i.'-4'];
        $new_prod->quantity = $request['col-'.$i.'-5'];
        $new_prod->save();
      }

    }
}
