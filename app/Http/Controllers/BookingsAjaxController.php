<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingAjax;
use App\Booking;
use App\Revenue;

class BookingsAjaxController extends Controller
{
    public function save_booking( StoreBookingAjax $request )
    {
      //create booking
      $bookingData = $request->except(['bookedProds']);
      if($bookingData['meetingHall'] == 'true'){ $bookingData['meetingHall'] = 1;}else{$bookingData['meetingHall'] = 0;}
      if($bookingData['tent'] == 'true'){ $bookingData['tent'] = 1;}else{$bookingData['tent'] = 0;}
      if($bookingData['paSystem'] == 'true'){ $bookingData['paSystem'] = 1;}else{$bookingData['paSystem'] = 0;}
      if($bookingData['projector'] == 'true'){ $bookingData['projector'] = 1;}else{$bookingData['projector'] = 0;}

      $booking = Booking::create($bookingData);

      //create revenue
      $revenueData = $request->bookedProds;
      //return $revenueData[0]['id'];
      foreach( $revenueData as $revenueDatum )
      {
        //return $revenueData[0][0];
        $revenue = new Revenue;
        $revenue->booking_id = $booking->id;
        $revenue->product_id = $revenueDatum['id'];
        $revenue->bookedQuantity = $revenueDatum['price'];
        $revenue->price = $revenueDatum['qty'];
        $revenue->save();
      }

      if( $booking )
        return 1;
      return 0;
    }
}
