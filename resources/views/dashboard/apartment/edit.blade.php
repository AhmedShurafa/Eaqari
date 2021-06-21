@extends("dashboard.app")

@section("content")
    @push("style")
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">تعديل معلومات المنشأة</h1>

        <div class="card shadow mb-4 p-3">
            <div class="card-body">
                <form  method="POST" action="{{route('dashboard.apartment.update',$apartment->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="owner_id" value="{{$apartment->owner_id}}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="type">نوع المنشأة</label>
                            <select name="property_type_id" required class="form-control" id="select">
                                <option value="...." selected disabled>اختر نوع المنشأة الخاص بك</option>
                                @foreach($property as $value)
                                    <option value="{{$value->id}}" @if($apartment->Property->id == $value->id) selected @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type">المنطقة</label>
                            <select name="area_id" required class="form-control">
                                <option value="...." selected disabled>اختر المنطقة</option>
                                @foreach($area as $value)
                                    <option value="{{$value->id}}" @if($apartment->area->id == $value->id) selected @endif>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="price" class="text-capitalize">price</label>
                            <input type="number" name="price" class="form-control"  value="{{$apartment->price}}" id="price">
                        </div>

                        <div class="form-group col">
                            <label for="size" class="text-capitalize">size</label>
                            <input type="number" name="size" class="form-control"  value="{{$apartment->size}}" id="size">
                        </div>

                        @if(str_contains($apartment->Property->name,'شقة'))
                            <div class="form-group col" id="floor">
                                <label for="floor" class="text-capitalize">floor</label>
                                <input type="number" name="floor" class="form-control"  value="{{$apartment->size}}">
                            </div>
                        @endif
                    </div>

                    <div class="form-row" id="all">
                        <div class="form-group col" id="room_number">
                            <label for="room_number" class="text-capitalize">room number</label>
                            <input type="text" name="room_number" class="form-control"
                                   value="{{$apartment->room_number}}" id="room_number">
                        </div>
                        <div class="form-group col">
                            <label for="bathrooms" class="text-capitalize">bathrooms</label>
                            <input type="text" name="bathrooms" class="form-control"
                                   value="{{$apartment->bathrooms}}" id="bathrooms">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="address" class="text-capitalize">address</label>
                            <input type="text" class="form-control" name="address" value="{{$apartment->address}}" id="address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="description" class="text-capitalize">description</label>
                            <textarea class="form-control"  id="description">{{$apartment->description}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row thumbs">
                        <div class="form-group col">
                            <label for="images" class="text-capitalize d-block">images</label>
                                <h5 style="color: red">* الرجاء ادخال الصور من غير عنوان واضح او معلم واضح أو كتابة الايميل او رقم الجوال ع الصور</h5>
                                <input type="file" name="images[]" multiple>

                            <br>
{{--                            {{dd(stripos($apartment->images , 'https'))}}--}}
                            @if($apartment->images != null)
                                <img src="{{asset($apartment->images)}}" class="img-thumbnail w-25" alt="">
{{--                            @else--}}
                                @foreach(json_decode($apartment->images) as $key=>$value)
                                    <a href="{{asset($value)}}" data-lightbox="home-images">
                                        <img src="{{asset($value)}}" alt="" class="img-fluid w-25">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col text-left">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">

        $('#age').datepicker({
            endDate:"1-1-2000",
            startDate:"1-1-1900",
        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });

    </script>
    <script type="text/javascript">

        $("#select").change(function () {
            var e = $(this).val();

            if (e == 1) {
                $("#all").css('display', 'none');
                $("#floor").css('display', 'none');
            }else if(e == 3){
                $("#floor").css('display', 'none');
                $("#all").css('display', 'flex');
            }else{
                $("#floor").css('display', 'block');
                $("#all").css('display', 'flex');
            }
        });

    </script>
@endpush