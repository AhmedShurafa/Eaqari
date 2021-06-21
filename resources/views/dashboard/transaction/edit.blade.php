@extends("dashboard.app")

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">إضافة معاملة</h1>

        <div class="card shadow mb-4 p-3">
            <form method="POST" action="{{route("dashboard.transaction.update",$transaction->id)}}" enctype="multipart/form-data">
                <div class="card-body">
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

                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="type">المستثمرين</label>
                            <select name="owner_id" required class="form-control" id="select">
                                    <option value="...." selected disabled>اختر المستثمر</option>
                                @foreach($owners as $owner)
                                    <option value="{{$owner->id}}"
                                    @if($transaction->owner_id == $owner->id) selected @endif
                                    >{{$owner->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type">المنشأئت</label>
                            <select name="apartment_id" required class="form-control" id="select">
                                <option value="...." selected disabled>اختر العقار</option>
                                @foreach($apartments as $apartment)
                                    <option value="{{$apartment->id}}"

                                    @if($transaction->apartment_id == $apartment->id) selected @endif
                                    >{{$apartment->Property->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">الزبون</label>
                            <select name="cutomer_id" required class="form-control" id="select">
                                <option value="...." selected disabled>اختر نوع المنشأة الخاص بك</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}"
                                    @if($transaction->cutomer_id == $customer->id) selected @endif
                                    >{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">نوع المعاملة</label>
                            <select name="transaction_type_id" required class="form-control" id="select">
                                <option value="...." selected disabled>اختر نوع المنشأة الخاص بك</option>
                                <option value="1" @if($transaction->transaction_type_id == 1) selected @endif>بيع</option>
                                <option value="2" @if($transaction->transaction_type_id == 2) selected @endif>إستأجار</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-12">
                            <label for="detalis" class="text-capitalize">وصف</label>
                            <textarea class="form-control" name="detalis" required id="detalis">{{$transaction->detalis}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="images" class="text-capitalize">صورة للعقد</label>
                            <input type="file" name="image">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col text-left">
                            <button class="btn btn-primary" type="submit">تعديل</button>
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
