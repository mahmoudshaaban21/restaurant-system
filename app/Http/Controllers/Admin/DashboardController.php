<?php

namespace mat3am\Http\Controllers\Admin;

use Illuminate\Http\Request;
use mat3am\Http\Controllers\Controller;
use mat3am\Category;
use mat3am\Item;
use mat3am\Slider;
use mat3am\Contact;
use mat3am\Reservation;
class DashboardController extends Controller
{
    //Return View Dashboard
    public function index()
    {
    	$categoryCount = Category::count();
    	$itemCount = Item::count();
    	$sliderCount = Slider::count();
    	$reservations = Reservation::where('status',false)->get();
    	$reservationTrue = Reservation::where('status',true)->get();
    	$contactCount = Contact::count();
    	return view('admin.dashboard',compact('categoryCount','itemCount','sliderCount','reservations','contactCount','reservationTrue'));
    }
}
