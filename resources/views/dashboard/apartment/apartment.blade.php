@extends("dashboard.app")

@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">المنشأت</h1>
{{--            <a href="{{route('dashboard.apartment.create')}}" class="btn btn-primary float-left">--}}
{{--                <i class="fa fa-plus"></i>--}}
{{--                Add Apartment--}}
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
                            <th>Type</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Room Number</th>
                            <th>Bathrooms</th>
                            <th>Address</th>
                            <th>Furniture</th>
                            <th>Rating</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Room Number</th>
                            <th>Bathrooms</th>
                            <th>Address</th>
                            <th>Furniture</th>
                            <th>Rating</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($apartments as $apartment)
                            <tr>
                                <td>{{$apartment->id}}</td>
                                <td>{{$apartment->owner->user->name}}</td>
                                <td>
                                    @if($apartment->type == 0)
                                        <div class="alert alert-secondary text-center font-weight-bold" role="alert">
                                            حاصل
                                        </div>
                                    @else
                                        <div class="alert alert-success text-center font-weight-bold" role="alert">
                                            منزل
                                        </div>
                                    @endif
                                </td>
                                <td>{{$apartment->size}} متر </td>
                                <td>{{$apartment->price}} $</td>
                                <td>{{$apartment->room_number}}</td>
                                <td>{{$apartment->bathrooms}}</td>
                                <td>{{Str::limit($apartment->address,20)}}</td>
                                <td>{{$apartment->furniture}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary">
                                        <span class="badge badge-light">{{$apartment->rating}}</span>
                                    </button>
                                </td>
                                <td>
                                    @if($apartment->status == '0')
                                        <a href="{{route('dashboard.apartment.status',$apartment->id)}}" class="btn btn-warning">
                                            No Active
                                        </a>
                                    @else
                                        <a href="{{route('dashboard.apartment.status',$apartment->id)}}" class="btn btn-secondary">
                                            Active
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::user()->role == 1)
                                        <a href="{{route('dashboard.apartment.show',$apartment->id)}}"
                                           class="btn btn-success text-white shadow">
                                            <i class="fa fa-eye"></i>
                                            Show
                                        </a>
                                    @else
                                        <a href="{{route('dashboard.apartment.show',$apartment->id)}}"
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
