<?php

namespace mat3am\Http\Controllers;

use Illuminate\Http\Request;
use mat3am\Slider;
use mat3am\Category;
use mat3am\Item;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders        = Slider::all();
        $categories     = Category::all();
        $items          = Item::all();
        return view('welcome',compact('sliders','categories','items'));
    }
}
