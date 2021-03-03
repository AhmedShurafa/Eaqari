<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Apartment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::with('owner')->get();

        return view("dashboard.apartment.apartment",compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.apartment.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'owner_id'   =>'required',
            'type'       =>'required',
            'price'      =>'required',
            'size'       =>'required',
            'bathrooms'  =>'required',
            'furniture'  =>'required',
            'garage'     =>'required',
            'address'    =>'required',
            'images'     =>'required',
//            'images*'     =>'mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($request->hasFile('images')){
            $allowedfileExtension = ['gif','jpg','png','jpeg','svg'];
            $files = $request->file('images');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $extension = strtolower($extension);
                $check = in_array($extension, $allowedfileExtension);
                if($check){
                    $image_new_name = uniqid() .'.'. $extension;//Getting Image Extension
                    $file->move("public/apartments/",$image_new_name);
                    $filePath = "public/apartments/" . $image_new_name;
                    $data[] = $filePath;
                }else{
                    return redirect()->back()->with('error','الرجاء التاكد من الصور المرسلة');
                }
            }
        }

        $owner_id = Auth::user()->owner->id;

//        $apartment = new Apartment();
//            $apartment->owner_id    = $owner_id;
//            $apartment->type        = $request->type;
//            $apartment->price       = $request->price;
//            $apartment->size        = $request->size;
//            $apartment->bathrooms   = $request->bathrooms;
//            $apartment->address     = $request->address;
//            $apartment->description = $request->description;
//            $apartment->images      = isset($data) ? json_encode($data,true) : "";
//        if ($request->type == '1'){
//            $apartment->room_number = $request->room_number;
//            $apartment->furniture   = $request->furniture;
//            $apartment->garage   = $request->garage;
//        }
//        $apartment->save();


        $apartment = $request->all();
        $apartment['images'] = json_encode($data);
        $apartment['owner_id'] = $owner_id;
        Apartment::create($apartment);


        session()->flash('success','Data Create Successfully');

        if (Auth::user()->role == 1){
            return redirect()->route('dashboard.apartment.index');

        }else{
            return redirect()->route('dashboard.owner');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);
        return view("dashboard.apartment.show",compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        return view("dashboard.owner.show",compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'owner_id'   =>'required',
            'type'       =>'required',
            'price'      =>'required',
            'size'       =>'required',
            'bathrooms'  =>'required',
            'furniture'  =>'required',
            'garage'     =>'required',
            'address'    =>'required',
            'images*'     =>'mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($request->hasFile('images')) {
            $allowedfileExtension = ['gif','jpg','png','jpeg','svg'];
            $files = $request->file('images');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $extension = strtolower($extension);
                $check = in_array($extension, $allowedfileExtension);
                if($check){
                    $image_new_name = uniqid() .'.'. $extension;//Getting Image Extension
                    $file->move("public/apartments/",$image_new_name);
                    $filePath = "public/apartments/" . $image_new_name;
                    $data[] = $filePath;
                }else{
                    return redirect()->back()->with('error','الرجاء التاكد من الصور المرسلة');
                }
            }
        }

        $owner_id = Auth::user()->owner->id;

//        $apartment = Apartment::findOrFail($id);
//        $apartment->owner_id    = $owner_id;
//        $apartment->type        = $request->type;
//        $apartment->price       = $request->price;
//        $apartment->size        = $request->size;
//        $apartment->bathrooms   = $request->bathrooms;
//        $apartment->address     = $request->address;
//        $apartment->description = $request->description;
//        $apartment->images      = isset($data) ? json_encode($data,true) : "";
//        if ($request->type == '1'){
//            $apartment->room_number = $request->room_number;
//            $apartment->furniture   = $request->furniture;
//            $apartment->garage   = $request->garage;
//        }
//        $apartment->update();

        $apartment = $request->all();
        if (!(is_null($request['images']))){
            $apartment['images'] = json_encode($data);
        }
        $apartment['owner_id'] = $owner_id;
        Apartment::find($id)->update($apartment);


        session()->flash('success','Data Update Successfully');

        if (Auth::user()->role ==1){
            return redirect()->route('dashboard.apartment.index');

        }else{
            return redirect()->route('dashboard.owner');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Apartment::findOrFail($id)->delete();
        session()->flash('success','Data deleted successfully');
        return redirect()->route('dashboard.apartment.index');
    }

    // Show all Apartment Auth
    public function MyApartment(){
        $apartments = Apartment::where('owner_id',Auth::user()->owner->id)->get();
        return view("dashboard.owner.apartment",compact("apartments"));
    }

    public function changeStatus($id)
    {
        $apartment = Apartment::findOrFail($id);

        if ($apartment->status == '1'){
            $apartment->status = '0';
        }else{
            $apartment->status = '1';
        }

        $apartment->update();

        session()->flash('success','Change Status successfully');
        return redirect()->back();
    }
}
