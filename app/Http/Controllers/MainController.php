<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(){
        $apartment = Apartment::with('owner')->where(['status'=>'1','famous'=>'0','show'=>'1'])
            ->orderby('created_at','DESC')->paginate(3);

//        dd($apartment);

        $place= Apartment::with('owner')->where(['status'=>'1','famous'=>'1','show'=>'1'])
            ->orderby('created_at','DESC')->take(3)->get();

        return view('welcome',compact('apartment','place'));
    }

    public function show($id){
        $apartment = Apartment::with('owner')->findOrFail($id);
        return view('listing',compact('apartment'));
    }

    public function showAll(){

        $apartments = Apartment::orderby('created_at','DESC')->get();
        return view('listings',compact('apartments'));
    }

    public function search(Request $request)
    {
        $apartment = Apartment::where([
            ['address','like','%'.$request->place.'%'],
            ['type','=',$request->type_place],
            ['size','>=',$request->size],
            ['room_number','>=',$request->bedrooms],
            ['price','>=',$request->price],
        ])->paginate(6);

        if(is_null($apartment)){
            $apartment = 'لا يوجد';
        }
        return view('welcome',compact('apartment'));
    }

}

//->orWhere([
//    ['address','like','%'.$request->place.'%'],
//    ['type',$request->type],
//    ['size','=<',$request->size],
//    ['room_number','=<',$request->bedrooms],
//    ['price','=<',$request->bedrooms],
//])
