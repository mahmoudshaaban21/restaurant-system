<?php

namespace mat3am\Http\Controllers;

use Illuminate\Http\Request;
use mat3am\Reservation;
use Brian2694\Toastr\Facades\Toastr;
class ReservationController extends Controller
{
    public function reserve(Request $request){
    	$request->validate([
            'name'                  =>  'required',
            'phone'           		=>  'required',
            'email'              	=>  'required|email',
            'dateandtime'           =>  'required',
        ]);
        

        $reservation               	= new Reservation();
        $reservation->name         	= $request->name;
        $reservation->phone  		= $request->phone;
        $reservation->email        	= $request->email;
        $reservation->date_and_time   = $request->dateandtime;
        $reservation->message   	= $request->message;
        $reservation->status  		= false;
        $reservation->save();
        Toastr::success('Reservation request sent successfully.we will confirm to you shortly','success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    
	}
}