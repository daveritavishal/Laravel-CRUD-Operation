<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        return view("products.index",["products"=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name'=> 'required',
            'sku'=> 'required|unique:products,sku',
            'price'=> 'required|numeric',
            'status'=> 'required',
            'image'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()){
            return redirect(route('product.create'))->withErrors($validator)->withInput();
        }
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
            $product->save();
        }


        return redirect(route('product.index'))->with('success','Product created sucessfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $product = Product::findOrFail($id);
       return view('products.edit',['product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        $product = Product::findOrFail($id);
        $oldimage = $product->image;
        $validator = Validator::make($request->all(), [ 
            'name'=> 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price'=> 'required|numeric',
            'status'=> 'required',
            'image'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()){
            return redirect(route('product.edit',$product->id))->withErrors($validator)->withInput();
        }
      
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();

        if ($request->hasFile('image')) {

            if($oldimage != null && File::exists(public_path('uploads/products/'.$oldimage)) ){
                File::delete(public_path('uploads/products/'.$oldimage));
            }
            $image = $request->image;
            $imageName = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
            $product->save();
        }


        return redirect(route('product.index'))->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $product = Product::findOrFail($id);

    if (
        $product->image != null &&
        File::exists(public_path('uploads/products/' . $product->image))
    ) {
        File::delete(public_path('uploads/products/' . $product->image));
    }

    $product->delete();

    return redirect(route('product.index'))
        ->with('success', 'Product deleted successfully.');
}
}