@extends("dashboard.app")

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">منشأتي</h1>
            <a href="{{route('dashboard.apartment.create')}}" class="btn btn-primary float-left">
                <i class="fa fa-plus"></i>
                Add Apartment
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>رقم</th>
                            <th>نوع المنشأة</th>
                            <th>المساحة</th>
                            <th>السعر</th>
                            <th>عدد الغرف</th>
                            <th>عدد الحمام</th>
                            <th>العنوان</th>
                            <th>الحدث</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>رقم</th>
                            <th>نوع المنشأة</th>
                            <th>المساحة</th>
                            <th>السعر</th>
                            <th>عدد الغرف</th>
                            <th>عدد الحمام</th>
                            <th>العنوان</th>
                            <th>الحدث</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($apartments as $index => $apartment)
                            <tr>
                                <td>
                                    {{$index+1}}
                                </td>
                                <td>
                                    <div class="alert alert-info text-center font-weight-bold p-2" role="alert">
                                        {{$apartment->Property->name}}
                                    </div>
                                </td>
                                <td>{{$apartment->size}}</td>
                                <td>{{$apartment->price}}</td>
                                <td>{{$apartment->room_number}}</td>
                                <td>{{$apartment->bathrooms}}</td>
                                <td>{{Str::limit($apartment->address,30)}}</td>
                                <td>
                                    @if(Auth::guard('web')->check())
                                        <a href="{{route('dashboard.apartment.show',$apartment->id)}}"
                                           class="btn btn-success text-white shadow">
                                            <i class="fa fa-eye"></i>
                                            Show
                                        </a>
                                    @else
                                        <a href="{{route('dashboard.owner.edit',$apartment->id)}}"
                                           class="btn btn-info text-white shadow">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                    @endif
                                    <button class="btn btn-danger text-white shadow delete d-inline-block"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.apartment.destroy",$apartment->id)}}'>
                                        <i class="fa fa-trash"></i>
                                        Delete
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
