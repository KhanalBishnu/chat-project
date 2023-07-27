<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css"> --}}
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
   


</head>

<body>

    <section id="loading">
        <div id="loading-content"></div>
        <p style="display:none" id="loading-content-p">Please Wait ... </p>
    </section>

    <div class="nav_container">
        <div class="navbar">
            <a class="nav_a" href="">Chats.</a>
            <div class="na_link">
                @if(auth()->user())
                <a href="{{ route('home') }}">Home</a>
                @else
                <a onclick="login_open()">Login</a>
                <a onclick="signUpForm()">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
    @if(session('message'))
    <div class="text-danger">{{ session('message') }}</div>
    @endif
   
    <div class="home" id="content_body">
        <div class="home_content">
            <img src="{{ asset('/image/final.jpg') }}" alt="">

        </div>
        <div class="content-body" id="textWelcome">
            <h5>WELCOME</h5>
        </div>
        <div class="child">

            <h3>Connect to your Friend!</h3>
        </div>
    </div>

    <div class="extra">
        <h4></h4>
    </div>
    <div class="left_extra">
        <h4></h4>
    </div>
    @yield('content')
    <div class="buttom_extra">
        <h2>Welcome To Chat System</h2>
    </div>

    <div class="div_container both" style="display:none;">

        <div class="login_form">
            <h5 class="text-danger" id="login_error"></h5>
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}" id="login_submit">
                <!-- @csrf -->
                <div class="form_input" style="--i:1">
                    <label>Email</label>
                    <span class="icon animation_icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="input" name="email" id="email">
                    <small class="text-danger" id="email_valid"></small>

                </div>
                <div class="form_input" style="--i:2">
                    <span style="display:none;" onclick="passwordIconHide()"
                        class="icon1 animation_icon password_icon_hide"><i class="fa-solid fa-eye-slash"></i></span>
                    <span onclick="passwordIcon()" class="icon1 animation_icon password_icon_show"><i
                            class="fa-solid fa-eye"></i></span>
                    <label>Password</label>
                    <input type="password" class="input" name="password" id="password">
                    <small class="text-danger" id="password_valid"></small>

                </div>
                <div class="forget-div">
                    <a class="forget-signup" id="forget_password_a" onclick="ForgetPassword()">Forget Password</a>
                </div>
                <div class="login-div">
                    <button class="">Login</button>
                </div>

            </form>
            <div class="signup-div ">
                Are you not a member? <a onclick="signUpForm()" class="forget-signup" href="#">Sign Up</a>
            </div>
        </div>
    </div>
    <div class="Sign_div_container both" style="display:none;">

        <div class="signup_form login_form ">
            <h5 class="text-danger" id="login_error"></h5>
            <h2>Register</h2>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="signup_formm">
                @csrf
                <div class="form_input">
                    <span class="icon"></span><label>Full Name</label>
                    <input type="text" class="input" name="name" id="name">
                    <small class="text-danger" id="sign_up_name_valid"></small>
                </div>
                <div class="form_input">
                    <span class="icon"></span>
                    <label>Email</label>
                    <input type="email" class="input" name="email" id="signup_email">
                    <small class="text-danger" id="sign_up_email_valid"></small>
                </div>
                <div class="form_input">
                    <span class="icon"></span>
                    <label>Password</label>
                    <input type="password" class="input" id="signup_password" name="password"><br>
                    <small class="text-danger" id="signup_password_valid"></small>
                </div>
                <div class="form_input">
                    <span class="icon"></span><label>Confirm Password</label>
                    <input type="password" class="input" id="connfirm_password" name="password_confirmation">
                    <span class="text-danger" id="password_error"></span>
                </div>

                <div class="sign-div sign_up_div login-div">
                    <button class="sign-text" type="submit">Sign Up</button>
                    {{-- <a onclick="signupValidation()" class="sign-text" id="sign_up_button">Sign Up</a> --}}
                </div>
            </form>
            <div class="loginbutton-div">
                Are you member? <a onclick="login_open()" class="login_open" id="login_open">Login</label></a>
            </div>
        </div>


    </div>

    <script>
        function passwordIcon() {
            document.querySelector('input[type="password"]').type = "text";
            $('.password_icon_show').hide()
            $('.password_icon_hide').show()


        }

        function passwordIconHide() {
            document.querySelector('#password').type = "password";
            $('.password_icon_show').show()
            $('.password_icon_hide').hide()

        }

        function login_open() {

            $('.Sign_div_container').hide()
            $('.div_container').show()

        }

        function signUpForm() {

            $('.Sign_div_container').show()
            $('.div_container').hide()

        }
        $('#login_submit').submit(function(e) {
            e.preventDefault();
            let password = $('#password').val();
            let email = $('#email').val();
            $.ajax({
                type: "post",
                url: "{{ route('login') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email: email,
                    password: password
                },
                success: function(res) {
                    if (res.status == true) {
                        // $('#login_error').text(res.message);
                        window.location.href = "{{ route('home') }}";
                    }
                    if (res.status == false) {
                        $('#login_error').text(res.message);
                    }
                    if (res.status == null && res.data) {
                        if (res.data.email) {
                            $('#email_valid').text(res.data.email[0]);
                            setTimeout(() => {
                                $('#email_valid').text('');
                            }, 4000);
                        }
                        if (res.data.password) {
                            $('#password_valid').text(res.data.password[0]);
                            setTimeout(() => {
                                $('#password_valid').text('');
                            }, 4000);
                        }

                    }
                }
            });
        });
        $('#signup_formm').submit(function(e) {
            e.preventDefault();
            let password = $('#signup_password').val();
            let confirm_password = $('#connfirm_password').val();
            let email = $('#signup_email').val();
            let name = $('#name').val();
            $.ajax({
                type: "post",

                url: "{{ route('register') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email: email,
                    password: password,
                    name: name,
                    password_confirmation: confirm_password
                },
                success: function(res) {
                    if (res.status == true) {
                        Swal.fire({
                            title: "Your Registration Completed Successfully",
                            html: `your email is <strong> ${email}</strong> <br> your password is <strong> ${password}</strong>`,
                            confirmButtonText: "Go to Login",
                            showLoaderOnConfirm: true,


                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            if (result.value) {

                                window.location.reload();

                            }else{
                                $('#signup_formm')[0].reset();
                            }
                        });


                    }
                    if (res.status == false) {
                        $('#login_error').text(res.message);
                    }
                    if (res.status == null && res.data) {
                        if (res.data.email) {
                            $('#sign_up_email_valid').text(res.data.email);
                            setTimeout(() => {
                                $('#sign_up_email_valid').text('');
                            }, 4000);
                        }
                        if (res.data.name) {
                            $('#sign_up_name_valid').text(res.data.name);
                            setTimeout(() => {
                                $('#sign_up_name_valid').text('');
                            }, 4000);
                        }
                        if (res.data.password) {
                            $('#signup_password_valid').text(res.data.password);
                            setTimeout(() => {
                                $('#signup_password_valid').text('');
                            }, 4000);
                        }


                    }
                }
            });
        });

        function ForgetPassword() { 
            Swal.fire({
            title: 'Enter Email Address',
            input: 'email',
            inputLabel: 'Email',
            inputPlaceholder: 'Enter email address',
            showCancelButton: true,
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel',
            preConfirm: (email) => {
                if (email && !isValidEmail(email)) {
                Swal.showValidationMessage('Invalid email address');
                } else if (email) {
                    $('#loading').addClass('loading');
                     $('#loading-content').addClass('loading-content');
                     $('#loading-content-p').addClass('loading-content-p');
                  sendEmail(email);
                } else {
                Swal.showValidationMessage('Email address is required');
                }
            }
            });

            function isValidEmail(email) {  
                var regex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
                return regex.test(email);
            }

            function sendEmail(email){
                $.ajax({
                    type: "POST",
                    url: "{{ route('forgetPassword') }}",
                    headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    data: {
                         email:email,
                         },
                    success: function (res) {
                        if(res.status){
                            $('#loading').removeClass('loading');
                            $('#loading-content').removeClass('loading-content');
                            $('#loading-content-p').removeClass('loading-content-p');
                            Swal.fire({
                                title: 'Email Sent',
                                text: 'Email sent successfully',
                                icon: 'success'
                            });
                        }else{
                            Swal.fire({
                                title: 'Oops...',
                                text: res.message,
                                icon: 'error',
                                });
                        }
                    }
                });
            }
           


         }

    </script>
</body>

</html>