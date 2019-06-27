<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Http\Requests\StoreUser;

class UserRegistrationController extends Controller
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
    public function index($type=0)
    {
        if( $type ){ $users = User::where('type',$type)->get(); }else{ $user = User::all(); }
        return view('user.all',compact('users','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $validated = $request->validated();
        $validated = $this->uploads($request,$validated);
        $validated['password'] = Hash::make($validated['password']);
        $newUser = User::create($validated);
        Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
      $user = User::find($id);
      return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, User $user, $id)
    {
      $validated = $request->validated();
      $validated = $this->uploads($request,$validated);
      if( $request->input('password') != null )
      {
        $validated['password'] = Hash::make($validated['password']);
      }
      else{
        unset($validated['password']);
      }
      $updatedUser = User::where('id',$id)->update($validated);
      Session::flash('message', env("SAVE_SUCCESS_MSG","Details updated succesfully!"));
      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {
        $user = User::find($id);
        $user->forceDelete();
        Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
        return redirect('/users');
    }

    /**
     * Upload new user files.
     *
     * @param  \App\User  $user
     * @return validated user with image urls
     */
    private function uploads($request,$userData)
    {
      if( $request->hasFile('avatar') )
      {
        $storageLoc = env('AVATAR_STORAGE_LOC','public/users/'.$request->input('type').'/pictures');
        $userData['avatar'] = $this->handleFileUpload($storageLoc,$request);
      }
      if( $request->hasFile('idImage') )
      {
        $storageLoc = env('ID_STORAGE_LOC','public/users/'.$request->input('type').'/ids');
        $userData['idImage'] = $this->handleFileUpload($storageLoc,$request,'idImage');
      }
      if( $request->hasFile('passportImage') )
      {
        $storageLoc = env('PASSPORT_STORAGE_LOC','public/users/'.$request->input('type').'/passports');
        $userData['passportImage'] = $this->handleFileUpload($storageLoc,$request,'passportImage');
      }
      return $userData;
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
