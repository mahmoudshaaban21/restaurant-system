<?php

namespace mat3am\Http\Controllers\Admin;

use Illuminate\Http\Request;
use mat3am\Http\Controllers\Controller;
use mat3am\Reservation;
use Illuminate\Support\Facades\Notification;
use mat3am\Notifications\ReservationConfirmed;
class ReservationController extends Controller
{
    public function index(){
	    //Get All Reservation
	    $reservations 	= Reservation::paginate(10);
	    return view('admin.reservation.index')->with('reservations',$reservations);
    }

    public function status($id){
    	$reservation 		 = Reservation::find($id);
    	$reservation->status = true;
    	$reservation->save();
       Notification::route('mail', $reservation->email)
            ->notify(new ReservationConfirmed());
    	return redirect()->back()->with('success','Reservation successfully confirmed');
 
    }

    public function destroy($id){

    	$reservation = Reservation::find($id);
    	$reservation->delete();
    	return redirect()->back()->with('success','Reservation successfully deleted');
    }
}
