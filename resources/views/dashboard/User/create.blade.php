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
                <form action="{{ route('dashboard.owners.update',$owner->id) }}" method="POST">
                    @csrf
                    @method('put')

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
                            <input type="text" name="name" value="{{ $owner->name }}" disabled class="form-control" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="text" name="email" value="{{ $owner->email }}" disabled class="form-control" id="email">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ssn" class="text-capitalize">رقم الهوية</label>
                            <input type="number" name="ssn" value="{{ $owner->ssn }}" disabled class="form-control" id="ssn">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ssn" class="text-capitalize">التقييم</label>
                            <input type="number" name="evaluate" min="0" max="5" value="{{ $owner->evaluate }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone" class="text-capitalize">رقم الجوال</label>
                            <input type="number" name="phone" value="{{ $owner->phone }}" disabled class="form-control" id="phone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="instagram" class="text-capitalize">رقم جوال اخر</label>
                            <input type="number" name="phone2" value="{{ $owner->phone2 }}" disabled class="form-control" id="phone">
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="row">
                              <legend class="col-form-label col-sm-2 pt-0">حالة المستثمر</legend>
                              <div class="col-sm-10">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="1" @if($owner->status == 1) checked @endif>
                                  <label class="form-check-label h4 pr-4" for="gridRadios1">
                                    مفعل
                                  </label>

                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="status" id="gridRadios2"  value="0" @if($owner->status == 0) checked @endif>
                                  <label class="form-check-label h4 pr-4" for="gridRadios2">
                                    غير مفعل
                                  </label>
                                </div>
                              </div>
                            </div>
                            </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="text-capitalize">الصورة الشخصية</label><br>
                            <img id="blah" src="{{ asset($owner->image) }}" onerror="this.src='{{ asset('avatar/user.png') }}'" alt="your image" class="img-profile w-25"/>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col text-left">
                            <button class="btn btn-primary" type="submit">تعديل</button>
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
@endpush
