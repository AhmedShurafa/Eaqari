@extends("dashboard.app")

@section("content")
    @push("style")
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">عرض معلومات السمسار</h1>

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
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="{{$user->email}}" id="email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ssn" class="text-capitalize">ssn</label>
                            <input type="number" name="ssn" class="form-control" value="{{$user->owner->ssn}}" id="ssn">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">phone</label>
                            <input type="text" name="phone" class="form-control" value="{{$user->owner->phone}}" id="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="instagram" class="text-capitalize">phone2</label>
                            <input type="text" name="phone2" class="form-control" value="{{$user->owner->phone2}}" id="phone">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="facebook" class="text-capitalize">facebook</label>
                            <input type="text" class="form-control" name="facebook" value="{{$user->owner->facebook}}" id="facebook">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="instagram" class="text-capitalize">instagram</label>
                            <input type="text" class="form-control" name="instagram" value="{{$user->owner->instagram}}" id="instagram">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="twitter" class="text-capitalize">twitter</label>
                            <input type="text" class="form-control" name="twitter" value="{{$user->owner->twitter}}" id="twitter">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="text-capitalize">image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <img id="blah" src="{{asset($user->owner->image)}}" alt="your image" class="img-thumbnail w-50"/>
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
