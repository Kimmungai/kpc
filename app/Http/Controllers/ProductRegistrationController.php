<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Product;
use App\Dept;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;

class ProductRegistrationController extends Controller
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
    public function index(Request $request)
    {
        $dept = [];
        $sortField='created_at';$sortValue='DESC';
        $status =' id != "" ';
        $sortBy = $request->filter_sort;
        $startDate = $request->filter_from != null ?  Carbon::create($request->filter_from) : null;
        $endDate = $request->filter_to != null ?  Carbon::create($request->filter_to) : null;
        if($sortBy)
        {
          if( $sortBy == 'oldNew' ){$sortField='created_at';$sortValue='ASC';}
          if( $sortBy == 'inOnly' ){ $status ='quantity > '.env('LOW_STOCK_LEVEL',5).''; }
          if( $sortBy == 'lowOnly' ){ $status ='quantity > 0 AND quantity < '.env('LOW_STOCK_LEVEL',5).''; }
          if( $sortBy == 'outOnly' ){ $status ='quantity <= 0'; }
        }
        if(Session('deptID') != null ){
          $dept = Dept::find(Session('deptID'));

        if( $startDate && $endDate)
        {

            $products= Product::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereDate('created_at','<=',$endDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }elseif($startDate){

            $products= Product::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereDate('created_at','>=',$startDate)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }else{

            $products= Product::where('dept_id',$dept->id)->orderBy($sortField,$sortValue)->whereRaw($status)->paginate(env('ITEMS_PER_PAGE',5));

        }
        return view('product.index',compact('products','dept','sortBy','startDate','endDate'));
      }else{

        $products = Product::paginate(env('ITEMS_PER_PAGE',5));

      }


        return view('product.index',compact('products','dept'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(Session('deptID') != null ){
        $dept = Dept::find(Session('deptID'));
        return view('product.create',compact('dept'));
      }else {
        Session::flash('error', 'There is an error! Session deptID not defined');
        return redirect('/');
      }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $validated = $request->all();
        $prodData = $this->uploads($request,$validated);
        Product::create($prodData);
        Session::flash('message', env("SAVE_SUCCESS_MSG","Product saved succesfully!"));
        return redirect(route('product-registration.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,$id)
    {
      $dept ='';
      $product = Product::where('id',$id)->first();
      if(Session('deptID') != null ){
        $dept = Dept::find(Session('deptID'));
      }
      return view('product.edit',compact('product','dept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validated = $request->validate([
        'type' => 'required|numeric',
        'img1' => 'nullable|image|mimes:jpeg,bmp,png|max:1024',
        'name' => 'required|max:255',
        'sku' => 'required|max:255|unique:products,name,'.\Request::segment(2),
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'description' => 'nullable',
       ]);

       $validated = $this->uploads($request,$validated);
       $updatedProd = Product::where('id',$id)->update($validated);
       Session::flash('message', env("SAVE_SUCCESS_MSG","Details updated succesfully!"));
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = Product::find($id);
      $product->forceDelete();
      Session::flash('message', env("DELETE_SUCCESS_MSG","Records removed succesfully!"));
      return redirect('/product-registration');
    }

    /**
     * Upload new user files.
     *
     * @param  \App\Product  $product
     * @return validated user with image urls
     */
    private function uploads($request,$prodData)
    {
      if( $request->hasFile('img1') )
      {
        $storageLoc = env('AVATAR_STORAGE_LOC','public/products/'.$request->input('name').'/');
        $prodData['img1'] = $this->handleFileUpload($storageLoc,$request);
      }
      return $prodData;
    }

    /*
    *Function to upload files
    */
    private function handleFileUpload($storageLoc,$request,$value='img1')
    {
      $image = $request->file($value);
      $name = time().'.'.$image->getClientOriginalExtension();
      $image->move($storageLoc, $name);
      return asset($storageLoc.'/'.$name);
    }

    public function requisition($id)
    {
        $dept = Dept::find($id);
        return view('product.requisition',compact('dept'));
    }

    /*
    *Function to select product registration type
    */
    public function prod_reg_type()
    {
      if(Session('deptID') != null ){

        $dept = Dept::find(Session('deptID'));
        return view('product.reg-type',compact('dept'));

      }else {

        return view('product.reg-type');

    }
  }

}
