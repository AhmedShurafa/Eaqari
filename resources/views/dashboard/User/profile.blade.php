@extends("dashboard.app")

{{--@section("content")--}}
{{--    @push("style")--}}
{{--        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
{{--    @endpush--}}

{{--    <!-- Begin Page Content -->--}}
{{--    <div class="container-fluid">--}}
{{--        <!-- Page Heading -->--}}
{{--        <h1 class="h3 mb-4 text-gray-800">عرض معلومات السمسار</h1>--}}

{{--        <div class="card shadow mb-4 p-3">--}}
{{--            <div class="card-body">--}}
{{--                <form  method="POST" enctype="multipart/form-data">--}}
{{--                    @csrf--}}

{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="name">Name</label>--}}
{{--                            <input type="text" name="name" class="form-control" disabled value="{{$user->name}}" id="name">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="email">Email</label>--}}
{{--                            <input type="text" name="email" class="form-control" disabled value="{{$user->email}}" id="email">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="ssn" class="text-capitalize">ssn</label>--}}
{{--                            <input type="number" name="ssn" class="form-control" disabled value="{{$user->owner->ssn}}" id="ssn">--}}
{{--                        </div>--}}

{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="ssn" class="text-capitalize">evaluate</label>--}}
{{--                            <input type="number" name="ssn" class="form-control" disabled value="{{$user->owner->evaluate}}" id="ssn">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="phone" class="text-capitalize">phone</label>--}}
{{--                            <input type="text" name="phone" class="form-control" disabled value="{{$user->owner->phone}}" id="phone">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="instagram" class="text-capitalize">phone2</label>--}}
{{--                            <input type="text" name="phone2" class="form-control" disabled value="{{$user->owner->phone2}}" id="phone">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="facebook" class="text-capitalize">facebook</label>--}}
{{--                            <input type="text" class="form-control" disabled value="{{$user->owner->facebook}}" id="facebook">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="instagram" class="text-capitalize">instagram</label>--}}
{{--                            <input type="text" class="form-control" disabled value="{{$user->owner->instagram}}" id="instagram">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="twitter" class="text-capitalize">twitter</label>--}}
{{--                            <input type="text" class="form-control" disabled value="{{$user->owner->twitter}}" id="twitter">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="image" class="text-capitalize">image</label>--}}
{{--                            <img id="blah" src="{{asset('public/'.$user->owner->image)}}" alt="your image" class="img-thumbnail w-50"/>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- /.container-fluid -->--}}
{{--@endsection--}}

{{--@push('script')--}}

{{--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}

{{--    <script type="text/javascript">--}}

{{--        function readURL(input) {--}}
{{--            if (input.files && input.files[0]) {--}}
{{--                var reader = new FileReader();--}}

{{--                reader.onload = function(e) {--}}
{{--                    $('#blah').attr('src', e.target.result);--}}
{{--                }--}}

{{--                reader.readAsDataURL(input.files[0]); // convert to base64 string--}}
{{--            }--}}
{{--        }--}}

{{--        $("#image").change(function() {--}}
{{--            readURL(this);--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

@section("content")
    <div class="container-fluid">
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">عرض معلومات السمسار</h1>
            @if(Auth::id() == $user->id)
                <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-primary float-left">
                    <i class="fa fa-edit"></i>
                    تعديل
                </a>
            @endif
        </div>
    </div>
        <div class="page-content page-container" id="page-content">

            <div class="row d-flex justify-content-center">
                    <div class="col-xl-10 col-md-12">
                        <div class="card user-card-full mt-5 mb-5">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25"> <img src="{{asset($user->owner->image)}}" class="img-radius w-50 rounded-circle" alt="User-Profile-Image"> </div>
                                        <h3 class="f-w-600">{{$user->name}}</h3>
                                        <h4>
                                            @if($user->role == 0)
                                                صاحب عقار
                                            @else
                                                مدير
                                            @endif
                                        </h4> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h3 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400">{{$user->email}}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone</p>
                                                <h6 class="text-muted f-w-400">{{$user->owner->phone}}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone2</p>
                                                <h6 class="text-muted f-w-400">{{$user->owner->phone2}}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Ssn</p>
                                                <h6 class="text-muted f-w-400">{{$user->owner->ssn}}</h6>
                                            </div>
                                        </div>
                                        <h3  class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"> المنشأت :</h3>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="m-b-10 f-w-600">المنازل</h3>
                                                <h4 class="text-muted f-w-400">{{$user->owner->apartment->where('type',1)->count()}}</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <h3 class="m-b-10 f-w-600">الحواصل</h3>
                                                <h4 class="text-muted f-w-400">{{$user->owner->apartment->where('type',0)->count()}}</h4>
                                            </div>
                                        </div>
                                        <ul class="social-link list-unstyled m-t-40 m-b-10 p-0">
                                            <li><a href="https://www.facebook.com/{{$user->owner->facebook}}" title="" data-original-title="facebook" data-abc="true"><i class="fab fa-facebook-square fa-2x"></i></a></li>
                                            <li><a href="https://twitter.com/{{$user->owner->twitter}}"  title="" data-original-title="twitter" data-abc="true"><i class="fab fa-twitter fa-2x" style="color: rgb(29, 161, 242)"></i></a></li>
                                            <li><a href="{{$user->owner->instagram}}" title="" data-original-title="instagram" data-abc="true"><i class="fab fa-instagram-square fa-2x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    @endsection
