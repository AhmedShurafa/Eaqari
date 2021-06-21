@extends("dashboard.app")

@section("content")


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">السماسرة</h1>

{{--            <a href="{{route('dashboard.users.create')}}" class="btn btn-primary float-left">--}}
{{--                <i class="fa fa-plus"></i>--}}
{{--                Add User--}}
{{--            </a>--}}
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ssn</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ssn</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($owners as $owner)
                            <tr>
                                <td>{{$owner->id}}</td>
                                <td>{{$owner->name}}</td>
                                <td>{{$owner->email}}</td>
                                <td>{{$owner->phone}}</td>
                                <td>{{$owner->ssn}}</td>
{{--                                <td>--}}
{{--                                    <h3 class="btn btn-primary">--}}
{{--                                        <span class="badge badge-light">{{$owner->evaluate}}</span>--}}
{{--                                    </h3>--}}
{{--                                </td>--}}
                                <td>
                                    <a href="{{route('dashboard.owners.show',$owner->id)}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-eye"></i>
                                        Show
                                    </a>
                                    <button class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.owners.destroy",$owner->id)}}'>
                                        <i class="fa fa-trash"></i>
                                        Suspend
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

            // alert(id);

            $('.modal_delete').attr('action',id);

        });

    </script>
@endpush
