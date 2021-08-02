@extends("dashboard.app")

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block"> المنشأت - حواصل</h1>
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
                            <th>ID</th>
                            @if(Auth::guard('web')->check())
                                <th>الاسم</th>
                            @endif
                            <th>Type</th>
                            <th>Area</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Address</th>
                            @if(Auth::guard('web')->check())
                                <th>نفعيل</th>
                                <th>مشهور</th>
                            @endif
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            @if(Auth::guard('web')->check())
                                <th>الاسم</th>
                            @endif
                            <th>Type</th>
                            <th>Area</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Address</th>
                            @if(Auth::guard('web')->check())
                                <th>نفعيل</th>
                                <th>مشهور</th>
                            @endif
                            <th>Action</th>
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
                                    @if($apartment->type == 0)
                                        <div class="alert alert-secondary text-center font-weight-bold p-2" role="alert">
                                            حاصل
                                        </div>
                                    @elseif($apartment->type == 1)
                                        <div class="alert alert-success text-center font-weight-bold p-2" role="alert">
                                            منزل
                                        </div>
                                    @else
                                        <div class="alert alert-info text-center font-weight-bold p-2" role="alert">
                                            شقة
                                        </div>
                                    @endif
                                </td>
                                <td>{{$apartment->Area->name}}</td>
                                <td>{{$apartment->size}} متر </td>
                                <td>{{$apartment->price}} $</td>
                                <td>{{Str::limit($apartment->address,20)}}</td>

                                @if(Auth::guard('web')->check())

                                <td>
                                    @if($apartment->status == '0')
                                        <a href="{{route('dashboard.apartment.stauts',$apartment->id)}}" class="btn btn-warning">
                                            غير مفعل
                                        </a>
                                    @elseif($apartment->status == '1')
                                        <a href="{{route('dashboard.apartment.stauts',$apartment->id)}}" class="btn btn-primary">
                                            مفعل
                                        </a>
                                    @else
                                        <p class="btn btn-primary text-white">
                                            محذوف من قبل صاحب العقار
                                        </p>
                                    @endif
                                </td>

                                <td>
                                    @if($apartment->famous == '0')
                                        <a href="{{route('dashboard.apartment.famous',$apartment->id)}}" class="btn btn-warning">
                                            غير مفعل
                                        </a>
                                    @else
                                        <a href="{{route('dashboard.apartment.famous',$apartment->id)}}" class="btn btn-secondary">
                                            مفعل
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
                                        <button class="btn btn-danger text-white shadow delete d-inline-block"
                                                data-target='#custom-width-modal' data-toggle='modal'
                                                data-row='{{route("dashboard.apartment.destroy",$apartment->id)}}'>
                                            <i class="fa fa-trash"></i>
                                            Suspend
                                        </button>
                                    @else
                                        <a href="{{route('dashboard.apartment.edit',$apartment->id)}}"
                                           class="btn btn-info tex  t-white shadow">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>

                                        <button class="btn btn-danger text-white shadow delete d-inline-block"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.apartment.stauts",$apartment->id)}}'>
                                        <i class="fa fa-trash"></i>
                                        Suspend
                                    </button>
                                    @endif

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
            console.log(id);
            $('.modal_delete').attr('action',id);
        });
    </script>
@endpush
