<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Owner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(auth()->user()->role !=1 ){
                abort(403);
            }
            return $next($request);
        })->except('edit','show','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('owner')->where('role',0)->get();
//        dd($users);
        return view('dashboard.User.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate($this->roles());

        if($validator->fails()) {
            return redirect()->route('dashboard.users.index')
                ->withErrors($validator)
                ->withInput();
        }

        if($request->hasfile('image')){
            $image = $request->file('image');
            $image_new_name = time() .'.'. $image->getClientOriginalExtension();//Getting Image Extension
            $image->move("public/avatars/",$image_new_name);
            $filePath = "public/avatars/" . $image_new_name;
        }


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $owner = Owner::create([
            'user_id' => $user->id,
            'phone' => $request['phone'],
            'phone2' => $request['phone2'],
            'ssn' => $request['ssn'],

            'image' => isset($filePath) ? $filePath : '',
            'facebook' => $request['facebook'],
            'instagram' => $request['instagram'],
            'twitter' => $request['twitter'],
        ]);

        session()->flash('success','Data Create Successfully');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('owner')->findOrFail($id);
        return view("dashboard.User.profile",compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("dashboard.User.show",compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $validator = $request->validate($this->role());

//        if($validator->fails()) {
//            return redirect()->route('dashboard.users.index')
//                ->withErrors($validator)
//                ->withInput();
//        }

        if($request->hasfile('image')){
            $image = $request->file('image');
            $image_new_name = time() .'.'. $image->getClientOriginalExtension();//Getting Image Extension
            $image->move("public/avatars/",$image_new_name);
            $filePath = "public/avatars/" . $image_new_name;
        }


        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        $owner = Owner::findOrFail($user->owner->id);
        $owner->user_id = $user->id;
        $owner->phone = $request->phone;
        $owner->phone2 = $request->phone2;
        $owner->ssn = $request->ssn;
        $owner->image = isset($filePath) ? $filePath : $owner->image;
        $owner->facebook = $request->facebook;
        $owner->instagram = $request->instagram;
        $owner->twitter = $request->twitter;
        $owner->save();


//        dd($user->id);
        if (Auth::user()->role == 0){
            return redirect()->route('dashboard.users.show',$user->id);
        }

        session()->flash('success','Data Update Successfully');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $owner = Owner::findOrFail($id);
            User::where('id',$owner->user_id)->delete();
            $owner->delete();
            session()->flash('success','Data deleted successfully');
            return redirect()->route('dashboard.users.index');

        } catch (\Throwable $th) {
            return redirect()->route('properties.index')->with('error', 'Something went wrong!');
        }
    }

    private function roles(){
        return request()->validate([
            'name'      => 'required|min:2',
            'email'     => 'required|email',
            'password'  => 'required|confirmed',
            'phone'     => 'required|string',
            'phone2'    => 'required|string',
            'ssn'       => 'required|integer',
            'facebook'  => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter'   => 'nullable|string',
            'image'     => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    }
    private function role(){
        return request()->validate([
            'name'      => 'required|min:2',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'phone2'    => 'required|string',
            'ssn'       => 'required|integer',
            'facebook'  => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter'   => 'nullable|string',
            'image'     => 'sometimes|files|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    }

    public function changeStatus($id)
    {
        $user = Owner::where('user_id',$id)->first();

//        dd($user->status);

        if ($user->status == '1'){
            $user->status = '0';
        }else{
            $user->status = '1';
        }
        $user->update();

        session()->flash('success','Change Status successfully');
        return redirect()->back();
    }
}
