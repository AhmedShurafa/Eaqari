<?php

namespace App\Http\Controllers;

use App\Models\Properties;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($guard = null)
    {
        $id = Auth::id();
        $owner = Owner::find($id);
        $gar          = Properties::where(['owners_id'=>$id,'property_types_id'=>'1'])->count();
        $home         = Properties::where(['owners_id'=>$id,'property_types_id'=>'3'])->count();
        $floor        = Properties::where(['owners_id'=>$id,'property_types_id'=>'2'])->count();
        return view('dashboard.index',compact('owner','home','floor','gar'));
    }
}
