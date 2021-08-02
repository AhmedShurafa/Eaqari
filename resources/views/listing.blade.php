@extends("layouts.app")

@section("content")

@include("layouts._header")

  <section id="showcase-inner" class="py-5 text-white">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h1 class="display-4" id="name">{{$apartment->Property->name}}</h1>
          <p class="lead">
            <i class="fas fa-map-marker"></i>{{$apartment->address}}</p>
        </div>
      </div>
    </div>
  </section>


  <!-- Listing -->
  <section id="listing" class="py-5">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('success'))
            <p class="alert alert-info">{{ Session::get('success') }}</p>
        @endif
      <div class="row">
        <div class="col-md-9">
          <!-- Home Main Image -->

              @foreach(json_decode($apartment->images) as $key=>$value)
                  @if($loop->first)
                    <img src="{{asset($value)}}" alt="" class="img-main img-fluid mb-3">
                    <!-- Thumbnails -->
                    <div class="row mb-5 thumbs">
                    @continue
                  @endif
                  <div class="col-md-2">
                      <a href="{{asset($value)}}" data-lightbox="home-images">
                          <img src="{{asset($value)}}" alt="" class="img-fluid">
                      </a>
                  </div>
              @endforeach
          </div>
          <!-- Fields -->
          <div class="row mb-5 fields">
            <div class="col-md-6">
              <ul class="list-group list-group-flush">
                <li class="list-group-item text-secondary">
                  <i class="fas fa-money-bill-alt"></i> Asking Price:
                  <span class="float-right">{{$apartment->price}}</span>
                </li>


                @if ($apartment->property_types_id != 1)

                <li class="list-group-item text-secondary">
                    <i class="fas fa-bed"></i> Bedrooms:
                    <span class="float-right">{{$apartment->room_number}}</span>
                  </li>
                  <li class="list-group-item text-secondary">
                    <i class="fas fa-bath"></i> Bathrooms:
                    <span class="float-right">{{$apartment->bathrooms}}</span>
                  </li>

                @endif
{{--                <li class="list-group-item text-secondary">--}}
{{--                  <i class="fas fa-car"></i> Garage:--}}
{{--                  <span class="float-right">{{$apartment->garage}}--}}
{{--                  </span>--}}
{{--                </li>--}}
              </ul>
            </div>
            <div class="col-md-6">
              <ul class="list-group list-group-flush">
                <li class="list-group-item text-secondary">
                  <i class="fas fa-square"></i> Lot Size:
                  <span class="float-right">{{$apartment->size}} م
                      <sup>2</sup>
                  </span>
                </li>
                <li class="list-group-item text-secondary">
                  <i class="fas fa-calendar"></i> Listing Date:
                  <span class="float-right">{{$apartment->created_at->format('Y-N-d')}}</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Description -->
          <div class="row mb-5">
            <div class="col-md-12">
              {{$apartment->description}}
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card mb-3">
            <img class="card-img-top" src="{{asset($apartment->owner->image)}}" alt="Seller of the month">
            <div class="card-body">
              <h5 class="card-title">{{$apartment->owner->name}}</h5>
              <div>
                  @for($i=0;$i < $apartment->owner->evaluate;++$i)
                    <span class="fa fa-star checked"></span>
                  @endfor

                  @for($i=0;$i < (5 - $apartment->owner->evaluate);++$i)
                      <span class="fa fa-star"></span>
                  @endfor
              </div>
            </div>
          </div>
        @if(Auth::guard('customer')->check())
          <button class="btn-primary btn-block btn-lg" id="message" data-owner="{{$apartment->owner->id}}"
                  data-apartment="{{$apartment->id}}" data-toggle="modal"
                  data-target="#inquiryModal">تواصل مع السمسار</button>
        @else
        <a class="btn-primary btn-block btn-lg text-center text-decoration-none" href="{{route('login')}}"
                data-target="#inquiryModal">تواصل مع السمسار</a>
        @endif
        </div>
      </div>
    </div>
  </section>
@if(Auth::guard('customer')->check())
  <!-- Inquiry Modal -->
  <div class="modal fade" id="inquiryModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inquiryModalLabel">تواصل مع السمسار</h5>
          <button type="button" class="close m-0 p-0" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('message.store')}}" method="post">
              @csrf
            <div class="form-group">
              <label for="property_name" class="col-form-label">المنشأة:</label>
              <input type="text" class="form-control"
                     value="{{$apartment->Property->name .' - '. $apartment->Area->name .' - '. $apartment->address }}"
                     id="Name" readonly>
              <input type="hidden" name="owners_id" id="owner_id" class="form-control" value="{{$apartment->owner->id}}">
              <input type="hidden" name="properties_id" id="apartment_id" class="form-control" value="{{$apartment->id}}">
              <input type="hidden" name="customers_id" id="customer_id" class="form-control" value="

                @if(Auth::guard('customer')->check())
                    {{Auth::guard('customer')->user()->id}}
                @endif
                  " readonly>
            </div>
            <div class="form-group">
              <label class="col-form-label">الرسالة</label>
              <textarea name="description" class="form-control" rows="10" required></textarea>
            </div>
            <hr>
            <input type="submit" value="Send" class="btn btn-block btn-secondary">
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
@include("layouts._footer")
@endsection
@push('script')
        <script>
            $("#message").click(function () {
                var owner = $(this).data('owner');
                var apartment = $(this).data('apartment');
                var name = $("#name").va();
                console.log(name);
                $('#owner_id').val(owner);
                $('#apartment_id').val(apartment);
                $('#Name').val(name);
            });
        </script>
@endpush
