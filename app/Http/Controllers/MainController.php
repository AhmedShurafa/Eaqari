<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Properties;
use App\Models\Property_type;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

        $apartment = Properties::with('owner')->where(['famous'=>'0','status'=>'1'])
            ->orderby('created_at','DESC')->paginate(3);

        $place= Properties::with('owner')->where('famous','1')
            ->orderby('created_at','DESC')->take(3)->get();

        $property = Property_type::all();

        $area = Area::all();

        return view('welcome',compact('apartment','place','property','area'));
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
        $re = $request->except('_token');
        $data = [];
        foreach($request->except('_token') as $key => $value){
            if($request[$key] != null){
                $data[$key] = $value;
            }
        }
        foreach($data as $k=> $v){
            $apartment = Properties::where([
                ["$k",'<=',$v],
            ])->paginate(6);
        }

        if(is_null($apartment)){
            $apartment = 'لا يوجد';
        }

        $area = Area::all();
        $search = '1';

        $property =Property_type::all();
        return view('welcome',compact('apartment','property','area','search'));
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
