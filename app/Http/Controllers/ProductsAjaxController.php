<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Validator;
use App\Product;
use App\Expense;
use App\Revenue;
use App\DeptSales;
use Carbon\Carbon;

class ProductsAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_product(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'sku' => 'required|max:255|unique:products',
        'name' => 'required|max:255',
        'quantity' => 'required|numeric',
        'cost' => 'required|numeric',
        'purchases_id' => 'required|numeric',
        'dept_id' => 'required|numeric',
      ]);

      if ($validator->fails()) {
          return response()->json($validator->errors());
      }

      $product = new Product;
      $product->sku = $request->sku;
      $product->name = $request->name;
      $product->quantity = $request->quantity;
      $product->price = $request->cost;
      $product->purchases_id = $request->purchases_id;
      $product->dept_id = $request->dept_id;
      $product->save();

      $expense = new Expense;
      $expense->purchase_id = $request->purchases_id;
      $expense->product_id = $product->id;
      $expense->cost = $request->cost;
      $expense->suppliedQuantity = $request->quantity;
      $expense->save();
      $data[0] = $product;
      return $data;
    }

    public function search_product( Request $request )
    {
      $string = $request->string;
      $deptID = $request->deptID;
      $products = Product::where('dept_id',$deptID)->where('name', 'LIKE',  $string . '%')->get();
      //$users = User::where('firstName', 'LIKE',  $string . '%')->get();
      return $products;
    }

    public function get_product(Request $request)
    {
      $id = $request->prodID;
      $purchase_id = $request->purchaseID;
      if( $id && $purchase_id)
      {
        $product = Product::find($id);
        //$expense = Expense::where('purchase_id',$purchase_id)->first();
        //$expense->purchase_id = $purchase_id;

        //$expense->update(['product_id'=>$product->id]);
        $expense = new Expense;
        $expense->purchase_id = $purchase_id;
        $expense->product_id = $product->id;
        $expense->save();

        $data[0] = $product;
        $data[1] = $expense;
        return $data;

      }elseif( $id ){

        return $product = Product::find($id);

      }
    }

    public function update_product( Request $request )
    {
      $id = $request->product_id;

      $field = $request->field;
      $value = $request->value;
      $purchase_id = $request->purchaseID;


      if( $id )
      {
        $product = Product::find($id);
        if( ($field ==='bookedQuantity') && ($product->quantity < $value) )
        {
          return 0;
        }
        if( $field ==='suppliedQuantity' )
        {
          Product::where('id',$id)->update([
            'quantity' => ($product->quantity + $value)
          ]);
          return Expense::where('purchase_id',$purchase_id)->where('product_id',$id)->update([
            $field => $value
          ]);
        }else if($field === 'cost'){
          return Expense::where('purchase_id',$purchase_id)->where('product_id',$id)->update([
            $field => $value
          ]);
       }else{
         return Product::where('id',$id)->update([
           $field => $value
         ]);
       }

      }
      return 0;
    }

    /*
    *Function to search for product using its id and returning its object
    */
    public function find_product(Request $request)
    {
      $id = $request->prodID;
      if( $id )
      {
        return $product = Product::find($id);
      }
    }

    /*
    *Function to save save cart contents to cookie
    */
    public function save_cart(Request $request)
    {

      $cartContents = $request->cart_contents;

      if( !is_array( $cartContents ) )
        $cartContents = [];

      session([ 'cart_contents',[] ]);

      $newCartContents = [];

      foreach ($cartContents as $cartContent ) {
        $newCartContents []= $cartContent;
      }

      session(['cart_contents' => $newCartContents]);

      return 1;
    }

    /*
    *Function to record a sale
    */
    function make_sale( Request $request )
    {
      $request->validate([
        'customerID' => 'required|numeric',
        'saleAmountReceived' => 'nullable|numeric',
        'saleAmountDue' => 'required|numeric',
        'modeOfPayment' => 'required|numeric',
        'transactionCode' => 'nullable',
        'dept_id' => 'required|numeric',
      ]);

      $sale = DeptSales::create($request->all());
      if( $request->saleAmountDue <= $request->saleAmountReceived )
        $sale->update(['paid'=>1]);

      if( session('cart_contents') != null )
      {
        $cartContents = session('cart_contents');

        foreach ($cartContents as $cartContent ) {
          $revenue = new Revenue;
          $revenue->dept_sales_id  = $sale->id;
          $revenue->product_id = $cartContent['id'];
          $revenue->bookedQuantity = $cartContent['qty'];
          $revenue->price = $cartContent['price'];
          $revenue->total = $cartContent['total'];
          $revenue->user_id=$request->customerID;
          if($sale->paid)
            $revenue->paid=$sale->paid;
          //reduce stock
          $this->reduceStock( $cartContent['id'], $cartContent['qty']);
          $revenue->save();
        }
        session([ 'cart_contents' => [] ]);
      }
      return 1;

    }

    //reduce stock
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
}
