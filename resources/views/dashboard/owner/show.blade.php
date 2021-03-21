@extends("dashboard.app")

@section("content")
    @push("style")
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">نعديل معلومات المنشأة</h1>

        <div class="card shadow mb-4 p-3">
            <div class="card-body">
                <form method="POST" action="{{route('dashboard.apartment.update',$apartment->id)}}"
                      enctype="multipart/form-data">
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
                    <input type="hidden" name="owner_id" class="form-control" value="{{Auth::user()->id}}" id="name">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="type">نوع المنشأة</label>
                            <select name="type" required class="form-control" id="select">
                                <option value="...." selected disabled>اختر نوع المنشأة الخاص بك</option>
                                <option value="0" {{$apartment->type == 0 ? 'selected' :''}}>حاصل</option>
                                <option value="1" {{$apartment->type == 1 ? 'selected' :''}}>منزل</option>
                                <option value="2" {{$apartment->type == 2 ? 'selected' :''}}>شقة</option>
                            </select>

                        </div>
                        <br>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="price" class="text-capitalize">price</label>
                            <input type="number" name="price" class="form-control" value="{{$apartment->price}}"
                                   id="price">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="size" class="text-capitalize">size</label>
                            <input type="number" name="size" class="form-control" value="{{$apartment->size}}"
                                   id="size">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="floor" class="text-capitalize">رقم الطابق</label>
                            <input type="number" name="floor" class="form-control" value="{{$apartment->floor}}"
                                   required id="floor">
                        </div>
                    </div>

                    <div class="form-row" id="all">
                        <div class="form-group col" id="room_number">
                            <label for="room_number" class="text-capitalize">room number</label>
                            <input type="text" name="room_number" class="form-control"
                                   value="{{$apartment->room_number}}" id="room_number">
                        </div>
                        <div class="form-group col">
                            <label for="bathrooms" class="text-capitalize">bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control"
                                   value="{{$apartment->bathrooms}}" id="bathrooms">
                        </div>


                        <div class="form-group col" id="furniture">
                            <h5 class="text-capitalize">furniture</h5>
                            <div>
                                <input class="form-check-input" type="radio"
                                       {{$apartment->furniture == 1 ? 'checked'  :'' }}  name="furniture"
                                       id="gridRadios1"
                                       value="1">
                                <label class="form-check-label mr-4" for="gridRadios1">
                                    يوجد
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio"
                                       {{$apartment->furniture == 0 ? 'checked'  :'' }} name="furniture"
                                       id="gridRadios2"
                                       value="0">
                                <label class="form-check-label mr-4" for="gridRadios2">
                                    لا
                                </label>
                            </div>
                        </div>

                        <div class="form-group col" id="garage">
                            <h5 class="text-capitalize">garage</h5>
                            <div>
                                <input class="form-check-input" type="radio"
                                       {{$apartment->garage == 1 ? 'checked'  :'' }} name="garage" id="garage1"
                                       value="1">
                                <label class="form-check-label mr-4" for="garage1">
                                    يوجد
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio"
                                       {{$apartment->garage == 0 ? 'checked'  :'' }} name="garage" id="garage2"
                                       value="0">
                                <label class="form-check-label mr-4" for="garage2">
                                    لا
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-12">
                            <label for="address" class="text-capitalize">address</label>
                            <input type="text" class="form-control" name="address" value="{{$apartment->address}}"
                                   required id="address">
                        </div>

                        <div class="form-group col-12">
                            <label for="description" class="text-capitalize">description</label>
                            <textarea class="form-control" rows="5" name="description" required
                                      id="description">{{$apartment->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-row thumbs">
                        <div class="form-group col">
                            <label for="images" class="text-capitalize d-block">images</label>
                            <input type="file" name="images[]" id="image"
                                   {{$apartment->images =="" ? 'required' :''}}  multiple>
                            <br>
                            @if(stripos($apartment->images , 'https') !== false)
                                <img src="{{asset($apartment->images)}}" class="img-thumbnail w-25" alt="">
                            @elseif(($apartment->images !=""))
                                @foreach(json_decode($apartment->images) as $key=>$value)
                                    <a href="{{asset($value)}}" data-lightbox="home-images">
                                        <img src="{{asset($value)}}" alt="" class="img-fluid w-25">
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12 text-left">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@push('script')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">

        @if($apartment->type == 0)
        $("#all").css('display', 'none');
        // $("#bathrooms").css('display', 'none');
        // $("#garage").css('display', 'none');
        // $("#furniture").css('display', 'none');

        @endif
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function () {
            readURL(this);
        });

        $("#select").change(function () {
            var e = $(this).val();

            if (e == 0) {
                $("#all").css('display', 'none');
                $("#floor").prop('disabled', true);
            }else if(e == 1){
                $("#floor").prop('disabled', true);
                $("#all").css('display', 'flex');
            }else{
                // $("#room_number").attr('disabled', true);
                $("#floor").prop('disabled', false);
                $("#all").css('display', 'flex');
            }
        });
    </script>
@endpush
