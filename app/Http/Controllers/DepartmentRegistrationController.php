<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Dept;
use App\Http\Requests\StoreDept;
use Auth;

class DepartmentRegistrationController extends Controller
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
    public function index()
    {
        Session::flash('message', 'Please select a department');
        return redirect('/');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dept.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDept $request)
    {
        $validated = $request->validated();
        $validated = $this->uploads($request,$validated);
        $newUser = Dept::create($validated);
        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function show(Dept $dept,$id)
    {
      $dept = Dept::where('id',$id)->with(['booking' => function($query) {
        $query->whereMonth('created_at', Carbon::now()->month);
      }])->with(['purchase' => function($query) {
        $query->whereMonth('created_at', Carbon::now()->month);
      }])->first();

      Session(['deptID'=>$id]);
      if( $this->canViewDept( $id,Auth::user() ) )
      {
        return view('dept.single',compact('dept'));
      }
      else
      {
        Session::flash('error', "Sorry you are not allowed to perform that operatin. Contact administrator.");
        return redirect('/');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function edit(Dept $dept,$id)
    {
      if( Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 5 )
      {
        Session::flash('error', "Sorry you are not allowed to perform that operatin. Contact administrator.");
        return redirect(route('dept-registration.show', Auth::user()->dept ));
      }

      $dept = Dept::find($id);
      Session(['deptID'=>$id]);
      return view('dept.edit',compact('dept'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDept $request, Dept $dept, $id)
    {
      $validated = $request->validated();
      $validated = $this->uploads($request,$validated);
      $updatedDept = Dept::where('id',$id)->update($validated);
      Session::flash('message', env("SAVE_SUCCESS_MSG","Details updated succesfully!"));
      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dept $dept, $id)
    {
      $dept = Dept::find($id);
      $dept->delete();
      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect('/');
    }

    /**
     * Show the department reports.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function report(Dept $dept,$id,Request $request)
    {
      if( Auth::user()->type == 1 || Auth::user()->type == 2 || Auth::user()->type == 4 || Auth::user()->type == 5 )
      {
        Session::flash('error', "Sorry you are not allowed to perform that operatin. Contact administrator.");
        return redirect(route('dept-registration.show', Auth::user()->dept ));
      }

      $id = $request->id;
      $dt = Carbon::now();
      if( count($request->all()) )
      {

        if($request->duration_sort === 'thisWeek'){

          $dept = Dept::where('id',$id)->with(['purchase' => function($query) use ($dt){
            $query->whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC');
          }])->with(['booking' => function($query) use ($dt){
            $query->whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC');
          }])->with(['product' => function($query) use ($dt){
            $query->whereDate('created_at','>=', $dt->startOfWeek())->whereDate('created_at','<=', $dt->endOfWeek())->orderBy('created_at','DESC');
          }])->first();
          return view('dept.report',compact('dept'));
        }
        if($request->duration_sort === 'thisYear') {
          $dept = Dept::where('id',$id)->with(['purchase' => function($query) use ($dt) {
            $query->whereYear('created_at', $dt->year )->orderBy('created_at','DESC');
          }])->with(['booking' => function($query) use ($dt){
            $query->whereYear('created_at', $dt->year)->orderBy('created_at','DESC');
          }])->with(['product' => function($query) use ($dt){
            $query->whereYear('created_at', $dt->year)->orderBy('created_at','DESC');
          }])->first();
          return view('dept.report',compact('dept'));
        }
        if($request->duration_sort === 'today'){
          $dept = Dept::where('id',$id)->with(['purchase' => function($query) use ($dt){
            $query->whereDay('created_at', $dt->day )->orderBy('created_at','DESC');
          }])->with(['booking' => function($query) use ($dt){
            $query->whereDay('created_at', $dt->day)->orderBy('created_at','DESC');
          }])->with(['product' => function($query) use ($dt){
            $query->whereDay('created_at', $dt->day)->orderBy('created_at','DESC');
          }])->first();
          return view('dept.report',compact('dept'));
        }
      }
      if($request->duration_sort === 'dates'){
        $startDate = Carbon::now()->startOfMonth();
        if($request->filter_from != ''){ $startDate = Carbon::create($request->filter_from);}
        $endDate = Carbon::now();
        if($request->filter_to != ''){ $endDate =Carbon::create($request->filter_to); }
        $dept = Dept::where('id',$id)->with(['purchase' => function($query) use ($request,$startDate,$endDate){
          $query->whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC');
        }])->with(['booking' => function($query)  use ($request,$startDate,$endDate){
          $query->whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC');
        }])->with(['product' => function($query)  use ($request,$startDate,$endDate) {
          $query->whereDate('created_at','>=', $startDate)->whereDate('created_at','<=', $endDate)->orderBy('created_at','DESC');
        }])->first();
        return view('dept.report',compact('dept'));
      }

      $dept = Dept::where('id',$id)->with(['purchase' => function($query) use ($dt) {
        $query->whereMonth('created_at', $dt->month )->orderBy('created_at','DESC');
      }])->with(['booking' => function($query) use ($dt) {
        $query->whereMonth('created_at', $dt->month)->orderBy('created_at','DESC');
      }])->with(['product' => function($query) use ($dt) {
        $query->whereMonth('created_at', $dt->month)->orderBy('created_at','DESC');
      }])->first();
      return view('dept.report',compact('dept'));
    }


    /**
     * Upload new user files.
     *
     * @param  \App\Dept  $dept
     * @return validated user with image urls
     */
    private function uploads($request,$deptData)
    {
      if( $request->hasFile('avatar') )
      {
        $storageLoc = env('AVATAR_STORAGE_LOC','public/depts/'.$request->input('type').'/pictures');
        $deptData['avatar'] = $this->handleFileUpload($storageLoc,$request);
      }
      return $deptData;
    }

    /*
    *Function to upload files
    */
    private function handleFileUpload($storageLoc,$request,$value='avatar')
    {
      $image = $request->file($value);
      $name = time().'.'.$image->getClientOriginalExtension();
      $image->move($storageLoc, $name);
      return asset($storageLoc.'/'.$name);
    }

    protected function canViewDept($deptID,$user)
    {
      if( $user->type == -1 ){//if super admin allow
        return true;
      }else{
        if( $user->dept == $deptID ){//if user registered in that dept allow
          return true;
        }
      }
      return false;
    }

}
