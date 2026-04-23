<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'Login-Medicam') }}</title>-->
<title>Login-Medicam</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('page_login/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
  <link rel="stylesheet" href="{{asset('page_login/css/style.css')}}">
  <script src="{{asset('page_login/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('page_login/js/main.js')}}"></script>
  <style>
        h5 {
            font-size:12px;
            font-weight: normal;
        }
    </style>


</head>
<body>
    <div id="app">
       

        <main class="py-4">

 <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('page_login/images/signin-image2.png')}}" alt="sing up image"></figure>
                        
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action= "{{ route('login') }}">
                         @csrf
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" class ="email @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" placeholder="User Name" required autocomplete="email" autofocus/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" class="pass @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password"/>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="label-agree-term"><span><span></span></span> 
                                 @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                      Forgot Password? 
                                    </a>
                                @endif
                                </label>
                            </div>
                        </form>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        </div>
                        <div >
                            © 2019 All Rights Reserved. Created by &nbsp;<h5></h5> <a href="https://www.darstek.com/"><h5> DARSTEK</h5></a>                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>
</body>
</html>

    
