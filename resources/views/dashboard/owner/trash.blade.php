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

            <h1 class="h3 mb-4 text-gray-800 d-inline-block">المنشأت</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th> نوع العقار</th>
                    <th>
                        المساحة

                         م<sup>2</sup>
                    </th>
                    <th>السعر $</th>
                    <th>العنوان</th>
                    <th>الحدث</th>
                </tr>
                </thead>
                <thead>
                    @forelse($apartments as $key=>$apartment)
                    <tr>
                        <th scope="col">{{$key+1}}</th>
                        <th scope="col">
                            {{$apartment->Property->name}}
                        </th>
                        <th scope="col">{{$apartment->size}}</th>
                        <th scope="col">{{$apartment->price}}</th>
                        <th scope="col">{{Str::limit($apartment->address,30)}}</th>
                        <th scope="col">
                            <a href="{{route('dashboard.restore.apartment' , $apartment->id)}}" class="btn btn-warning">
                                <i class="fas fa-trash-restore"></i>
                                استرجاع
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



@endsection
