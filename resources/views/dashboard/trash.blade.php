@extends('dashboard.app')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">سلة المحذوفات</h1>
        </div>

    <div class="table-responsive p-3 mb-4" style="background-color: #FFF">
        <!-- Page Heading -->

        <h1 class="h3 mb-4 text-gray-800 d-inline-block">المستثمرين</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Ssn</th>
                    <th>Action</th>
                </tr>
            </thead>
            <thead class="thead-light">
                <tr>
                    @forelse($owners as $owner)
                        <th scope="col">{{$owner->user->name}}</th>
                        <th scope="col">{{$owner->user->email}}</th>
                        <th scope="col">{{$owner->phone}}</th>
                        <th scope="col">{{$owner->ssn}}</th>
                        <th scope="col">
                            <a href="{{route('dashboard.restore.owner',$owner->id)}}" class="btn btn-warning">
                                <i class="fas fa-trash-restore"></i>
                                Recovery
                            </a>
                        </th>
                    @empty
                        <h3>لا يوجد</h3>
                    @endforelse
                </tr>
            </thead>
        </table>
    </div>


    <div class="table-responsive p-3 mb-4" style="background-color: #FFF">
            <!-- Page Heading -->

            <h1 class="h3 mb-4 text-gray-800 d-inline-block">المنشأت</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <thead>
                <tr>
                    @forelse($apartments as $apartment)
                        <th scope="col">{{$apartment->owner->user->name}}</th>
                        <th scope="col">
                            @if($apartment->type == 0)
                                <div role="alert">
                                    حاصل
                                </div>
                            @else
                                <div role="alert">
                                    منزل
                                </div>
                            @endif
                        </th>
                        <th scope="col">{{$apartment->size}}</th>
                        <th scope="col">{{$apartment->price}}</th>
                        <th scope="col">{{Str::limit($apartment->address,30)}}</th>
                        <th scope="col">
                            <a href="{{route('dashboard.restore.apartment' , $apartment->id)}}" class="btn btn-warning">
                                <i class="fas fa-trash-restore"></i>
                                Recovery
                            </a>
                        </th>
                    @empty
                        <h3>لا يوجد</h3>
                    @endforelse
                </tr>
                </thead>
            </table>
        </div>


    <div class="table-responsive p-3 mb-4" style="background-color: #FFF">
            <!-- Page Heading -->

            <h1 class="h3 mb-4 text-gray-800 d-inline-block">الرسائل</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Owner</th>
                    <th>Apartment</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                </thead>
                <thead>
                <tr>
                    @forelse($messages as $message)
                        <th scope="col">{{$message->owner->user->name}}</th>
                        <th scope="col">
                            @if($message->type == 0)
                                <div role="alert">
                                    حاصل
                                </div>
                            @else
                                <div role="alert">
                                    منزل
                                </div>
                            @endif
                        </th>
                        <th scope="col">{{$message->name}}</th>
                        <th scope="col">{{$message->email}}</th>
                        <th scope="col">{{$message->phone}}</th>
                        <th scope="col">
                            <a href="{{route('dashboard.restore.message' , $message->id)}}" class="btn btn-warning">
                                <i class="fas fa-trash-restore"></i>
                                Recovery
                            </a>
                        </th>
                    @empty
                        <h3>لا يوجد</h3>
                    @endforelse
                </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection
