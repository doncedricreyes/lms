<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddSubject;

    

class AddSubjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    $subjects = AddSubject::orderBy('title')->paginate(10);
    return view('view-subjects', compact('subjects'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-subject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = request()->validate([
            'title' => 'required|unique:subjects|max:255|regex:/^[a-zA-Z 0-9]+$/u',

        ], [
'title.regex'=>'Subject contains invalid character!',

        ]);
        
        
        $addsubject = new AddSubject();
        $addsubject->title = $request->title;
        $addsubject->save();
        $request->session()->flash('alert-success', 'Successfully added!');
        return redirect()->route('subject.show');
       
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = request()->validate([
            'title' => 'required|unique:subjects|max:255|regex:/^[a-zA-Z 0-9]+$/u',

        ], [
'title.regex'=>'Subject contains invalid character!',

        ]);
        
        $addsubject = AddSubject::find($id);
        $addsubject->title = $request->title;
        $addsubject->save();
        $request->session()->flash('alert-success', 'Successfully updated!');
        return redirect()->route('subject.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $addsubject = AddSubject::find($id);
       if( $addsubject->delete()){
        $request->session()->flash('alert-success', 'Subject successfully deleted!');
        return redirect()->route('subject.show');
       }
   
        
    }
}
