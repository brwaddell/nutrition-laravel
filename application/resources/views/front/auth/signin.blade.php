<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Login | Childhood Nutrition</title>
        <meta name="description" content="Nutrition" />
        <meta name="keywords" content="Nutrition" />
        <meta name="author" content="Nutrition" />
        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" href="{{isset($site->image3) ? asset(path_site_favicon_image().$site->image3) : Avatar::create(auth()->user()->name)->toBase64()}}" type="image/x-icon">
        <!-- fonts file -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- css file  -->
        <link rel="stylesheet" href="{{ asset('front/assets/css/plugins.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
        <script src="{{ asset('front/assets/js/modernizr-3.11.2.min.js') }}"></script>
    </head>
    <body>
        <!-- preloader start -->
        <div class="preloader">
            <div class="loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <!-- preloader end -->
        <div class="register-area">
            <div class="register-wrap">
                <div class="register-form">
                    <h2 class="form-title text-center mb-55">Login to your account</h2>
                    @if($errors->any())
                        <div class="alert alert-danger text-center" role="alert">
                            {{$errors->first()}}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="useremail">Email or username</label>
                            <input type="email" class="form-control" id="useremail" name="email" placeholder="Email or username" value="{{ old('email') }}" autocomplete="email" autofocus />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" />
                            <span class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            {{-- <a href="{{url('password/forget')}}" class="forgot-password float-right">Forgot password?</a> --}}
                        </div>
                        <button type="submit" class="register-btn">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/plugins.js') }}"></script>
        <script src="{{ asset('front/assets/js/main.js') }}"></script>
    </body>
</html>

