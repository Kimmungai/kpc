<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dept;
use App\Product;

class TransfersAjaxController extends Controller
{
    public function save_transfer(Request $request)
    {

      $request->validate([
        'fromDept' => 'required|numeric',
        'toDept' => 'nullable|numeric',
        'toDeptName' => 'nullable|max:255',
        'transferedProds' => 'required'
      ]);

      $originDeptID = $request->fromDept;

      //get destination department id
      $destinationDeptID = $request->toDept;
      $destinationDept = strtolower($request->toDeptName);
      if( !$destinationDeptID )
      {
        if( !$destinationDept ){ return false; }
        $destinationDeptID = $this->getDeptIdFromName($destinationDept);
      }

      //get transfer products
      $transferProds = $request->transferedProds;
      if($transferProds == ''){$transferProds = [];}

      foreach( $transferProds as $transferProd )
      {
        $this->transferProducts($originDeptID, $destinationDeptID, $transferProd);
      }

      return 1;
    }

    protected function getDeptIdFromName($deptName)
    {
      $Dept = Dept::where('name',$deptName)->first();
      return $Dept->id;
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
}
