@extends("dashboard.app")

@section("content")


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">السماسرة</h1>

            <a href="{{route('dashboard.users.create')}}" class="btn btn-primary float-left">
                <i class="fa fa-plus"></i>
                Add User
            </a>
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
                            <th>Rating</th>
                            <th>Status</th>
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
                            <th>Evaluate</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->owner->phone}}</td>
                                <td>{{$user->owner->ssn}}</td>
                                <td>
                                    <h3 class="btn btn-primary">
                                        <span class="badge badge-light">{{$user->owner->evaluate}}</span>
                                    </h3>
                                </td>
                                <td>
                                    @if($user->owner->status == '0')
                                        <a href="{{route('dashboard.user.status',$user->id)}}" class="btn btn-warning">
                                            No Active
                                        </a>
                                    @else
                                        <a href="{{route('dashboard.user.status',$user->id)}}" class="btn btn-secondary">
                                            Active
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('dashboard.users.show',$user->id)}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-eye"></i>
                                        Show
                                    </a>

                                    <button class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.users.destroy",$user->owner->id)}}'>
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

            // alert(id);

            $('.modal_delete').attr('action',id);

        });

    </script>
@endpush
