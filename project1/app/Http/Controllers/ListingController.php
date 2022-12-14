<?php

namespace App\Http\Controllers;

use App\Models\Listing;

use Illuminate\Http\Request; 
use Illuminate\Validation\Rule;




class ListingController extends Controller
{
    // to show all listings
    public function index(){
 
        return view('listings.index',[
            'listings'=> Listing ::latest()->filter(request(['tag','search']))->paginate(4) //create a filtr function with tag and search
        ]);

    }
   
   
     //show single listing 
     public function show(Listing $listing){
        return view ('listings.show',[
            'listing'=> $listing
        ]);

    }
     // show create form
     public function create(){
        return view('listings.create');
    }
     // store data
     public function store(Request $request){
        $formFields = $request -> validate([
            'title' => 'required',
            'company' =>['required', Rule::unique('listings', 'company')] ,
            'location'=>'required',
            'website'=>'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store
            ('logos','public');
        }
        $formFields['user_id']=auth()->id();
        

        Listing::create($formFields);
        return redirect('/') ->with ('message','Listing created succefully!');
    }
    //Edit listing
    public function edit(Listing $listing){
        
        return view('listings.edit',['listing'=>$listing]);
    }
    //Update listing
    public function update(Request $request , Listing $listing){
        $formFields = $request -> validate([
            'title' => 'required',
            'company' =>['required'] ,
            'location'=>'required',
            'website'=>'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $listing-> update($formFields);
        return back()->with ('message','laragig update succesfully!');
    }
    //Delete listing
    public function destroy(Listing $listing){
        $listing ->delete();
        return redirect('/')->with('message','laragig deleted succesfully!');
    }
    //manage listing
    public function manage(){
        return view('listings.manage',['listings'=> auth()->user()->listings()->get()]);
    }
}
