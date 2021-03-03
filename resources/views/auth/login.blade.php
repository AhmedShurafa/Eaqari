@extends("layouts.app")

@section("content")

@include("layouts._header")
  <section id="login" class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h4>
                <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
              </h4>

            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                    <label for="email" class="col-form-label text-md-right">البريد الإلكتروني</label>{{--{{ __('E-Mail Address') }}--}}

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                  <label for="password2">كلمة السر</label>
                  <input type="password" name="password" class="form-control" required>
                </div>

                <input type="submit" value="Login" class="btn btn-secondary btn-block">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@include("layouts._footer")

@endsection
