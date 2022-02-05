<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\Product;
use App\Models\Services\CategoryService;
use DateTime;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {

        $this->authorize('manage', 'App\Category');

        $categories = Category::orderBy('cate_ordering')->get();

        return view('category.index', [
            'categories' => $categories
        ]);
    }
    /*
     * Get all available categories
     */
    public function get() {
        $this->authorize('manage', 'App\Category');
        $categories = Category::select('id','category_name')->orderByDesc('cate_ordering')->get();
        return $categories;
    }
    /*
    * To update or insert
    */
    public function upsert(Request $request)
    {
        // to check authorization that person who access
        // to this action is authorized or not yet
        $this->authorize('manage', 'App\Category');
        $categories = $request->post('categories');
        foreach ($categories as $cate) {
            $current = new DateTime();
            if (isset($cate['id'])) {
                $cate['updated_at'] = $current;
                unset($cate['created_at']);
                Category::where('id', $cate['id'])->update($cate);
            } else {

                $cate['created_date'] = $current->getTimestamp();
                $cate['updated_date'] = $current->getTimestamp();
                Category::create($cate);
            }
        }
        return ['success' => true, 'categories' => Category::all()];
    }

    public function update($categoryId, Request $request) {
        $this->authorize('manage', 'App\Category');

        $category = $request->post('category');
        // check $categoryId is not null or empty
        if(!empty($categoryId)) {
            // unset the created_at because the category was created by then
            if(isset($category["created_at"])) unset($category["created_at"]);
            if(isset($category["updated_at"])) $category["updated_at"] = new DateTime();
            CategoryService::updateCategory($categoryId, $category);
        }
    }

    public function save(Request $request) {
        $this->authorize('manage', 'App\Category');

        $category = $request->post('category');
        CategoryService::insertCategory($category);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        //delete function is embed already to object of Category model
        $category->delete();
        return ['success' => true];
    }

    public function detail($id)
    {
        echo 'This is menu detail';
        $products = [];
        if (!empty($id)) {
            $products = Product::all();
        }
        // print_r($products);
        return view(
            'category.detail',
            [
                'products' => $products
            ]
        );
    }
}
