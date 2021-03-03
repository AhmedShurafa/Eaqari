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
                    <input type="hidden" name="owner_id" class="form-control" value="{{Auth::user()->id}}" id="name">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="email">نوع</label>
                            <select name="type" class="form-control" id="select">
                                <option value="0" {{$apartment->type == 0 ? 'selected' :''}}>حاصل</option>
                                <option value="1" {{$apartment->type == 1 ? 'selected' :''}}>منزل</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price" class="text-capitalize">price</label>
                            <input type="number" name="price" class="form-control"  value="{{$apartment->price}}" id="price">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="size" class="text-capitalize">size</label>
                            <input type="number" name="size" class="form-control"  value="{{$apartment->size}}" id="size">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6" id="room_number">
                            <label for="room_number" class="text-capitalize">room number</label>
                            <input type="text" name="room_number" class="form-control"
                                   value="{{$apartment->room_number}}" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bathrooms" class="text-capitalize">bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control"
                                   value="{{$apartment->bathrooms}}" id="bathrooms">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6" id="furniture">
                            <label for="furniture" class="text-capitalize">furniture</label>
                            <input type="text" class="form-control" name="furniture"  value="{{$apartment->furniture}}" >
                        </div>
                        <div class="form-group col-md-6" id="garage">
                            <label for="garage" class="text-capitalize">garage</label>
                            <input type="text" class="form-control" name="garage"  value="{{$apartment->garage}}" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="address" class="text-capitalize">address</label>
                            <input type="text" class="form-control" name="address"  value="{{$apartment->address}}" id="address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="description" class="text-capitalize">description</label>
                            <textarea class="form-control" rows="5" name="description" id="description">{{$apartment->description}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row thumbs">
                        <div class="form-group col">
                            <label for="images" class="text-capitalize d-block">images</label>
                            <input type="file" name="images[]" id="image" {{$apartment->images =="" ? 'required' :''}}  multiple>
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
            $("#room_number").css('display', 'none');
            $("#garage").css('display', 'none');
            $("#furniture").css('display', 'none');
        @endif
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

        $("#select").change(function () {
            var e = $(this).val();
            if (e == 0) {
                $("#room_number").css('display', 'none');
                $("#garage").css('display', 'none');
                $("#furniture").css('display', 'none');
            } else {
                $("#room_number").css('display', 'block');
                $("#furniture").css('display', 'block');
                $("#garage").css('display', 'block');
            }
        });
    </script>
@endpush
