@extends("layouts.app")

@section("content")

    @include("layouts._header")
    <section id="register" class="bg-light py-5">
        <div class="container">
            <div class="">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>
                                <i class="fas fa-user-plus"></i> Register</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email"
                                           class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div>
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">رقم الهوية</label>

                                    <div>
                                        <input id="number" type="number" min="3" max="10"
                                               class="form-control @error('number') is-invalid @enderror"
                                               name="ssn" value="{{ old('number') }}" required>

                                        @error('number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">رقم الجوال</label>

                                    <div>
                                        <input id="phone" type="number" min="3" max="10"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               name="phone" value="{{ old('phone') }}" required>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right"> رقم الجوال اخر
                                    <span>(اختياري)</span>
                                    </label>

                                    <div>
                                        <input id="phone2" type="number" min="3" max="10"
                                               class="form-control @error('phone2') is-invalid @enderror"
                                               name="phone2" value="{{ old('phone2') }}">

                                        @error('phone2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="password"
                                           class="col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="password-confirm"
                                           class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <input type="submit" value="Register" class="btn btn-secondary btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("layouts._footer")

@endsection
