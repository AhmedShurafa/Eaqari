<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use App\Models\Property_type;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

        $apartment = Properties::with('owner')->where('famous','0')
            ->orderby('created_at','DESC')->paginate(3);

        $place= Properties::with('owner')->where('famous','1')
            ->orderby('created_at','DESC')->take(3)->get();

        $property = Property_type::all();

        return view('welcome',compact('apartment','place','property'));
    }

    public function show($id){
        $apartment = Properties::with('owner','Property')->findOrFail($id);
        return view('listing',compact('apartment'));
    }

    public function showAll(){

        $apartments = Properties::orderby('created_at','DESC')->get();
        return view('listings',compact('apartments'));
    }

    public function search(Request $request)
    {
        $apartment = Properties::where([
            ['address','like','%'.$request->place.'%'],
//            ['type','=',$request->type_place],
            ['size','>=',$request->size],
            ['room_number','>=',$request->bedrooms],
            ['price','>=',$request->price],
        ])->paginate(6);

//        dd($apartment);

        if(is_null($apartment)){
            $apartment = 'لا يوجد';
        }
        $property =Property_type::all();
        return view('welcome',compact('apartment','property'));
    }

    public function famous()
    {
        $apartments = Properties::with('Property','owner')->where('famous','1')->get();
//        dd($apartment);
        return view('listings',compact('apartments'));
    }

    public function about()
    {
        return view('about');
    }
}
