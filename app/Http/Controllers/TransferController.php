<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Notifications\NewTransfer;
use Illuminate\Http\Request;
use App\Dept;
use App\User;
use App\Product;
use Auth;
use Notification;
class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dept = Dept::find($id);
        return view('transfer.index',compact('dept'));
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
      $request->validate([
        'fromDept' => 'required|numeric',
        'toDept' => 'required|numeric',
        'no_products' => 'required|numeric',
        'comments' => 'nullable',
      ]);

      $this->loop_transfer_products( $request );

      $destinationDeptID = $request->toDept;



      Session::flash('message', env("SAVE_SUCCESS_MSG","Details saved succesfully!"));
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    *Save other products booked
    *
    *@param $request
    *@return $success or $fail
    */
    private function loop_transfer_products( $request )
    {

      $no_prods = $request->no_products;



      for( $i = 1; $i <= $no_prods; $i++ )
      {
        if( !$request->has( 'col_'.$i.'_7' ) ){$no_prods++;continue;}

        $transferProd = [];
        $transferProd['id'] = $request['col_'.$i.'_7'];
        $transferProd['qty'] = $request['col_'.$i.'_4'];
        $transferProd['price'] = $request['col_'.$i.'_5'];

        $this->transferProducts($request->fromDept, $request->toDept, $transferProd);


      }

      //notify Admin, Staff, super admin
      $authorisedUsers = [-1,1,3];
      $subscribedUsers = User::whereIn('type',$authorisedUsers)->where('id','<>',Auth::id())->where('receive_notifications',1)->get();
      $dept = Dept::find($request->toDept);
      $booker = Auth::user();
      $this->send_notifications( $subscribedUsers, $dept, $no_prods,$booker, $request->comments );

    }

    protected function transferProducts($originDeptID, $destinationDeptID, $transferProd)
    {
      $product = Product::find($transferProd['id']);

      //check if a product exists in destination department
      $check = Product::where('sku',$product->sku)->where('dept_id',$destinationDeptID)->count();

      if( !$check )
      {

        //create product and update quantity
        $newProduct = $product->replicate();
        $newProduct->dept_id = $destinationDeptID;
        $newProduct->quantity = $transferProd['qty'];
        $newProduct->price = $transferProd['price'];
        $newProduct->save();
        $newQuantity = $product->quantity - $transferProd['qty'];
        Product::where('id',$transferProd['id'])->update(['quantity' => $newQuantity]);

      }else{

        $oldQuantity = $product->quantity - $transferProd['qty'];

        $newProduct = Product::where('sku',$product->sku)->where('dept_id',$destinationDeptID)->first();

        $newQuantity = $newProduct->quantity + $transferProd['qty'];

        Product::where('id',$transferProd['id'])->update(['quantity' => $oldQuantity]);
        Product::where('sku',$product->sku)->where('dept_id',$destinationDeptID)->update([ 'quantity' => $newQuantity,'price' =>$transferProd['price'] ]);

      }



    }

    /**
    *Send users subscribed users notifications
    *
    *@param $subscribedUsers
    */
    private function send_notifications( $subscribedUsers, $dept, $no_prods,$booker,$comments )
    {
      $avatar = url('/images/avatar-female.png');

      if( $booker->avatar ){
        $avatar = $booker->avatar;
      }else {
        if( $booker->gender == 1 )
        {
          $avatar = url('/images/avatar-male.png');
        }
      }

      $details = [
                   'greeting' => 'Hi,',
                   'subject' => $no_prods.' item(s) transfered to '.$dept->name.' department',
                   'body' => 'A new transfer of '.$no_prods.' item(s) has been succesfully made to '.$dept->name.' department. The transfer has been facilitaed by '.$booker->name,
                   'comments' => 'Comments by '.$booker->name.': '.$comments,
                   'thanks' => 'Thank you for using Kitui Pastoral Center system',
                   'actionText' => 'View department',
                   'actionURL' => url( '/'),
                   'dept_name' => $dept->name,
                   'booker_name' => $booker->name,
                   'booker_avatar' => $avatar,
               ];

      Notification::send($subscribedUsers, new NewTransfer($details));
    }
}
