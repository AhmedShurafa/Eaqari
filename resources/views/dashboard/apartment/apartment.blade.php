@extends("dashboard.app")

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">المنشأت</h1>
            @if(!Auth::guard('web')->check())
                <a href="{{route('dashboard.apartment.create')}}" class="btn btn-primary float-left">
                    <i class="fa fa-plus"></i>
                    إضافة منشأة
                </a>
            @endif
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>رقم</th>
                            @if(Auth::guard('web')->check())
                                <th>الاسم</th>
                            @endif
                            <th>النوع</th>
                            <th>المساحة</th>
                            <th>السعر</th>
                            <th>عدد الغرف</th>
                            <th>عدد الحمامات</th>
                            <th>العنوان</th>
                            @if(Auth::guard('web')->check())
                                <th>مشهور</th>
                            @endif
                            <th>الحدث</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>رقم</th>
                            @if(Auth::guard('web')->check())
                                <th>الاسم</th>
                            @endif
                            <th>النوع</th>
                            <th>المساحة</th>
                            <th>السعر</th>
                            <th>عدد الغرف</th>
                            <th>عدد الحمامات</th>
                            <th>العنوان</th>
                            @if(Auth::guard('web')->check())
                                <th>مشهور</th>
                            @endif
                            <th>الحدث</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($apartments as $apartment)
                            <tr>
                                <td>{{$apartment->id}}</td>
                                @if(Auth::guard('web')->check())
                                    <td>{{$apartment->owner->name}}</td>
                                @endif
                                <td>
                                    <div class="alert alert-info text-center font-weight-bold p-2" role="alert">
                                        {{$apartment->Property->name}}
                                    </div>
                                </td>
                                <td>{{$apartment->size}} متر </td>
                                <td>{{$apartment->price}} $</td>
                                <td>{{$apartment->room_number}}</td>
                                <td>{{$apartment->bathrooms}}</td>
                                <td>{{Str::limit($apartment->address,20)}}</td>
                                @if(Auth::guard('web')->check())
                                    <td>
                                        @if($apartment->famous == '0')
                                            <a href="{{route('dashboard.apartment.famous',$apartment->id)}}" class="btn btn-warning">
                                                No Active
                                            </a>
                                        @else
                                            <a href="{{route('dashboard.apartment.famous',$apartment->id)}}" class="btn btn-secondary">
                                                Active
                                            </a>
                                        @endif
                                    </td>
                                @endif

                                <td>
                                    @if(Auth::guard('web')->check())
                                        <a href="{{route('dashboard.apartment.show',$apartment->id)}}"
                                           class="btn btn-success text-white shadow">
                                            <i class="fa fa-eye"></i>
                                            Show
                                        </a>
                                    @else
                                        <a href="{{route('dashboard.apartment.edit',$apartment->id)}}"
                                           class="btn btn-info text-white shadow">
                                            <i class="fa fa-edit"></i>
                                            تعديل
                                        </a>
                                    @endif
                                    <button class="btn btn-danger text-white shadow Suspend d-inline-block"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.apartment.destroy",$apartment->id)}}'>
                                        <i class="fa fa-trash"></i>
                                        تعليق
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <!-- Delete Modal-->
    @include('dashboard.delete')
@endsection

@push('script')
    <script>
        $(".delete").click(function () {
            var id = $(this).data('row');
            $('.modal_delete').attr('action',id);
        });
    </script>
@endpush
