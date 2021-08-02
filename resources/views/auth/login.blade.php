@extends("layouts.app")

@section("content")

@include("layouts._header")

  <section id="login" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h4>
                <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
              </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.handleLogin') }}" class="ahmed">
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
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>


                  @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                </div>

                <input type="submit" value="Login" class="btn btn-secondary btn-block">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
    <footer id="main-footer" class="py-4 bg-primary text-white text-center" style="
    position:absolute;
    left:0px;
    width:100%;
    bottom: 0px;
    ">
    Copyright &copy;
    <span class="year">2021</span> Eaqari
    </footer>

@endsection
