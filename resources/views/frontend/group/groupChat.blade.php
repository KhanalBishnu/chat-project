@extends('frontend.post.main')
<style>
.img-fluid{
    height: 100px;
    width: 100px;
}

</style>
{{-- @extends('layouts.app') --}}
@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        {{-- <div id="testing_div"></div> --}}
        <div class="container-fluid mt-5 pt-3">

        </div>
        @if(count($groups)>0 || count($other_groups)>0)

        <div class="col-lg-3 mt-3">
            <ul class="list-group">
                @foreach ($groups as $group)
                <li id="{{ $group->id }}-select_status"
                    class="list-group-item list-group-item-dark cursor-pointer group_list " data-id="{{ $group->id }}"
                    data-name="  {{ $group->name }}">

                    @if ($group->hasMedia('group_image'))
                    <img src="{{ $group->getMedia('group_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail"
                        style="height:50px;width:80px">
                    @else
                    <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail"
                        style="height:50px;width:80px">
                    @endif
                    {{ $group->name }}
                </li>

                @endforeach
                @foreach ($other_groups as $group)
                <li id="{{ $group->id }}-select_status"
                    class="list-group-item list-group-item-dark cursor-pointer group_list " data-id="{{ $group->id }}"
                    data-name="  {{ $group->name }}">

                    @if ($group->hasMedia('group_image'))
                    <img src="{{ $group->getMedia('group_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail"
                        style="height:50px;width:80px">
                    @else
                    <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail"
                        style="height:50px;width:80px">
                    @endif
                    {{ $group->name }}


                </li>

                @endforeach
            </ul>
        </div>

        <div class="col-lg-9 mt-4">
            <h1 class="start-head">Click For Start Chat</h1>
            <div class="group-chat-section ">
                <div class="group-chat-header">
                    Header 
                </div>
                <div id="memberName"><h5 class="float-right"><i class="fa-solid fa-bars group_member_show"  data-bs-toggle="modal" data-bs-target="#groupMemberShow" ></i></h5></div>
                <div id="group-chat-container">
                    <span id="group_name"></span>


                    {{-- chat here for sender and receiver  --}}

                </div>

         
                <div id="fileDiv">
                     

                    {{-- <img id="pic" class="img-fluid" > --}}
                </div>
             
                {{-- <div id="message-send-section">
                                <form id="imageUpload" enctype="multipart/form-data">
                                    <input type="file" name="file" id="image">
                                    <input type="submit" value="Send Image">
                                </form>

                                <form id="group-chat-form">
                                    <div class="input-group">
                                        <input type="text" name="message" id="message" required placeholder="Enter message" class="form-control">
                                        <button type="submit" id="send_message" class="btn btn-send"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div> --}}
                            
                <div id="message-send-section">
                       
                   
                    <i data-bs-toggle="modal" data-bs-target="#groupPhotosShow"
                        class="fa-solid fa-photo-film group_photo"></i>

                    <form id="group-chat-form" class="message-form upload-form" enctype="multipart/form-data">
                        <div class="input-group">
                            <label for="image" class="upload-label">
                                <i class="fas fa-image"></i>
                            </label>
                            <input type="file" name="file[]" id="image" class="upload-input" multiple>
                            <input type="text" name="message" id="message" placeholder="Enter message"
                                class="form-control">
                                
                            <button type="submit" id="send_message" class="btn btn-send" style="display:none;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        @else
        <div class="container-fluid text-center col-lg-12">
            <h4>User Not Found!</h4>
        </div>
        @endif
    </div>
</div>


<!-- edit groupchat Modal -->
<div class="modal fade" id="groupChatEditModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateGroupMessage') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <input type="hidden" id="groupChat_update_message_id">
                    <input id="groupChat_message" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    {{-- <button type="submit" class="btn btn-primary" >Update</button> --}}
                    <a id="groupChat_message_update_form" class="btn btn-primary">Update</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete groupchat Modal -->
<div class="modal fade" id="groupChatDeleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <h5>Are you sure want to delete this message?</h5>
                    {{-- <input id="groupChat_message"> --}}
                    <input type="hidden" id="groupChat_message_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="groupChat_delete_form" class="btn btn-primary">Confirm</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--photos show  Modal -->
<div class="modal fade" id="groupPhotosShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="galleryShowImage"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!--group member show  Modal -->
<div class="modal fade" id="groupMemberShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Group Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div id="groupMember_show"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function(){
            // for send button
            var message =$('#message');
            var image =$('#image');
        var image_file=image.prop('files');
        
        $('#message').on('input',function(){
            
            $('#send_message').show();
            if(message.val()=="" || message.val()==null ){
                $('#send_message').hide();
            }else{
                $('#send_message').show();
            }
        });
      
        //  // single file upload
                // $('#image').change(function(){
                //     $('#fileDiv').html('');
                //     var element = $(this);
                //     // debugger
                //     /* collect list of files choosen */

                //     var size=element[0].files[0].size
                //     var files = element[0].files;

                //     var filename = files[0].name;
                    
                //     var extension = filename.substr(filename.lastIndexOf("."));

                //     var allowedExtensionsRegxIMG = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                //     var allowedExtensionsRegxPDF = /(\.pdf)$/i;
                //     var allowedExtensionsRegxVid = /(\.mp4)$/i;
                                                                                                                                                                                                            
                //     /* testing extension with regular expression */
                //     var isIMG = allowedExtensionsRegxIMG.test(extension);
                //     var isPDF = allowedExtensionsRegxPDF.test(extension);
                //     var isVID = allowedExtensionsRegxVid.test(extension);
                //     var source=window.URL.createObjectURL(files[0]);
                    
                    
                //         if(isPDF || isVID || isIMG){

                //         if(isPDF){
                //             if(size<4000000){
                        
                //                     $('#fileDiv').html(` <span id="removie_file" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>
                //                         <embed  class="delete_select_file" src= "${source}" width= "80" height= "80">`);
                                    
                //                     $('#send_message').show();
                //             }else{
                //                     $('#send_message').hide();
                //                     $('#fileDiv').html('');
                                    
                //                     $.notify("PDF must be less then 4MB.","warn");
                //             }
                //         }
                //         if(isVID){

                //             if(size<15000000){
                //                     // $('#pic').show();
                //                     $('#fileDiv').html(`<span id="removie_file" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>
                //                         <video  class="delete_select_file" width="80" height="80" autoplay>
                //                         <source src="${source} " type="video/mp4">
                //                         Your browser does not support the video tag.
                //                             </video>`)
                //                     $('#send_message').show();
                //             }else{
                //                     $('#send_message').hide();
                //                     $('#fileDiv').html('');
                                
                //                     $.notify("Video must be less then 15MB.","warn");
                //             }
                //         }
                //         if(isIMG){
                //             if(size<4000000){
                //                 $('#fileDiv').html(`<span id="removie_file" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>
                //                 <img  class="delete_select_file" id="pic" src='${source}' class="img-fluid" >`);
                                
                //                 $('#send_message').show();
                //             }else{
                //                 $('#send_message').hide();
                                
                //                 $('#fileDiv').html('');

                //                 $.notify("Image must be less then 4MB.","warn");
                //             }
                //         }
                        
            
                //     }else{
                //             $('#send_message').hide();
                //             $('#pic').hide();
                //             $.notify("Invalid File Type.","warn");
                //             $('<span class="text-danger">Invalid File Type.</span>').insertAfter($(element));
                //             setTimeout(()=>{
                //                 let nextEl=$(element).next();
                            
                //                 if($(nextEl).prop("tagName")=="SPAN"){
                //                     $(nextEl).remove();
                //                 }
                //             },2000)

                //             return false;
                //     }
                //     $('#removie_file').click(function(){
                //         $('.delete_select_file').remove();
                //         $('#send_message').show();
                //         $('#removie_file').remove();
                //         $('#image').val('');
                //     });
                    
        // });

        // multiple file upload

        let imageField= $('#image');
        imageField.on('change',function(){
            
             
            for (var i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var size=file.size
                var filename = file.name;
                var file_extension=filename.substr(filename.lastIndexOf('.'));

                var allowedExtensionsRegxIMG = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                var allowedExtensionsRegxPDF = /(\.pdf)$/i;
                var allowedExtensionsRegxVid = /(\.mp4)$/i;

                var isIMG = allowedExtensionsRegxIMG.test(file_extension);
                var isPDF = allowedExtensionsRegxPDF.test(file_extension);
                var isVID = allowedExtensionsRegxVid.test(file_extension);
                var source=window.URL.createObjectURL(file);
                if(isPDF || isVID || isIMG){

                    if(isPDF){
                        if(size<4000000){
                    
                                $('#fileDiv').append(` <div><a id="removie_file${i}" class="btn btn-danger "><i class="fa fa-trash text-light" aria-hidden="true"></i></a>
                                <embed  id="delete_select_file${i}" src= "${source}" width= "80" height= "80"></div>`);
                                
                                $('#send_message').show();
                        }else{
                                $('#send_message').hide();
                                $('#fileDiv').html('');
                                
                                $.notify("PDF must be less then 4MB.","warn");
                        }
                    }
                    if(isVID){

                        if(size<15000000){
                            
                                $('#fileDiv').append(`<div><a id="removie_file${i}" class=" btn btn-danger"><i class="fa fa-trash text-light" aria-hidden="true"></i></a>
                                  <video  id="delete_select_file${i}" width="80" height="80" autoplay>
                                    <source src="${source} " type="video/mp4">
                                    Your browser does not support the video tag.
                                        </video></div>`)
                                $('#send_message').show();
                        }else{
                                $('#send_message').hide();
                                $('#fileDiv').html('');
                            
                                $.notify("Video must be less then 15MB.","warn");
                        }
                    }
                    if(isIMG){
                        if(size<4000000){
                            $('#fileDiv').append(`<div><a id="removie_file${i}" class=" btn btn-danger"><i class="fa fa-trash text-light" aria-hidden="true"></i></a>
                             <img  id="delete_select_file${i}" id="pic" src='${source}' width="80" height="80" ></div>`);
                            
                            $('#send_message').show();
                        }else{
                            $('#send_message').hide();
                            
                            $('#fileDiv').html('');

                            $.notify("Image must be less then 4MB.","warn");
                        }
                }

                }
                // else{
                    //             $('#send_message').hide();
                    //             $('#pic').hide();
                    //             $.notify("Invalid File Type.","warn");
                    //             $('<span class="text-danger">Invalid File Type.</span>').insertAfter($(element));
                    //             setTimeout(()=>{
                    //                 let nextEl=$(element).next();
                                
                    //                 if($(nextEl).prop("tagName")=="SPAN"){
                    //                     $(nextEl).remove();
                    //                 }
                    //             },2000)

                    //             return false;
                //  }
                        
            
           
        }
        });
        // delete uploaded file
        $(document).on('click',"a[id^='removie_file']",function(e) {
            const dt = new DataTransfer();
            debugger
            event.target.parentElement.parentElement.remove()
            // debugger


        })



            function GroupScrollChat() {
                $("#group-chat-container").animate(
                    {
                        scrollTop:
                            $("#group-chat-container").offset().top +
                            $("#group-chat-container")[0].scrollHeight
                    },
                    0
                );
            }

            $('#imageUpload').submit(function(e){
                e.preventDefault();
                var file_data = $('#image').prop('files')[0];
                var formData = new FormData();
                formData.append('sender_id', sender_id);
                formData.append('group_id', global_group_id);
                formData.append('file', file_data);
                // console.log(formData);



                $.ajax({
                    type: "post",
                    url: "{{ route('GroupImageSend') }}",
                    
                    data:formData,
                    contentType:false,
                    cache:false,
                    processData:false,

                    success: function (res) {
                        if(res.status){
                        
                            // $('.delete_select_file').remove();
                            $('#fileDiv').html('');
                            $('#image').val('');
                            $('#group-chat-container').append(res.view);
                            GroupScrollChat()
                        }
                    }
                });
            });


            $(document).on('click','.group_photo',function(e) {
                var group_id=global_group_id;
                $.ajax({
                    type: "get",
                    url: "{{ route('showGroupPic') }}",
                    data: {group_id:group_id},
                    success: function (res) {
                        if(res.status==true){
                            $('#galleryShowImage').html(res.view);
                        }
                    }
                });
            })
           

// delete file 
            $(document).on('click','.file_group_chat_delete',function(){
              var id=$(this).attr('data-id');
             var parent= event.target.parentElement;
              $.ajax({
                  type: "get",
                  url: "{{ route('DeleteGroupImageFile') }}",
                  data: {
                      id:id
                  },
                  success: function (res) {
                      if(res.status){
                        parent.remove();
                        $.notify('Deleted File','success');
                      }
                  }
              });
              
            });
           
        });

       
    // }
</script>

@endsection