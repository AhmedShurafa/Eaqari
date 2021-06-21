<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Owner;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        if(Auth::guard('web')->check()){
            $owner        = Owner::count();
            $gar          = Apartment::count();
            $home         = '1';
            $floor        = Apartment::count();
            $message      = Message::count();
            $transactions = Transaction::count();
            return view('dashboard.index',compact('owner','home','floor','gar','message','transactions'));
        }else{
            $id = Auth::guard('owner')->user()->id;
            $gar          = Apartment::where(['owner_id'=>$id,'property_type_id'=>'1'])->count();
            $home         = Apartment::where(['owner_id'=>$id,'property_type_id'=>'3'])->count();
            $floor        = Apartment::where(['owner_id'=>$id,'property_type_id'=>'2'])->count();
            return view('dashboard.index',compact('home','floor','gar'));
        }
    }
    public function getAllTrashed(){

        $owners      = Owner::onlyTrashed()->get();
        $apartments  = Apartment::onlyTrashed()->with('owner')->get();
        $messages      = Message::onlyTrashed()->with('owner','apartment','customer')->get();
        $transactions      = Transaction::onlyTrashed()->with('owner','apartment','customer')->get();

        return view('dashboard.trash',compact('owners','apartments','messages','transactions'));

    }
    public function restoreOwner($id){

        Owner::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.trashed');
    }

    public function restoreApartment($id){
        Apartment::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.trashed');
    }

    public function restoreMessage($id){
        Message::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.trashed');
    }

    public function restoreTransaction($id){
        Transaction::withTrashed()->where('id',$id)->restore();
        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.trashed');
    }
}
