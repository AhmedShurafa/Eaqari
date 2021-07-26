@extends("dashboard.app")

@section("content")
    @push("style")
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">عرض معلومات سمسار</h1>

        <div class="card shadow mb-4 p-3">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
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
                            <input type="text" name="name" value="{{ $owner->name }}" disabled class="form-control" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ $owner->email }}" disabled class="form-control" id="email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssn" class="text-capitalize">ssn</label>
                            <input type="number" name="ssn" value="{{ $owner->ssn }}" disabled class="form-control" id="ssn">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssn" class="text-capitalize">التقييم</label>
                            <input type="number" name="evaluate" value="{{ $owner->evaluate }}" disabled class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">phone</label>
                            <input type="number" name="phone" value="{{ $owner->phone }}" disabled class="form-control" id="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="instagram" class="text-capitalize">phone2</label>
                            <input type="number" name="phone2" value="{{ $owner->phone2 }}" disabled class="form-control" id="phone">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="image" class="text-capitalize">image</label><br>
                            <img id="blah" src="{{ asset($owner->image) }}" onerror="this.src='{{ asset('avatar/user.png') }}'" alt="your image" class="img-profile w-25"/>
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
                    $('#blah').attr('src', e.target.result).css('display','block');
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
@endpush
