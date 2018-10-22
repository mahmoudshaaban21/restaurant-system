<?php

namespace mat3am\Http\Controllers;

use Illuminate\Http\Request;
use mat3am\Contact;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function sendMessage(Request $request){
    	//Verify Message
    	$request->validate([
            'name'                  =>  'required',
            'email'           		=>  'required|email',
            'subject'              	=>  'required',
            'message'           	=>  'required',
        ]);
        

        $Contact               	= new Contact();
        $Contact->name         	= $request->name;
        $Contact->email        	= $request->email;
        $Contact->subject  		= $request->subject;
        $Contact->message   	= $request->message;
        $Contact->save();
        Toastr::success('Your message successfully send','success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
