<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contactus;
use App\Models\Prescription;

class HomeController extends Controller
{
    public function index(){
        return view("home");
    }

    public function redirects(){
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){
            return view("admin.adminhome");
        }

        else{
            return view("home");
        }
    }

    public function about(){
        return view ("about");
    }

    public function contact(){
        $contactdata=Contactus::all();
        return view ("contact",compact("contactdata"));
    }

    public function pharmacy(){
        return view ("pharmacy");
    }
    
     public function prescription(){
        return view ("prescription");
    }

    //postprescription update function
    public function postprescription(Request $request){
        $prescription = new Prescription;
        $image = $request->image;

        //define code
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('prescriptionimage',$imagename);

        $prescription->image=$imagename;
        $prescription->cusname=$request->cusname;
        $prescription->cusaddress=$request->cusaddress;
        $prescription->cusnic=$request->cusnic;
        $prescription->cusnumber=$request->cusnumber;
        $prescription->commen=$request->comment;
        $prescription->save();
        return view("prescription");
    }





}
