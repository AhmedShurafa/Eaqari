@extends("layouts.app")
@section("content")

  @include("layouts._header")

  <!-- Showcase -->
  <section id="showcase" style="min-height: 550px">
    <div class="container text-center">
      <div class="home-search p-5">
        <div class="overlay p-5">
          <h1 class="display-4 mb-5">
              البحث عن العقارات أصبح سهلاً للغاية
          </h1>
{{--          <p class="lead">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae quas, asperiores eveniet vel nostrum magnam--}}
{{--            voluptatum tempore! Consectetur, id commodi!</p>--}}
          <div class="search">
            <form action="{{route('house.search')}}" method="get">
                @csrf
              <!-- Form Row 1 -->
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label class="sr-only">المكان</label>
                  <input type="text" name="place" class="form-control" placeholder="المكان">
                </div>

                  <div class="col-md-4 mb-3">
                      <label class="sr-only">نوع المنشأة</label>
                          <select name="type_place" class="form-control">
                              <option selected="true" disabled="disabled">نوع المنشأة</option>
                              <option value="0">حاصل</option>
                              <option value="1">منزل</option>
                          </select>
                  </div>

                  <div class="col-md-4 mb-3">
                      <label class="sr-only">المساحة</label>
                      <input type="number" name="size" class="form-control" placeholder="المساحة">
                  </div>
              </div>
              <!-- Form Row 2 -->
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label class="sr-only">عدد الغرف</label>
                  <select name="bedrooms" class="form-control">
                    <option selected="true" disabled="disabled">عدد الغرف</option><!-- Bedrooms-->
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="sr-only">السعر</label>
                    <input type="text" name="price" class="form-control" placeholder="السعر $">
                </div>
              </div>
              <button class="btn btn-secondary btn-block mt-4" type="submit">بحث</button><!-- Submit form-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Listings -->
  <section id="listings" class="py-5">
    <div class="container">
      <h3 class="text-center mb-3">أحدث المنشأة </h3><!-- Max Price-->
      <div class="row">
        <!-- Listing 1 -->
        @foreach($apartment as $value)
              <div class="col-md-6 col-lg-4 mb-4">
                  <div class="card listing-preview">
                      @foreach(json_decode($value->images) as $key)
                        @if($loop->first)
                            <img class="card-img-top figure-img rounded" style="height: 250px;" src="{{asset($key)}}" alt="">
                        @else
                            @break
                        @endif
                      @endforeach
                      <div class="card-img-overlay">
                          <h2>
                              <span class="badge badge-secondary text-white">$ {{$value->price}}</span>
                          </h2>
                      </div>
                      <div class="card-body">
                          <div class="listing-heading text-center">
                              {{--                <h4 class="text-primary">45 Drivewood Circle</h4>--}}
                              <p>
                                  <i class="fas fa-map-marker text-secondary m-1"></i>{{Str::limit($value->address,20)}}</p>
                          </div>
                          <hr>
                          <div class="row py-2 text-secondary">
                              <div class="col-6">
                                  <i class="fas fa-th-large"></i> Sqft: {{$value->size}}</div>
                              <div class="col-6">
                                  <i class="fas fa-car"></i> Garage: {{$value->garage}}</div>
                          </div>
                          <div class="row py-2 text-secondary">
                              <div class="col-6">
                                  <i class="fas fa-bed"></i> Bedrooms: {{$value->room_number}}</div>
                              <div class="col-6">
                                  <i class="fas fa-bath"></i> Bathrooms: {{$value->bathrooms}}</div>
                          </div>
                          <hr>
                          <div class="row py-2 text-secondary">
                              <div class="col-12">
                                  <i class="fas fa-user"></i> {{$value->owner->user->name}}</div>
                          </div>
                          <div class="row text-secondary pb-2">
                              <div class="col-6">
                                  <i class="fas fa-clock"></i>
                                  {{$value->created_at->diffForHumans()}}
                              </div>
                          </div>
                          <hr>
                          <a href="{{route('house',$value->id)}}" class="btn btn-primary btn-block">قراءة المزيد</a>{{--More Info--}}
                      </div>
                  </div>
              </div>
{{--              {!! $value -> links() !!}--}}
          @endforeach
            <div class="justify-content-center">
               <div class="text-center">
                   {!! $apartment -> render () !!}
               </div>

            </div>
      </div>
    </div>
  </section>

{{--  <section id="services" class="py-5 bg-secondary text-white">--}}
{{--    <div class="container">--}}
{{--      <div class="row text-center">--}}
{{--        <div class="col-md-4">--}}
{{--          <i class="fas fa-comment fa-4x mr-4"></i>--}}
{{--          <hr>--}}
{{--          <h3>Consulting Services</h3>--}}
{{--          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis nam! Repudiandae, provident iste consequatur--}}
{{--            hic dignissimos ratione ea quae.</p>--}}
{{--        </div>--}}
{{--        <div class="col-md-4">--}}
{{--          <i class="fas fa-home fa-4x mr-4"></i>--}}
{{--          <hr>--}}
{{--          <h3>Propery Management</h3>--}}
{{--          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis nam! Repudiandae, provident iste consequatur--}}
{{--            hic dignissimos ratione ea quae.</p>--}}
{{--        </div>--}}
{{--        <div class="col-md-4">--}}
{{--          <i class="fas fa-suitcase fa-4x mr-4"></i>--}}
{{--          <hr>--}}
{{--          <h3>Renting & Selling</h3>--}}
{{--          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, debitis nam! Repudiandae, provident iste consequatur--}}
{{--            hic dignissimos ratione ea quae.</p>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </section>--}}

  @include("layouts._footer")

@endsection
