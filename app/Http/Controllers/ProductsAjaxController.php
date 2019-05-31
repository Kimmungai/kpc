<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;

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
      $product->cost = $request->cost;
      $product->purchases_id = $request->purchases_id;
      $product->dept_id = $request->dept_id;
      $product->save();
      $data[0] = $product;
      return $data;
    }
}
