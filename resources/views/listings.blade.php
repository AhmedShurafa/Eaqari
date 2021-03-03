@extends("layouts.app")
@section("content")

    @include("layouts._header")

    <section id="showcase-inner" class="py-5 text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                    <h1 class="display-4">تصفح عقاراتنا</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Listings -->
    <section id="listings" class="py-4">
        <div class="container">
            <div class="row">

            @foreach($apartments as $apartment)
                <!-- Listing 1 -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card listing-preview">
{{--                            <img class="card-img-top" src="{{asset($apartment->images)}}" alt="">--}}

                            @foreach(json_decode($apartment->images) as $key)
                                @if($loop->first)
                                    <img class="card-img-top figure-img rounded" style="height: 250px" src="{{$key}}" alt="">
                                @else
                                    @break
                                @endif
                            @endforeach
                                        <div class="card-img-overlay">
                                            <h2>
                                                <span class="badge badge-secondary text-white">{{$apartment->price}}</span>
                                            </h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="listing-heading text-center">
{{--                                                <h4 class="text-primary">45 Drivewood Circle</h4>--}}
                                                <p>
                                                    <i class="fas fa-map-marker text-secondary m-1"></i>{{Str::limit($apartment->address,20)}}</p>
                                            </div>
                                            <hr>
                                            <div class="row py-2 text-secondary">
                                                <div class="col-6">
                                                    <i class="fas fa-th-large"></i> Sqft: {{$apartment->size}}</div>
                                                <div class="col-6">
                                                    <i class="fas fa-car"></i> Garage: {{$apartment->garage== '0' ? 'لا يوجد' : 'يوجد'}}</div>
                                            </div>
                                            <div class="row py-2 text-secondary">
                                                <div class="col-6">
                                                    <i class="fas fa-bed"></i> Bedrooms: {{$apartment->room_number}}</div>
                                                <div class="col-6">
                                                    <i class="fas fa-bath"></i> Bathrooms: {{$apartment->bathrooms}}</div>
                                            </div>
                                            <hr>
                                            <div class="row py-2 text-secondary">
                                                <div class="col-12">
                                                    <i class="fas fa-user"></i> {{$apartment->owner->user->name}}</div>
                                            </div>
                                            <div class="row text-secondary pb-2">
                                                <div class="col-6">
                                                    <i class="fas fa-clock"></i> {{$apartment->created_at->diffForHumans() }}</div>
                                            </div>
                                            <hr>
                                            <a href="{{route('house',$apartment->id)}}" class="btn btn-primary btn-block">More Info</a>
                                        </div>
                                    </div>
                        </div>

            @endforeach
                    </div>

                    <div   class="row">
                        <div class="col-md-12">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">&laquo;</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">&raquo;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
    </section>

    @include("layouts._footer")

@endsection
