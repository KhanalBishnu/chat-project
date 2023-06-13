$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
$(document).ready(function(e) {

    $(".user_list").click(function(e) {
        e.preventDefault();

        $("#" + receiver_id + "-select_status").removeClass("user-select");
        $("#chat-container").html("");
        var getUserId = $(this).attr("data-id");
        receiver_id = getUserId;

        $(".start-head").hide();
        $(".user_profile").hide();
        $(".chat-section").show();
        // name of user 
        var userName=$(this).attr('data-name');
        $('.group-chat-header').text(userName);

        loadOldChat();
        $("#" + receiver_id + "-select_status").addClass("user-select");
        $("#chat-container")
            .get(0)
            .scrollIntoView({ behavior: "smooth" });
    });

    // for message button
    $('#message').on('input',function(){
        let val=$('#message').val();
        if(val=="" || val==null){
            $('#send_message').hide();
        }else{
            $('#send_message').show();
        }
       
    });
    // for file and send button 
    $('#image').change(function(){
        $('#fileDivShow').html();

        let element=$(this);
       
        let fileName=element[0].files[0].name;
        let size=element[0].files[0].size;
        let file_extension=fileName.substr(fileName.lastIndexOf("."));
        let validExtensionIMG=/(\.jpg|\.jpeg|\.png|\.gif)$/i;
        let validExtensionVID=/(\.mp4)$/i;
        let validExtensionPDF=/(\.pdf)$/i;
        let isIMG=validExtensionIMG.test(file_extension);
        let isVID=validExtensionVID.test(file_extension);
        let isPDF=validExtensionPDF.test(file_extension);

        var source=window.URL.createObjectURL(this.files[0]);
       

        if(isIMG || isPDF || isVID){
            if(isIMG){
                if(size<4000000){
                    $('#send_message').show();
                    $('#fileDivShow').html(`<span class="text-danger" id="file_delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                    <img class="delete_select_file" src="${source}" height="80" width="80">`)

                }else{
                    $.notify("Image must be less ten 4 MB");
                    $('#fileDivShow').html();
                    $('#send_message').hide();
                }
            }
            if(isVID){
                if(size<15000000){
                    $('#send_message').show();
                    $('#fileDivShow').html(`<span class="text-danger" id="file_delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
                    <  class="delete_select_file" video width="80" height="80" autoplay>
                    <source src="${source} " type="video/mp4">
                    Your browser does not support the video tag.
                        </video>`);

                }else{
                    $.notify("Video must be less ten 15 MB");
                    $('#fileDivShow').html();
                    $('#send_message').hide();
                }
            }
            if(isPDF){
                if(size<4000000){
                    $('#send_message').show();
                    $('#fileDivShow').html(`<span class="text-danger" id="file_delete"><i class="fa fa-trash " aria-hidden="true"></i></span>
                    <embed  class="delete_select_file" src="${source}" class="img-fluid" height="80" width="80">`);

                }else{
                    $.notify("PDF must be less ten 4 MB");
                    $('#fileDivShow').html();
                    $('#send_message').hide();
                }
            }
        }
        else{
            $.notify("File Format Is Invalid!");
        }
        $('#file_delete').click(function(){
            $('.delete_select_file').remove();
            $('#file_delete').remove();
            $('#image').val('');
        });
    })

    $("#chat-form").submit(function(e) {
        e.preventDefault();
        var message = $("#message").val();
        // var file=$('#image').prop('files')[0];
        var file_data = $('#image').prop('files')[0];
        var dataForm=new FormData();
        dataForm.append('sender_id',sender_id);
        dataForm.append('receiver_id',receiver_id);
        dataForm.append('message',message);
        dataForm.append('file',file_data);
        
        $.ajax({
            type: "POST",
            url: "/home/chat",
            contentType:false,
            processData:false,
            cache:false,
            // data: {
            //     sender_id: sender_id,
            //     receiver_id: receiver_id,
            //     message: message
            // },
            data:dataForm,

            success: function(res) {
                $('.delete_select_file').remove();
                $('#file_delete').remove();
                $('#image').val('');
                $("#message").val("");
                $('#send_message').hide();
              
                $("#chat-container").append(res.view);
                ScrollChat();
            }
        });
    });

    $(document).on("click", ".fa-trash", function() {
        var id = $(this).attr("data-id");
        $("#delete_message_id").val(id);
        $("#chat-message-name").text(
            $(this)
                .parent()
                .find("span")
                .text()
        );
    });

    // message deleting
    $(".delete_message").click(function() {
        var id = $("#delete_message_id").val();
        $.ajax({
            type: "post",
            url: "/delete-chat",
            data: { id: id },
            success: function(res) {

                if (res.success) {
                    $("#" + id + "-chat").remove();
                    $("#DeleteMessageModal").modal("hide");
                    $(".modal-backdrop").hide();
                    ScrollChat();
                }
            }
        });
    });
}); //end document ready
function loadOldChat() {
    $.ajax({
        type: "POST",
        url: "/load-chat",
        data: { sender_id: sender_id, receiver_id: receiver_id },
        success: function(res) {
            if (res.success) {
             $("#chat-container").append(res.view);
                ScrollChat();
            } else {
                console.log(res);
            }
        }
    });
}

function ScrollChat() {
    $("#chat-container").animate(
        {
            scrollTop:
                $("#chat-container").offset().top +
                $("#chat-container")[0].scrollHeight
        },
        0
    );
}
Echo.join("user-status")
    .here(users => {
       
        for (let x = 0; x < users.length; x++) {
            if (sender_id != users[x]["id"]) {
                $("#" + users[x]["id"] + "-status").removeClass(
                    "offline-status"
                );
                $("#" + users[x]["id"] + "-status").addClass("online-status");
                $("#" + users[x]["id"] + "-status").text("Online");
            }
        }
    })
    .joining(user => {
        $("#" + user.id + "-status").removeClass("offline-status");
        $("#" + user.id + "-status").addClass("online-status");
        $("#" + user.id + "-status").text("Online");
        
    })

    .leaving(user => {
        $("#" + user.id + "-status").removeClass("online-status");
        $("#" + user.id + "-status").addClass("offline-status");
        $("#" + user.id + "-status").text("Offline");
    })

    .listen("UserStatusEvent", e => {});

//    broadcast message data
Echo.private("chat-data").listen(".getChatMessage", data => {

    // alert(data);
    if (
        sender_id == data.chat.receiver_id &&
        receiver_id == data.chat.sender_id
    ) {
        let html =
            `
        <div class="chat-color chat-receiver" id="` +
            data.chat.id +
            `-chat">`
        if(data.image!=""){
            html+= `
            <a href="${data.image}" target="_blank">
            <img src="${data.image}" alt="" width="150" height="150">
        </a>`
        }
        if(data.pdf!=""){
            html+=`
            <a  href="${data.pdf}" class="img-f;" target="_black">
                
            <embed src= "${data.pdf}"  width="150" height="150">
           </a>`
        }
        if(data.video!=""){
            html+=`
            <a  href="${data.video}" class="img-f;" target="_black">
            <video width="150" height="150" autoplay>
                <source src="${data.video} " type="video/mp4">
                Your browser does not support the video tag.
            </video>
             </a>`
        }
        if(data.chat.message="null"){
            html+=``
        }else{

            html+=
             `
             <h4>` +
                data.chat.message +
                `</h4>`
        }

        html+=` </div>
             `;
        $("#chat-container").append(html);
        ScrollChat();
    }
});

// deletedChat message
Echo.private("message-delete").listen("MessageDeletedEvent", data => {
    $("#" + data.id + "-chat").remove();
});


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



// group chat start
$(document).ready(function(e) {
    // $('chat-container').html('');
    GroupScrollChat()
    $(".group_list").click(function(e) {
        e.preventDefault();


        $("#group-chat-container").html("");
        var groupId = $(this).attr("data-id");
        global_group_id=groupId;
        // alert(global_group_id)
        var groupName = $(this).attr("data-name");


        $(".start-head").hide();

        $(".group-chat-section").show();
        loadGroupChat()


    });
    $('#group-chat-form').submit(function(e){
        e.preventDefault();
        $('#send_message').prop('disabled',true);
        $('#send_message').text("Sending..");
        var message=$('#message').val();
        let url= "/group/message";
        var file_data = $('#image').prop('files')[0];
        var formData = new FormData();
        formData.append('message', message);
        formData.append('group_id', global_group_id);
        formData.append('file', file_data);
        // let url= "{{ route('GroupchatStore') }}";
        $.ajax({
            type: "post",
            url:url,
            // data: {message:message,group_id:global_group_id},
            data:formData,
            contentType:false,
            cache:false,
            processData:false,
            success: function (res) {
                if(res.status){

                    $('#message').val('')
                    $('.delete_select_file').remove();
                    
                    $('#removie_file').remove();
                    $('#image').val('');
                   
                    $('#send_message').hide();
                    $('#group-chat-container').append(res.view);
                    $('#send_message').hide();
                    loadGroupChat()
                }
            }
        });
    });

    // load group chat
    function loadGroupChat(){

        // var url = "{{ route('loadGroupChat') }}";
        var url = "/groups/chat";
        $.ajax({
            type: "get",
            url: url,
            data: {group_id:global_group_id},
            success: function (res) {
                if(res.status){
                    $('.group-chat-header').html(res.group.name);
               
                   $("#group-chat-container").append(res.view);
                   GroupScrollChat()
                }
            }
        });
    }
    // delete group message
    $(document).on('click','.fa-trash',function(){
        var id=$(this).attr('data-id');
        var message=$(this).attr('data-message');
        $('#groupChat_message_id').val(id);
        $('#groupChat_message').val(message);
    });

    // deleting message
    $(document).on('click','#groupChat_delete_form',function(e){

        var id=$('#groupChat_message_id').val();
        var message=$('#groupChat_message').val();
        // let url="{{route('deleteGroupMessage',':id')}}";
        // url=url.replace(':id',id);
        let url="/groups/message/delete/"+id;
        $.ajax({
            type: "get",
            url: url,
            success: function (res) {
                $('#group_chat-'+id).remove();
                $('#groupChatDeleteModel').modal('hide');
                // location.reload();
                $(".modal-backdrop").hide();
            }
        });
    });

    // delete image 
    $(document).on('click','#fa-trash_image',function(e){
        var id=$(this).attr('data-id');
        let  url= "{{ route('Group_deleteImage') }}";
        $.ajax({
            type: "post",
            // url:url,
            // url: "/group/chat-image/delete",
            url:url,
            data: {id:id},
            success: function (res) {
            }
        });

    });

});

// for create file broadcast 
Echo.private('fileAdd-group-chat').listen('.fileAddedGroupChat', data => {
    // console.log(data.groupChat.group_id)
     if (
        sender_id != data.sender_id &&
        global_group_id == data.groupChat.group_id
    ) {
        let html =
            `
        <div class="chat-color group-chat-receiver" id="group_chat-${ data.groupChat.id }">
         <div class="image-section">
         <img src="${data.src}" alt="" width="150px" height="150px">
        </div>
         </div>
        `;
        $("#group-chat-container").append(html);
            
            GroupScrollChat()
    }
});

// update group message 
Echo.private('update-group-chatMessage').listen('GroupMessageUpdateEvent',data=>{
    $('#group_chat-'+data.groupMessage.id).find('small').text(data.groupMessage.message);
})
Echo.private("delete-groupChat-message").listen("GroupChatMessageDelete", data =>{
    $('#group_chat-'+data.id).remove();
});
// for create message broadcast
Echo.private("group-chat-channel").listen(".groupChatData", data => {
//    console.log(data.chat);
   
    
    if (
        sender_id != data.chat.sender_id &&
        global_group_id == data.chat.group_id
    ) {
        let html =
            `
        <div class="chat-color group-chat-receiver" id="group_chat-${ data.chat.id }">`
        if(data.chat.message="null"){
            html+=``
        }else{
            html+=`
            <h4> ${ data.chat.message }</h4>
            <div class="image-section">`
        }
         if(data.image!=""){
             html+=`
            <a href="${data.image}" target="_blank">
                <img src="${data.image}" alt="" width="200px" height="200px">
            </a>`
         }
         if(data.video!=""){
            html+=  `
            <a  href="${data.video}" class="img-f;" target="_black">
                <video width="200" height="200" autoplay>
                    <source src="${data.video} " type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>`
         }
         if(data.pdf!=""){
             html+=
             `
             <a  href="${data.pdf}" class="img-f;" target="_black">
                
              <embed src= "${data.pdf}" width= "400" height= "300">
             </a>`
         }
         html+=`
         <img src="${data.src}" alt="" width="20px" height="20px">
         <span class="group-chat-user-name">  </span> <span class="date_chat-user">${data.time}</span>
        </div>
         </div>
        `;
        $("#group-chat-container").append(html);
           
            GroupScrollChat()
    }
});