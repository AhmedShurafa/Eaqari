<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Properties;
use App\Models\Area;
use App\Models\Property_type;
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
        $apartments = Properties::with('owner')->get();

        return view("dashboard.apartment.apartment",compact("apartments"));
    }

    public function typeApartment($id){

        try{
            if ($id == "1" || $id == "حاصل"){// حاصل 1
                $apartments = Properties::with('owner')->with('Area')
                    ->WhereHas('Property',function ($q) use($id){
                        $q->where('id',1);
                    })->get();

                    // dd($apartments);

                return view("dashboard.apartment.warehouse",compact("apartments"));

            }elseif ($id=="2" || $id == "منزل"){ //home 3

                $apartments = Properties::with('owner')->with('area')
                    ->WhereHas('Property',function ($q) use($id){
                        $q->where('id',3);
                    })->get();

                return view("dashboard.apartment.apartment",compact("apartments"));

            }elseif ($id=="3" || $id == "حاصل"){// flat 2
                $apartments = Properties::with('owner')->with('area')
                    ->WhereHas('Property',function ($q) use($id){
                        $q->where('id',2);
                    })->get();
                return view("dashboard.apartment.flat",compact("apartments"));
            }else{
                return view("dashboard.404");
            }
        }catch (\Exception $exception){
            dd($exception);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = Property_type::all();
        $area = Area::all();
        return view("dashboard.apartment.create",compact('property','area'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->property_type_id == 1 || $request->property_type_id = 3){
            $validator = $request->validate([
                'owners_id'   =>'required',
                'property_types_id'       =>'required',
                'price'      =>'required',
                'size'       =>'required',
                'address'    =>'required',
                'images'     =>'required',
            ]);
        }else{
            $validator = $request->validate([
                'owners_id'   =>'required',
                'property_types_id'       =>'required',
                'price'      =>'required',
                'size'       =>'required',
                'bathrooms'  =>'required',
                'address'    =>'required',
                'images'     =>'required',
                'floor'     =>'required|integer',
            ]);
        }

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
                    return redirect()->back()->with('error','الرجاء التاكد من نوع  الصور المرسلة');
                }
            }
        }

        $apartment = $request->all();
        $apartment['images'] = json_encode($data);
        Properties::create($apartment);


        session()->flash('success','Data Create Successfully');

        return redirect()->route('dashboard.owner',$request->property_type_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Properties::with(['owner','Area'])
            ->WhereHas('Property')->find($id);

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
        $apartment = Properties::findOrFail($id);
        $property = Property_type::all();
        $area = Area::all();
        return view("dashboard.apartment.edit",compact('apartment','property','area'));
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
        if ($request->property_type_id == 1 || $request->property_type_id = 3){
            $validator = $request->validate([
                'owners_id'   =>'required',
                'property_types_id'       =>'required',
                'price'      =>'required',
                'size'       =>'required',
                'address'    =>'required',
            ]);
        }else{
            $validator = $request->validate([
                'owners_id'   =>'required',
                'property_types_id'       =>'required',
                'price'      =>'required',
                'size'       =>'required',
                'bathrooms'  =>'required',
                'address'    =>'required',
                'floor'     =>'required|integer',
            ]);
        }

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

        $apartment = $request->all();
        if (!(is_null($request['images']))){
            $apartment['images'] = json_encode($data);
        }
        Properties::find($id)->update($apartment);


        session()->flash('success','Data Update Successfully');

        return redirect()->route('dashboard.owner',$request->property_type_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Properties::findOrFail($id)->delete();
        session()->flash('success','Data Deleted Successfully');
        return redirect()->back();
    }

    public function stauts($id)
    {
        Properties::findOrFail($id)->update([
            'status' => 2
        ]);
        session()->flash('success','Data Deleted Successfully');
        return redirect()->back();
    }

    // Show all Apartment Auth
    public function MyApartment($id){

        // dd($id);

        if ($id == "حاصل" || $id == 1 ){// حاصل 1
            $apartments = Properties::with('owner')->with('Area')
                ->WhereHas('Property',function ($q){
                    $q->where('name','حاصل');
                })->where('owners_id',Auth::guard('owner')->user()->id)->where('status','<>','2')->get();
            return view("dashboard.apartment.warehouse",compact("apartments"));

        }elseif ($id == "منازل" || $id == 2){

            $apartments = Properties::with('owner')->with('Area')
                ->WhereHas('Property',function ($q) use($id){
                    $q->where('name','منزل');
                })->where('owners_id',Auth::guard('owner')->user()->id)->where('status','<>','2')->get();
            return view("dashboard.apartment.apartment",compact("apartments"));

        }elseif ($id == "شقق" || $id == 3){

            $apartments = Properties::with('owner')->with('Area')
                ->WhereHas('Property',function ($q){
                    $q->where('name','شقة');
                })->where('owners_id',Auth::guard('owner')->user()->id)->where('status','<>','2')->get();
            return view("dashboard.apartment.flat",compact("apartments"));
        }else{
            abort(404);
        }
    }

    protected function changeFamous($id)
    {
        $apartment = Properties::findOrFail($id);

        if ($apartment->famous == '1'){
            $apartment->famous = '0';
        }else{
            $apartment->famous = '1';
        }

        $apartment->update();

        session()->flash('success','Change Status successfully');
        return redirect()->back();
    }

    public function trashed()
    {
        $apartments = Properties::where('status','=','2')->get();
        // dd($apartments);
        return view('dashboard.owner.trash',compact('apartments'));
    }
    public function restoreApartmentStatus($id)
    {
        $apartments = Properties::findOrFail($id)->update([
            'status' => 1
        ]);

        session()->flash('success','Data Restore Successfully');
        return redirect()->route('dashboard.owner.trashed');
    }
}
