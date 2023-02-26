<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Http\Controller\Backend\Product\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index(Request $request){
    	$contacts = Contact::orderByRaw('created_at DESC');
        if($request->key){
            $contacts = $contacts->where('name', 'like', '%'.$request->key.'%')->orWhere('id', 'like', '%'.$request->key.'%');
        }
        $contacts = $contacts->paginate(8);
        if($request->key){
            $contacts = $contacts->appends(['key' => $request->key]);
        }
    	return view('backend.contact.index')->with('contacts', $contacts);
    }

    public function show($id){
        $contact = Contact::findOrFail($id);
        return view('backend.contact.show')->with('contact', $contact);
    }

    public function destroy($id){
    	$contact = Contact::findOrFail($id);
    	$contact->delete();
    }

}
