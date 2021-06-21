@extends("dashboard.app")

@section("content")
    @push("style")
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">تعديل المعلومات الشخصية</h1>

        <div class="card shadow mb-4 p-3">
            <div class="card-body">
                <form  method="POST" action="{{route('dashboard.users.update', $user->id)}}" enctype="multipart/form-data">
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

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">الاسم</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" id="email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">رقم الجوال</label>
                            <input type="text" name="phone" class="form-control" value="{{$user->phone}}" id="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="text-capitalize">الصورة الشخصية</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <img id="blah" src="{{asset($user->image)}}" alt="your image" class="img-thumbnail w-50"/>
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">كلمة السر الحالية</label>
                            <input type="password" name="current_password" class="form-control"  id="phone">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">كلمة السر الجديدة</label>
                            <input type="password" name="password" class="form-control" id="phone">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">
                                 تأكيد كلمة السر الجديدة
                            </label>
                            <input type="password" name="password_confirmation" class="form-control" id="phone">
                        </div>
                    </div>

                    <hr>

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
