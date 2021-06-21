<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Owner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        if (Auth::guard('web')->check()){
            $user = User::findOrFail($id);
            return view("dashboard.User.show",compact('user'));

        }else{
            $owner = Owner::findOrFail($id);
//            dd($user);
            return view("dashboard.User.profile",compact('owner'));
        }
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
        if (Auth::guard('web')->check()){

            $user = User::findOrFail($id);

            if($request->hasfile('image')){
                $image = $request->file('image');
                $image_new_name = time() .'.'. $image->getClientOriginalExtension();//Getting Image Extension
                $image->move("public/avatars/",$image_new_name);
                $filePath = "public/avatars/" . $image_new_name;
            }

            if (isset($request->password)){
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->with('error', 'Current password does not match!');
                }
                $data['password'] = Hash::make($request->password);
            }else{
                $data = $request->except('password','current_password','password_confirmation');
            }

            $data['image'] = isset($filePath) ? $filePath : $user->image;
            $user->update($data);

            session()->flash('success','Data Update Successfully');
            return view("dashboard.User.show",compact('user'));

        }else{
            $validator = Validator::make($request->all(), [
                'name'      => 'required|min:2',
                'email'     => 'required|email|'.Rule::unique('owners')->ignore(Auth::guard('owner')->user()->id),
                'password'  => 'confirmed',
                'phone'     => 'required|string',
                'phone2'    => 'required|string',
                'ssn'       => 'required|integer',
//                'image'     => 'mimes:jpeg,png',
            ]);

            if($request->hasfile('image')){
                $imageOwner = $request->file('image');
                $image_new_Owner = time() .'.'. $imageOwner->getClientOriginalExtension();//Getting Image Extension
                $imageOwner->move("public/avatars/",$image_new_Owner);
                $filePath = "public/avatars/" . $image_new_Owner;
            }

            $owner = Owner::findOrFail($id);

            if($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (isset($request->password)){
                if (!Hash::check($request->current_password, $owner->password)) {
                    return back()->with('error', 'Current password does not match!');
                }

                $data['password'] = Hash::make($request->password);
            }else{

                $data = $request->except('password','current_password','password_confirmation');
            }

            $data['image'] = isset($filePath) ? $filePath : $owner->image;
            $owner->update($data);

            session()->flash('success','Data Update Successfully');
            return view("dashboard.User.profile",compact('owner'));
        }
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
            session()->flash('success','Data Trashed Successfully');
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
            'image'     => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    }
    private function role(){

        $user = Owner::find(Auth::guard('owner')->user())->first();

        return request()->validate([
            'name'      => 'required|min:2',
            'email'     => 'required|email|'.Rule::unique('owners')->ignore($user->id),
            'phone'     => 'required|string',
            'phone2'    => 'required|string',
            'ssn'       => 'required|integer',
            'image'     => 'sometimes|files|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    }
}
