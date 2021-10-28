<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function menu()
    {
        # code...
        $categories = Category::orderBy('cate_ordering')->get();
        // print_r($categories);
        return view('admin.menu_editor', [
            "categories" => $categories
        ]);
    }
}
