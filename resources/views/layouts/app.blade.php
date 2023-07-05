<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- modal  --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- jquery link 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    {{-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    
{{-- sidebar  --}}
        <link rel="stylesheet" href="{{ asset('sidebar/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('sidebar/css/style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="{{ asset('sidebar/js/main.js') }}" defer></script>
        <script src="{{ asset('sidebar/js/popper.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    @if(Auth::check())
        <script>
                var sender_id=@json(auth()->user()->id);
                // console.log(sender_id);
                var receiver_id;
        </script>
    
    @endif
</head>
<body id="login_data">
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                  

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                        
                    
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main>
            <div class="div_container">
                <input type="checkbox" name="" id="slide">
                <div class="container">
                    <div class="login_form">
                        <h2>Login</h2>
                        <h5 class="text-danger" id="login_error"></h5>
                        <form method="POST" action="{{ route('login') }}" id="login_submit">
                            @csrf
                        <div class="form_input">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                            <label>Email</label>
                            <input type="text" class="input" name="email" id="email">
                            <h6 class="text-danger" id="email_valid"></h6>
                         
                        </div>
                        <div class="form_input">
                            <span class="icon"></span>
                            <label>Password</label>
                            <input type="password" class="input" name="password" id="password">
                            <h6 class="text-danger" id="password_valid"></h6>
                    
                        </div>
                        <div class="forget-div">
                            {{-- <a href="">Forget Password</a> --}}
                        </div>
                        <div class="login-div">
                            <button class="" >Login</button>
                        </div>
                        
                    </form>
                        <div class="signup-div">
                            Are you not a member? <a href="#"><label for="slide" class="slide" id="register_show">Sign Up</label></a>
                        </div>
                    </div>
                    {{-- <div class="signup_form ">
                            <h2>Register</h2>
                            <form action="" id="signup_formm">
                            <div class="form_input">
                                <span class="icon"></span><label>Full Name</label>
                                <input type="text" class="input" name="name">
                            </div>
                            <div class="form_input">
                                <span class="icon"></span>
                                <label>Email</label>
                                <input type="email" class="input" name="email">
                            </div>
                            <div class="form_input">
                                <span class="icon"></span>
                                <label>Password</label>
                                <input type="password" class="input" id="password" name="password">
                            </div>
                            <div class="form_input">
                                <span class="icon"></span><label>Confirm Password</label>
                                <input type="password" class="input"  id="connfirm_password" name="password_confirmation">
                            </div>
                        
                            <div class="sign-div sign_up_div login-div">
                                <button class="sign-text" type="submit">Sign Up</button>
                            </div>
                        </form>
                            <div class="signup-div">
                                Are you member? <a href="#"><label for="slide" class="slide">Login</label></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </main>
       
        
        {{-- <main class="py-4">
            @yield('content')
            @include('sweetalert::alert')
        </main> --}}
    </div>

    <script>
      
//   function loginForm(){
        //         let password=$('#password').val();
        //         let email=$('#email').val();
        //         $.ajax({
        //                 type: "post",
        //                 url: "{{ route('login') }}",
        //                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //                 data: {
        //                     email:email,
        //                     password:password
        //                 },
        //                 success: function (res) {
        //                     if(res.status==true){
        //                         // $('#login_error').text(res.message);
        //                         window.location.href = "{{ route('home')}}";
        //                     }
        //                     if(res.status==false){
        //                         $('#login_error').text(res.message);
        //                     }
        //                     if(res.status==null && res.data){
        //                         if(res.data.email){
        //                             $('#email_valid').text(res.data.email[0]);
        //                             setTimeout(()=>{
        //                                 $('#email_valid').text('');
        //                             },4000);
        //                         }
        //                         if(res.data.password){
        //                             $('#password_valid').text(res.data.password[0]);
        //                             setTimeout(()=>{
        //                                 $('#password_valid').text('');
        //                             },4000);
        //                         }
                                
        //                     }
        //                 }
        //             });
        
//   }
     $('#login_submit').submit(function(e){
                e.preventDefault();
               let password=$('#password').val();
                let email=$('#email').val();
                $.ajax({
                        type: "post",
                    url: "{{ route('login') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        email:email,
                        password:password
                    },
                    success: function (res) {
                        if(res.status==true){
                            // $('#login_error').text(res.message);
                            window.location.href = "{{ route('home')}}";
                        }
                        if(res.status==false){
                            $('#login_error').text(res.message);
                        }
                        if(res.status==null && res.data){
                            if(res.data.email){
                                $('#email_valid').text(res.data.email[0]);
                                setTimeout(()=>{
                                    $('#email_valid').text('');
                                },6000);
                            }
                            if(res.data.password){
                                $('#password_valid').text(res.data.password[0]);
                                setTimeout(()=>{
                                    $('#password_valid').text('');
                                },6000);
                            }
                            
                        }
                    }
                });
    });
        $('#signup_formm').click(function(e){
            e.preventDefault();
            alert()
        });
        $('#register_show').click(function(e){
            $('.signup_form').show();
        });
        
    </script>
</body>
</html>
