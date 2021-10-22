<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

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
    public function upsert()
    {
        // to check authorization that person who access
        // to this action is authorized or not yet
        $this->authorize('manage', 'App\Category');
        return ['success' => true];
    }
}
