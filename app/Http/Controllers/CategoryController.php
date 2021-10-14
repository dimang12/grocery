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
        $categories = Category::orderBy('cate_ordering')->get();

        return view('category.index', [
            'categories' => $categories
        ]);
    }
}
