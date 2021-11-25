<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductItemPost;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DateTime;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
//        $category = new Category();
//        $category->getProducts()->map(function ($item) {
//            return $item->only(['id', 'category_name']);
//        });
        //
        $productQuery = Product::orderBy("created_at", 'desc');
        if($id != null){
            $productQuery->where('category_id', $id);
        }
        $products = $productQuery->get();

        // print_r($product);
        return ['success' => true, 'products' => $products];
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
        if (!$request->user()->can('admin')) {
            return response('Unauthorized', 403);
        }
        $request->validate([
            'product_name' => 'required|max:128',
            'category_id' => 'required|numeric',
            'slug' => 'nullable',
            'price' => 'required|numeric|min:0',
            'size' => 'required',
            'SKU' => 'required',
            'origin' => 'nullable',
            'image' => 'nullable',

            'profile' => 'max:1024',
            'detail' => 'max:1024',
            'our_story' => 'nullable'
        ]);
//        $product = $request->post();
//        $product['slug'] = str_slug($product['product_name']);

        Product::create($request->post());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductItemPost $request, Product $product)
    {
        //

//        $request->validate($this->validateFields());

//        $product = $request->post();
        $product = $request->validated();
        print_r($product);
        exit();
        $productId = $product['id'];
        $isSuccess = false;
        if($product['id']) {
//            unset($product['id']);
            Product::where('id',$productId)
                ->update($product)
                ;
            $isSuccess = true;
        }
        return $isSuccess;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $data)
//    public function destroy($id)
    {
        $isDestroyed = false;
        if( !empty($data) ){
            $currentDate = new DateTime();
            Product::where('id', $data->id)->update(['deleted_at'=>$currentDate]);
            $isDestroyed = true;
        }
        return $isDestroyed;
    }

    public function uploadImage(Request $request) {
        if (!$request->user()->can('admin')) {
            return response('Unauthorized', 403);
        }

        $file = $request->file('file');
        // directory to save image
        $dir = 'public/images';
        //process saving image into directory
        $path = $file->store($dir);
        return str_replace("$dir/", '', $path);
    }

    public function detail($id)
    {
        $isFound = false;
        $product = [];
        if (!empty($id)) {
            $product = Product::where('products.id', $id)
                ->join('categories', "products.category_id", "=", "categories.id")
                ->get()
                ->first();
            // print_r($product);
            $isFound = true;
        } else {
            $isFound = false;
        }
        return ['isFound' => $isFound, 'product' => $product];
    }
    protected function validateFields() {
        return  [
            'product_name' => 'required|max:128',
            'category_id' => 'required|numeric',
            'slug' => 'nullable',
            'price' => 'required|numeric|min:0',
            'size' => 'required',
            'SKU' => 'required',
            'origin' => 'nullable',
            'image' => 'nullable',

            'profile' => 'max:1024',
            'detail' => 'max:1024',
            'our_story' => 'nullable'
        ];
    }
}
