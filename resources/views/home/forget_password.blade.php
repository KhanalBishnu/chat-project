@extends('home.index')
@section('content')


<div class=" Sign_div_container_forget">

        <div class="signup_form login_form ">
            <h2 class="text-center">Forget Password</h2>
            <form id="change_password_form" >
                @csrf
                <input type="hidden" name="id"  id="id" value="{{ $user->id }}">
                <div class="form_input">
                    <span class="icon"></span>
                    <label>New Password</label>
                    <input type="password" class="input" id="password" name="password"><br>
                    @error('password') <small class="text-danger">{{ $message }}</small>@enderror
                   <strong> <small class="text-danger" id="password_error"></small></strong>
                </div>
                <div class="form_input">
                    <span class="icon"></span><label>Confirm Password</label>
                    <input type="password" class="input" id="confirm_password" name="confirm_password">
                    @error('confirm_password') <small class="text-danger">{{ $message }}</small>@enderror

                   <strong> <small class="text-danger" id="confirm_password_error"></small></strong>
                </div>

                <div class="sign-div sign_up_div login-div">
                    {{-- <button class="sign-text" type="submit">Submit</button> --}}
                    <a onclick="ChangePassword()" class="sign-text" id="sign_up_button">Submit</a>
                </div>
            </form>
           
        </div>


    </div>


   <script>
       $('.nav_container').hide();
       $('.home').remove();
       $('.div_container').hide();
       $('.buttom_extra').remove();
       $('#content_body').css('opacity',0);
       $('#content_body').remove('content-body');

function ChangePassword(){
    
    let password=$('#password').val(); 
    let confirm_password=$('#confirm_password').val(); 
    let id=$('#id').val(); 
    $.ajax({
        type: "post",
        url: "{{ route('ChangePassword') }}",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            password:password,
            confirm_password:confirm_password,
            id:id,
        },
        success: function (res) {
            $('#password_error').text('');
            $('#confirm_password_error').text('');
            if(res.status){
                Swal.fire({
                    title: 'Password Change',
                    text: res.message,
                    icon: 'success'
                });
                window.location.href= "{{ route('frontHome') }}";
            }
            if(res.status==false){
                if(res.message.password){
                    $('#password_error').text(res.message.password);
                }
                if(res.message.confirm_password){
                    $('#confirm_password_error').text(res.message.confirm_password);
                }
            }
            if(res.status==null){
                Swal.fire({
                    title: 'Error',
                    text: res.message,
                    icon: 'error'
                });
            }
        }
    });
}


   </script>
@endsection