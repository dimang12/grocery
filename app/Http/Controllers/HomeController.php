<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now  = now();
//        echo $now;
        $homeProducts = Product::orderBy('available_at', 'DESC')->where('available_at', '<=', $now)->take(10)->get();
//        print_r($homeProducts);
//        return false;
        return view('home');
    }


}
