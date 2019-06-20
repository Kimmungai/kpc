<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;
use App\Expense;
use Carbon\Carbon;

class ProductsAjaxController extends Controller
{
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
      $product->purchases_id = $request->purchases_id;
      $product->dept_id = $request->dept_id;
      $product->save();
      /*Expense::where('purchase_id',$request->purchases_id)->update([
        'product_id' => $product->id,
        'cost' => $request->cost
      ]);*/
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
      $products = Product::where('name', 'LIKE',  $string . '%')->get();
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
          return Expense::where('purchase_id',$purchase_id)->update([
            $field => $value
          ]);
        }else if($field === 'cost'){
          return Expense::where('purchase_id',$purchase_id)->update([
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
}
