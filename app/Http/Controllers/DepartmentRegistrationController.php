<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


use App\Dept;
use App\Http\Requests\StoreDept;

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
        $depts = Dept::all();
        return $depts;
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
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function show(Dept $dept,$id)
    {
      $dept = Dept::find($id);
      Session(['deptID'=>$id]);
      return view('dept.single',compact('dept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function edit(Dept $dept,$id)
    {
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
      return redirect('/home');
    }

    /**
     * Show the department reports.
     *
     * @param  \App\Dept  $dept
     * @return \Illuminate\Http\Response
     */
    public function report(Dept $dept,$id)
    {
      $dept = Dept::find($id);
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

}
