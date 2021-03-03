@extends("dashboard.app")

@section("content")
    @push("style")
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">عرض معلومات المنشأة</h1>

        <div class="card shadow mb-4 p-3">
            <div class="card-body">
                <form  method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" disabled value="{{$apartment->owner->user->name}}" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">نوع</label>
                            <select name="type" disabled class="form-control">
                                <option value="{{$apartment->type}}">{{$apartment->type ? 'منزل' : 'حاصل'}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="price" class="text-capitalize">price</label>
                            <input type="number" name="price" class="form-control" disabled value="{{$apartment->price}}" id="price">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="size" class="text-capitalize">size</label>
                            <input type="number" name="size" class="form-control" disabled value="{{$apartment->size}}" id="size">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="room_number" class="text-capitalize">room number</label>
                            <input type="text" name="room_number" class="form-control" disabled
                                   value="{{$apartment->room_number}}" id="room_number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bathrooms" class="text-capitalize">bathrooms</label>
                            <input type="text" name="bathrooms" class="form-control" disabled
                                   value="{{$apartment->bathrooms}}" id="bathrooms">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="furniture" class="text-capitalize">furniture</label>
                            <input type="text" class="form-control" disabled value="{{$apartment->furniture}}" id="furniture">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="garage" class="text-capitalize">garage</label>
                            <input type="text" class="form-control" disabled value="{{$apartment->garage}}" id="garage">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="rating" class="text-capitalize">rating</label>
                            <input type="text" class="form-control" disabled value="{{$apartment->rating}}" id="rating">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="address" class="text-capitalize">address</label>
                            <input type="text" class="form-control" disabled value="{{$apartment->address}}" id="address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="description" class="text-capitalize">description</label>
                            <textarea class="form-control" disabled id="description">{{$apartment->description}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row thumbs">
                        <div class="form-group col">
                            <label for="images" class="text-capitalize d-block">images</label>
{{--                            {{dd(stripos($apartment->images , 'https'))}}--}}
                            @if(stripos($apartment->images , 'https') !== false)
                                <img src="{{asset($apartment->images)}}" class="img-thumbnail w-25" alt="">
                            @else
                                @foreach(json_decode($apartment->images) as $key=>$value)
                                    <a href="{{asset($value)}}" data-lightbox="home-images">
                                        <img src="{{asset($value)}}" alt="" class="img-fluid w-25">
                                    </a>
                                @endforeach
                            @endif
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
@endpush
