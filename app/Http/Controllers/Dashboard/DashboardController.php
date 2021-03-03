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
        $home = Apartment::where('type',1)->count();
        $gar = Apartment::where('type',0)->count();
        $message = Message::count();
        return view('dashboard.index',compact('owner','home','gar','message'));
    }
}
