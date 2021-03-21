@extends("dashboard.app")

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">إضافة المنشأة</h1>

        <div class="card shadow mb-4 p-3">
            <form method="POST" action="{{route("dashboard.apartment.store")}}" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf

                    <input type="hidden" name="owner_id" class="form-control" value="{{Auth::user()->id}}" id="name">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="type">نوع المنشأة</label>
                            <select name="type" required class="form-control" id="select">
                                <option value="...." selected disabled>اختر نوع المنشأة الخاص بك</option>
                                <option value="0">حاصل</option>
                                <option value="1">منزل</option>
                                <option value="2">شقة</option>
                            </select>
                        </div>
                        <br>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="price" class="text-capitalize">price</label>
                            <input type="number" name="price" class="form-control" required id="price">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="size" class="text-capitalize">size</label>
                            <input type="number" name="size" class="form-control" required id="size">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="floor" class="text-capitalize">رقم الطابق</label>
                            <input type="number" name="floor" class="form-control" required id="floor">
                        </div>
                    </div>

                    <div class="form-row" id="all">
                        <div class="form-group col" id="room_number">
                            <label for="room_number" class="text-capitalize">room number</label>
                            <input type="text" name="room_number" class="form-control"
                                   value="" id="room_number">
                        </div>
                        <div class="form-group col">
                            <label for="bathrooms" class="text-capitalize">bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control"
                                   value="" id="bathrooms">
                        </div>

                        <div class="form-group col" id="furniture">
                            <h5 class="text-capitalize">furniture</h5>
                            <div>
                                <input class="form-check-input" type="radio" name="furniture" id="gridRadios1"
                                       value="1">
                                <label class="form-check-label mr-4" for="gridRadios1">
                                    يوجد
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="furniture" id="gridRadios2"
                                       value="0">
                                <label class="form-check-label mr-4" for="gridRadios2">
                                    لا
                                </label>
                            </div>
                        </div>
                        <div class="form-group col" id="garage">
                            <h5 class="text-capitalize">garage</h5>
                            <div>
                                <input class="form-check-input" type="radio" name="garage" id="garage1"
                                       value="1">
                                <label class="form-check-label mr-4" for="garage1">
                                    يوجد
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="radio" name="garage" id="garage2"
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
                            <input type="text" class="form-control" name="address" required id="address">
                        </div>

                        <div class="form-group col-12">
                            <label for="description" class="text-capitalize">description</label>
                            <textarea class="form-control" name="description" required id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="images" class="text-capitalize">images</label>
                            <h5 style="color: red">* الرجاء ادخال الصور من غير عنوان واضح او معلم واضح أو كتابة الايميل او رقم الجوال ع الصور</h5>
                            <input type="file" name="images[]" required multiple>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col text-left">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@push('script')

    <script type="text/javascript">

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
