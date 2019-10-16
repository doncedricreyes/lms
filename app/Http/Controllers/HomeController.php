<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    
    public function learnmore()
    {
        return view('learnmore');
    }

    public function message(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|',
            'email' => 'required|string|max:255|email',
            'subject' => 'required|string|',
            'message' => 'required|string|',
        ], [

      
            
            

        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        $request->session()->flash('alert-success', 'Message Sent');
        return redirect()->back();
    }

}
