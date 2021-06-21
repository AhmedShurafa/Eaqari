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
                    @forelse($owners as $owner)
                    <tr>
                        <th scope="col">{{$owner->name}}</th>
                        <th scope="col">{{$owner->email}}</th>
                        <th scope="col">{{$owner->phone}}</th>
                        <th scope="col">{{$owner->ssn}}</th>
                        <th scope="col">
                            <a href="{{route('dashboard.restore.owner',$owner->id)}}" class="btn btn-warning">
                                <i class="fas fa-trash-restore"></i>
                                Recovery
                            </a>
                        </th>
                    </tr>
                    @empty
                    <tr>
                        <h3>لا يوجد</h3>
                    </tr>
                    @endforelse
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
                    @forelse($apartments as $apartment)
                    <tr>
                        <th scope="col">{{$apartment->owner->name}}</th>
                        <th scope="col">
                            {{$apartment->Property->name}}
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
                    </tr>
                    @empty
                    <tr>
                        <h3>لا يوجد</h3>
                    </tr>
                    @endforelse
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
                    @forelse($messages as $message)
                        <tr>
                            <th scope="col">{{$message->owner->name}}</th>
                            <th scope="col">
                               {{$message->apartment->Property->name}}
                            </th>
                            <th scope="col">{{$message->customer->name}}</th>
                            <th scope="col">{{$message->customer->email}}</th>
                            <th scope="col">{{$message->customer->phone}}</th>
                            <th scope="col">
                                <a href="{{route('dashboard.restore.message' , $message->id)}}" class="btn btn-warning">
                                    <i class="fas fa-trash-restore"></i>
                                    Recovery
                                </a>
                            </th>
                        </tr>
                            @empty
                        <h3>لا يوجد</h3>
                    @endforelse

                </thead>
            </table>
        </div>



        <div class="table-responsive p-3 mb-4" style="background-color: #FFF">
            <!-- Page Heading -->

            <h1 class="h3 mb-4 text-gray-800 d-inline-block">العمليات التجارية</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>المستثمر</th>
                    <th>العقار</th>
                    <th>اسم الزبون</th>
                    <th>رقم جوال الزبون</th>
                    <th>التفاصيل</th>
                    <th>الحدث</th>
                </tr>
                </thead>
                <thead>
                @forelse($transactions as $index=>$transaction)
                    <tr>
                        <td>{{$index+1}}</td>

                        <td>{{$transaction->owner->name}}</td>
                        <td>
                            {{$transaction->apartment->Property->name}}
                        </td>
                        <td>{{$transaction->customer->name}}</td>
                        <td>{{$transaction->customer->phone}}</td>
                        <td>{{$transaction->detalis}}</td>

                        <th scope="col">
                            <a href="{{route('dashboard.restore.Transaction' , $transaction->id)}}" class="btn btn-warning">
                                <i class="fas fa-trash-restore"></i>
                                Recovery
                            </a>
                        </th>
                    </tr>
                @empty
                    <tr>
                        <h3>لا يوجد</h3>
                    </tr>
                @endforelse

                </thead>
            </table>
        </div>

    </div>
@endsection
