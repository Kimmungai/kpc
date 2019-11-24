<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeptServices;

class DepartmentAjaxController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  /*
  *Add a department services
  */
  public function add_service(Request $request)
  {
    $request->validate([
      'service' => 'required',
      'cost' => 'required|numeric',
      'dept_id' => 'required|numeric',
    ]);

    $service = DeptServices::create($request->all());

    return $service;
  }

  /*
  *Remove a department services
  */
  public function remove_service(Request $request)
  {
    $request->validate([
      'service_id' => 'required|numeric',
    ]);

    DeptServices::where('id',$request->service_id)->delete();

    return 1;
  }

}
