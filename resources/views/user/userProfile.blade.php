@extends('frontend.post.main')
@section('content')
<div class="container-fluid mt-5  pt-4">
    
    <div class="profileColor">My Profile</div>
    
    <div class="detailsContainer">
        <div class="imageSection">
        <img  src="{{ $user->hasMedia('user_image')?$user->getMedia('user_image')[0]->getFullUrl():'' }}" alt="">
            <form id="myForm" >
                <div id="user_image">
                    <input type="hidden" id="user_id" value="{{ $user->id }}">
                    <label for="image" class="form-label"></label>
                    <input  type="file" name="img" id="img" class="form-control" onchange="submitImage()">
               </div>
                <div class="">
                  <p class="text-secondary">Just choose image </p>
                </div>
    
            </form>
        </div>
        <div class="detailSection">
            <p class="form-p" for="name">Name
            <span class="info_user_profile">{{ $user->name }}</span></p> 
            <p class="form-p" for="name">Roll No <span class="info_user_profile">{{ $user->id }}</span></p> 
            <p class="form-p" for="name">Email<span class="info_user_profile">{{ $user->email }}</span></p> 
            
            <label class="form-label" for="name">Password</label> 

            <button type="button" class="btn btn-info btn-sm mt-2 mb-3 mx-4 px-4" data-bs-toggle="modal" data-bs-target="#myModal">Password
                Change</button>
                        {{-- <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#myModal">Open Small Modal</button> --}}
        </div>
    </div>
  
    
</div>
{{-- modal  --}}
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Password Change</h4>
                <button type="button" class="btn btn-default float-end" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <form  id="password_change" action="{{ route('user_password',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}" id="user_id">
                    <br>
                    <label for="current_password">Current Password </label>
                    <input type="text" name="current_password" id="current_password" class="form-control">
                    @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    <small class="text-danger" id="current_password_error"></small>
                    <br>
                    <label for="new_password">New Password </label>
                    <input type="text" name="new_password" id="new_password" class="form-control">
                    @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                    <small class="text-danger" id="new_password_error"></small>


                    <br>
                    <label for="confirm_password">Confirm Password </label>
                    <input type="text" name="confirm_password" id="confirm_password" class="form-control">
                    @error('confirm_password') <small class="text-danger">{{ $message }}</small> @enderror
                    <small class="text-danger" id="confirn_password_error"></small>

                    <br>
                    {{-- <input type="submit" value="Confirm" class="form-control"> --}}
                    <a onclick="passwordFormValidation()" class="btn btn-primary float-end">Update</a>

                </form>
            </div>
            <div class="modal-footer">
               
            </div>
        </div>

    </div>
</div>


<script>
    // password change form  validation
    function passwordFormValidation(){
        let id=$('#user_id').val();
        let allField=$('#password_change').find('input');
        let error=0;
        $.each(allField, function (indexInArray, element) { 
            let NextEl=$(element).next();
            if($(NextEl).prop("tagName")=="SPAN"){
                $(NextEl).remove();
            }
             let name=element.name;
             let type=element.type;
             let val=element.value;

             if(type=="text"){
                 if(val=="" || val==null || val==undefined){
                    $(`<span class="text-danger">The ${name} field is required</span>`).insertAfter($(element));
                    $(element).addClass('border border-danger');
                    setTimeout(()=>{
                        $(element).removeClass('border border-danger');
                    },2000);
                    setTimeout(()=>{
                        let NextEl=$(element).next();
                        if($(NextEl).prop("tagName")=="SPAN"){
                            $(NextEl).remove();
                        }
                    },6000);
                    error++;
                 }
                 
             }
        });
        // if(error<=0){

            let pass1=$('#new_password').val();
            let pass2=$('#confirm_password').val();

            // if(pass1==pass2){
                let current_password=$('#current_password').val();
                let new_password=$('#new_password').val();
                let confirm_password=$('#confirm_password').val();
                let url=  "{{ route('user_password',':id') }}";
                url=url.replace(':id',id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {current_password:current_password,new_password:new_password,confirm_password:confirm_password} ,
                    success: function (res) {
                      
                        $(".modal-backdrop").remove();
                        if(res.status){
                            $('#password_change')[0].reset();
                            $.notify(res.message,'success');
                            $('#myModal').hide();
                        }
                     
                        if(res.status==false){
                            $('#password_change')[0].reset();

                           $.notify(res.message,'error');
                        }
                        if(res.status==null){
                            // backend validation error through
                            if(res.data.current_password){
                                $("#current_password_error").text(res.data.current_password[0]);
                            }
                            if(res.data.new_password){
                                $("#new_password_error").text(res.data.new_password[0]);
                            }
                            if(res.data.confirm_password){
                                $("#confirn_password_error").text(res.data.confirm_password[0]);
                            }
                        }

                    },
                    error: function (res) {
                        console.log(res);
                    }
                });
        //     }
        //     else{
        //         $('#confirn_password_error').text('The Confirm Password Does not Match');
        //         setTimeout(()=>{
        //             $('#confirn_password_error').text('');
        //         },5000);
        //     }
        // }
       
    }
       

    function submitImage() {
        let myForm = document.getElementById('myForm');
        let url="{{ route('ProfileChange',':id') }}";
        var user_id=$('#user_id').val();
        url=url.replace(':id',user_id);
        const formData = new FormData(myForm);
        let imgField = document.getElementById('img');
        formData.append('img',imgField.files[0]);
        fetch(url,{
            method : 'post',
            headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
            body : formData
        }).then(function (res) { 
                
           
            return res.json();
            
         }).then(function( data){
            if(data.src!=''){
                    $('#profile_image_display').empty();
                    $('#profile_image_display').append(' <img  src="'+data.src+'" alt="" style="height:200px;weight:150px">');
                    window.location.reload();

                }
         }).catch(function (err) { 
             console.log(err);
             
          })

    }

</script>
@endsection