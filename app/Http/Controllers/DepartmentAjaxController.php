<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeptServices;
use App\DeptRooms;
use App\DeptBookingTypes;
use App\DeptMenu;
use App\Dept;

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

  /*
  *Add a department room type
  */
  public function add_room(Request $request)
  {
    $request->validate([
      'type' => 'required',
      'price' => 'required|numeric',
      'dept_id' => 'required|numeric',
    ]);

    $room = DeptRooms::create($request->all());

    return $room;
  }

  /*
  *update department's has room column
  */
  public function update_has_room(Request $request)
  {
    $request->validate([
      'has_rooms' => 'required|numeric',
      'dept_id' => 'required|numeric',
    ]);

    return Dept::where('id',$request->dept_id)->update(['has_rooms' => $request->has_rooms]);

  }

  /*
  *Remove a department room type
  */
  public function remove_room(Request $request)
  {
    $request->validate([
      'room_id' => 'required|numeric',
    ]);

    DeptRooms::where('id',$request->room_id)->delete();

    return 1;
  }

  /*
  *Add booking type to department
  */
  public function add_booking_type( Request $request )
  {
    $request->validate([
      'type' => 'required',
      'price' => 'required|numeric',
      'dept_id' => 'required|numeric',
    ]);

    $type = DeptBookingTypes::create($request->all());

    return $type;

  }

  /*
  *Remove a department booking type
  */
  public function remove_booking_type(Request $request)
  {
    $request->validate([
      'booking_type_id' => 'required|numeric',
    ]);

    DeptBookingTypes::where('id',$request->booking_type_id)->delete();

    return 1;
  }

  /*
  *Add a department food menu
  */
  public function add_menu(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'price' => 'required|numeric',
      'dept_id' => 'required|numeric',
    ]);

    $type = DeptMenu::create($request->all());

    return $type;
  }

  /*
  *Remove a department menu
  */
  public function remove_menu(Request $request)
  {
    $request->validate([
      'menu_id' => 'required|numeric',
    ]);

    DeptMenu::where('id',$request->menu_id)->delete();

    return 1;
  }


}
