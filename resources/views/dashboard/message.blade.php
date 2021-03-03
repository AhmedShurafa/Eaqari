@extends("dashboard.app")

@section("content")


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">الرسائل</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            @if(Auth::user()->role == 1)
                                <th>Owner</th>
                            @endif
                            <th>Apartment</th>
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
                            @if(Auth::user()->role == 1)
                                <th>Owner</th>
                            @endif
                            <th>Apartment</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ssn</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($messages as $index=>$message)
                            <tr>
                                <td>{{$index+1}}</td>

                                @if(Auth::user()->role == 1)
                                    <td>{{$message->owner->user->name}}</td>
                                @endif
                                <td>
                                    @if($message->apartment->type == 0)
                                        حاصل
                                    @else
                                        منزل
                                    @endif
                                </td>
                                <td>{{$message->name}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->phone}}</td>
                                <td>{{$message->ssn}}</td>
                                <td>
                                    <a href="{{route("message.show",$message->id)}}}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-eye"></i>
                                        Show
                                    </a>
                                    <a class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("message.destroy",$message->id)}}'>
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </a>
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


    <!-- show Modal-->
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
