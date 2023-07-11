<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="div_container">

        <div class="login_form">
            <h5 class="text-danger" id="login_error"></h5>
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}" id="login_submit">
                <!-- @csrf -->
                <div class="form_input" style="--i:1">
                    <label>Email</label>
                    <span class="icon animation_icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="input" name="email" id="email">
                    <h6 class="text-danger" id="email_valid"></h6>

                </div>
                <div class="form_input" style="--i:2">
                    <span style="display:none;" onclick="passwordIconHide()"
                        class="icon1 animation_icon password_icon_hide"><i class="fa-solid fa-eye-slash"></i></span>
                    <span onclick="passwordIcon()" class="icon1 animation_icon password_icon_show"><i
                            class="fa-solid fa-eye"></i></span>
                    <label>Password</label>
                    <input type="password" class="input" name="password" id="password">
                    <h6 class="text-danger" id="password_valid"></h6>

                </div>
                <div class="forget-div">
                    <a class="forget-signup" href="">Forget Password</a>
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
    <div class="Sign_div_container" style="display:none;">

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
                    <input type="email" class="input" name="email" id="name">
                    <small class="text-danger" id="sign_up_email_valid"></small>
                </div>
                <div class="form_input">
                    <span class="icon"></span>
                    <label>Password</label>
                    <input type="password" class="input" id="password" name="password"><br>
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
        function passwordIcon(){
    document.querySelector('input[type="password"]').type = "text";
    $('.password_icon_show').hide()
    $('.password_icon_hide').show()
   
   
}
function passwordIconHide(){
    document.querySelector('#password').type = "password";
    $('.password_icon_show').show()
    $('.password_icon_hide').hide()
   
}
function login_open(){
   
    $('.Sign_div_container').hide()
    $('.div_container').show()
   
}
function signUpForm(){
   
    $('.Sign_div_container').show()
    $('.div_container').hide()
   
}
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
                            },4000);
                        }
                        if(res.data.password){
                            $('#password_valid').text(res.data.password[0]);
                            setTimeout(()=>{
                                $('#password_valid').text('');
                            },4000);
                        }
                        
                    }
                }
            });
    });
    $('#signup_formm').submit(function(e){
            e.preventDefault();
            let password=$('#password').val();
            let confirm_password=$('#connfirm_password').val();
            let email=$('#email').val();
            let name=$('#name').val();
            $.ajax({
                    type: "post",
                    
                url: "{{ route('register') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    email:email,
                    password:password,
                    name:name,
                    password_confirmation:confirm_password
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
                            $('#sign_up_email_valid').text(res.data.email);
                            setTimeout(()=>{
                                $('#sign_up_email_valid').text('');
                            },4000);
                        }
                        if(res.data.name){
                            $('#sign_up_name_valid').text(res.data.name);
                            setTimeout(()=>{
                                $('#sign_up_name_valid').text('');
                            },4000);
                        }
                        if(res.data.password){
                            $('#signup_password_valid').text(res.data.password);
                            setTimeout(()=>{
                                $('#signup_password_valid').text('');
                            },4000);
                        }
                      
                        
                    }
                }
            });
    });

    // function signupValidation(){
        //     let allField=$('#signup_formm').find('input');
        //     let error=0;
        //     let password=$('#password').val();
        //     let confirm_password=$('#connfirm_password').val();
        //     var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        //     $.each(allField, function (indexInArray, element) { 
        //          let name=element.name;
        //          let type=element.type;
        //          let val=element.value;
        //          let NextEl=$(element).next();
        //          if($(NextEl).prop("tagName")=="SMALL"){
        //              $(NextEl).remove();
        //          }
        //          if(type=="text" || type=="password" ){
        //              if(val=="" || val==null){
        //                 $(`<small class="text-danger">Required ${name} field!</small>`).insertAfter($(element));
        //              error++;
        //                 setTimeout(()=>{
        //                        if($(element).next().prop("tagName")=="SMALL"){
        //                            $(element).next().remove();
        //                        }
        //                     },4000);
        //              }else{

        //                 if(type=="password" && val.length<7 && name=="password"){
        //                     $(`<small class="text-danger"> Password must be at least 8 character</small>`).insertAfter($(element));
        //                     error++;
        //                     setTimeout(()=>{
        //                        if($(element).next().prop("tagName")=="SMALL"){
        //                            $(element).next().remove();
        //                        }
        //                     },4000);
        //                 }
        //              }

        //          }
        //          if(type=="email" ){
        //             if(val=="" || val==null){
        //                 $(`<small class="text-danger">Required ${name} field!</small>`).insertAfter($(element));
        //                 error++;
        //                 setTimeout(()=>{
        //                        if($(element).next().prop("tagName")=="SMALL"){
        //                            $(element).next().remove();
        //                        }
        //                     },4000);
        //             }else{
        //                 if(!val.match(validRegex)){
        //                     error++;
        //                     $(`<small class="text-danger">Invalide Email format</small>`).insertAfter($(element));
        //                     setTimeout(()=>{
        //                        if($(element).next().prop("tagName")=="SMALL"){
        //                            $(element).next().remove();
        //                        }
        //                     },4000);
        //                 }
        //             }
        //          }
        //     });
            
        //     if(password && confirm_password){

        //         if(password!=confirm_password){
        //             error++;
        //             $('#password_error').text('Password and Confirm password does not match');
        //             setTimeout(()=>{
        //                 $('#password_error').text('');
        //             },4000);
        //         }else{
                    
        //         }
        //     }
        //     debugger
        //     if(error<=0){
        //         // $('#signup_formm').submit();      
                // document.querySelector('#sign_up_button').type = "submit";  
        //     }
    // }
  


    </script>
</body>

</html>