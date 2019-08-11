<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Mail\BookingMail;
use App\Http\Requests\StoreBookingAjax;
use App\Booking;
use App\Revenue;
use App\Product;
use PDF;
class BookingsAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
      if($revenueData == ''){$revenueData=[];}
      //return $revenueData[0]['id'];
      foreach( $revenueData as $revenueDatum )
      {
        //return $revenueData[0][0];
        $revenue = new Revenue;
        $revenue->booking_id = $booking->id;
        $revenue->product_id = $revenueDatum['id'];
        $revenue->bookedQuantity = $revenueDatum['qty'];
        //reduce stock
        $this->reduceStock( $revenueDatum['id'], $revenueDatum['qty']);
        $revenue->price = $revenueDatum['price'];
        $revenue->save();
      }

      if( $booking )
      {
        //send email
        $doc = $booking;
        $pdf = PDF::loadView('pdf.booking-report',compact('doc'));
        $pathToPDF = 'doc-'.$doc->id.'.pdf';
        $pdf->save($pathToPDF);
        Mail::to(env('ADMIN_EMAIL','kimpita9@gmail.com'))->send(new BookingMail($pathToPDF));
        unlink($pathToPDF);
        return 1;
      }
      return 0;
    }

    public function update_booking( StoreBookingAjax $request )
    {
      //create booking
      $bookingID = $request->bookingID;
      $bookingData = $request->except(['bookedProds','_token','bookingID']);
      if($bookingData['meetingHall'] == 'true'){ $bookingData['meetingHall'] = 1;}else{$bookingData['meetingHall'] = 0;}
      if($bookingData['tent'] == 'true'){ $bookingData['tent'] = 1;}else{$bookingData['tent'] = 0;}
      if($bookingData['paSystem'] == 'true'){ $bookingData['paSystem'] = 1;}else{$bookingData['paSystem'] = 0;}
      if($bookingData['projector'] == 'true'){ $bookingData['projector'] = 1;}else{$bookingData['projector'] = 0;}

      $booking = Booking::where('id',$bookingID)->update($bookingData);
      //return 'nyauuus';
      //delete revenue records
      Revenue::where('booking_id',$bookingID)->forceDelete();

      //create revenue afresh
      $revenueData = $request->bookedProds;
      if($revenueData == ''){$revenueData=[];}

      //return $revenueData[0]['id'];

      foreach( $revenueData as $revenueDatum )
      {
        //return $revenueData[0][0];
        $revenue = new Revenue;
        $revenue->booking_id = $bookingID;
        $revenue->product_id = $revenueDatum['id'];
        $revenue->bookedQuantity = $revenueDatum['qty'];
        $revenue->price = $revenueDatum['price'];
        $revenue->save();
      }

      if( $booking )
      {
        return 1;
      }

      return 0;
    }

    protected function reduceStock($prodId, $reduceQty)
    {
      $product = Product::find($prodId);
      $newQuantity = $product->quantity - $reduceQty;
      if(Product::where('id',$prodId)->update(['quantity'=>$newQuantity]))
      {
        return true;
      }
      return false;
    }

    public function share(Request $request)
    {
      $request->validate([
        'email' => 'required|email|max:255',
        'id' => 'required|numeric',
      ]);

      $email = $request->email;
      $booking = Booking::find($request->id);

      //send email
      $doc = $booking;
      $pdf = PDF::loadView('pdf.booking-report',compact('doc'));
      $pathToPDF = 'doc-'.$doc->id.'.pdf';
      $pdf->save($pathToPDF);
      Mail::to($email)->send(new BookingMail($pathToPDF));
      unlink($pathToPDF);
      return 1;
    }


}
