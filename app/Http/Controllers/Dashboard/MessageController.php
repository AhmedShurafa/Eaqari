<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = Message::with(['owner','apartment','customer'])->get();
        // dd($messages);
        return view('dashboard.message',compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'owners_id'    => 'required',
            'properties_id'=> 'required',
            'customers_id' => 'required',
            'description' => 'required',
        ]);

        $test = $request->except('_token');//remove token
        Message::create($test);

        session()->flash('success','تم إرسال الرسالة بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::with(['owner','customer','apartment'])->findOrFail($id);
        // dd($message);
        return view('dashboard.show_message',compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::findOrFail($id)->delete();

        session()->flash('success','Data deleted successfully');

        return redirect()->route('message.index');
    }
}
