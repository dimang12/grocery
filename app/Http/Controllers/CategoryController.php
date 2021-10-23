<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function showmaincate()
    {
        return view('user.showmaincate', [
            'maincategories' => Category::findall()
        ]);
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
    * To update or insert
    */
    public function upsert(Request $request)
    {
        // to check authorization that person who access
        // to this action is authorized or not yet
        $this->authorize('manage', 'App\Category');
        $categories = $request->post('categories');
        foreach ($categories as $cate) {
            if (isset($cate['id'])) {
                Category::where('id', $cate['id'])->update($cate);
            } else {
                Category::create($cate);
            }
        }
        return ['success' => true, 'categories' => Category::all()];
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        //delete function is embed already to object of Category model
        $category->delete();
        return ['success' => true];
    }
}
