<?php

namespace mat3am\Http\Controllers\Admin;

use Illuminate\Http\Request;
use mat3am\Http\Controllers\Controller;
use mat3am\Contact;

class ContactController extends Controller
{
	public function index(){

	    //Get Contact Message
	    $contacts = Contact::paginate(10);
	    return view('admin.contact.index')->with('contacts',$contacts);
	}
	public function show($id){
		
	    //Get Contact Message
	    $contact = Contact::find($id);
	    return view('admin.contact.show')->with('contact',$contact);
	    
	}
	public function destroy($id){
		
	    //Delete Contact Message
	    $contact = Contact::find($id)->delete();
	    return redirect()->back()->with('success','Message successfully deleted');
	}
}
