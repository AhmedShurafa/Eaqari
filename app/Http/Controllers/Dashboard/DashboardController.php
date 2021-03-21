<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Owner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $owner = Owner::count();
        $gar = Apartment::where('type','0')->count();
        $home = Apartment::where('type','1')->count();
        $floor = Apartment::where('type','2')->count();
        $message = Message::count();
        return view('dashboard.index',compact('owner','home','floor','gar','message'));
    }
    public function getAllTrashed(){

        $owners      = Owner::onlyTrashed()->with('user')->get();
        $apartments  = Apartment::onlyTrashed()->with('owner')->get();
        $messages      = Message::onlyTrashed()->with('owner','apartment')->get();
        return view('dashboard.trash',compact('owners','apartments','messages'));

    }
    public function restoreOwner($id){

        Owner::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.users.index');
    }

    public function restoreApartment($id){
        Apartment::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.apartment.index');
    }

    public function restoreMessage($id){
        Message::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('message.index');
    }
}
