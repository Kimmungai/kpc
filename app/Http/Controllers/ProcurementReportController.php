<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Purchase;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
class ProcurementReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dt = Carbon::now();
      $purchases= Purchase::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      return view('Reports.procurement-report',compact('purchases'));
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
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
    public function report(Request $request)
    {
      $dt = Carbon::now();
      if( count($request->all()) )
      {

        if($request->duration_sort === 'thisWeek'){
          $purchases= Purchase::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
          return view('Reports.procurement-report',compact('purchases'));
        }
        if($request->duration_sort === 'thisYear') {
          $purchases= Purchase::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
          return view('Reports.procurement-report',compact('purchases'));
        }
        if($request->duration_sort === 'today'){
          $purchases= Purchase::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
          return view('Reports.procurement-report',compact('purchases'));
        }
      }
      if($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }

        $purchases= Purchase::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
        return view('Reports.procurement-report',compact('purchases'));
      }

      return redirect(route('procurement-report.index'));
    }

    public function download(Request $request)
    {
      $dt = Carbon::now();

      if($request->duration_sort === 'thisWeek'){
        $startDate =$dt->startOfWeek();
        $endDate = $dt->endOfWeek();
        $purchases= Purchase::whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'thisYear') {
        $startDate =$dt->startOfYear();
        $endDate = $dt->endOfYear();
        $purchases= Purchase::whereYear('created_at', $dt->year)->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'today'){
        $startDate =$dt->today();
        $endDate = $dt->today();
        $purchases= Purchase::whereDay('created_at', $dt->day )->orderBy('created_at','DESC')->get();
      }
      elseif($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }
        $purchases= Purchase::whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC')->get();
      }
      else {
        $startDate =$dt->startOfMonth();
        $endDate = $dt->endOfMonth();
        $purchases= Purchase::whereMonth('created_at', $dt->month)->orderBy('created_at','DESC')->get();
      }


      $docs = $purchases;
      $pdf = PDF::loadView('pdf.all-purchases-report',compact('docs','startDate','endDate'));
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
      return 'proc'.$duration_sort;
    }

}
