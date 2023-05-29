$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
$(document).ready(function(e) {
    // $('chat-container').html('');

    $(".user_list").click(function(e) {
        e.preventDefault();

        $("#" + receiver_id + "-select_status").removeClass("user-select");
        $("#chat-container").html("");
        var getUserId = $(this).attr("data-id");
        receiver_id = getUserId;

        $(".start-head").hide();
        $(".user_profile").hide();
        $(".chat-section").show();

        // for old message show
        loadOldChat();
        $("#" + receiver_id + "-select_status").addClass("user-select");
        // scroll auto make
        $("#chat-container")
            .get(0)
            .scrollIntoView({ behavior: "smooth" });
    });

    $("#chat-form").submit(function(e) {
        e.preventDefault();
        var message = $("#message").val();
        // alert(message);
        $.ajax({
            type: "POST",
            url: "/home/chat",
            data: {
                sender_id: sender_id,
                receiver_id: receiver_id,
                message: message
            },
            success: function(res) {
                // alert(response);
                // console.log(res.data);
                $("#message").val("");
                let chat = res.data.message;
                let html =
                    `
                     <div class="chat-color chat-sender" id="` +
                    res.data.id +
                    `-chat">
                        <h4>
                            <span>` +
                    chat +
                    ` </span>
                            <i class="fa fa-trash" aria-hidden="true" data-id="` +
                    res.data.id +
                    `" data-bs-toggle="modal" data-bs-target="#DeleteMessageModal"></i>

                        </h4>
                     </div>
                `;
                $("#chat-container").append(html);
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
        // console.log(id);
    });

    // message deleting
    $(".delete_message").click(function() {
        // e.preventDefault();
        var id = $("#delete_message_id").val();

        $.ajax({
            type: "post",
            url: "/delete-chat",
            data: { id: id },
            success: function(res) {
                alert(res.msg);
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
                // console.log(res.user);
                // let user_name= res.user.name
                let user_name =
                    `
                <p>` +
                    res.user.name +
                    `</p>
                `;
                $("#chat-container").append(user_name);

                let chats = res.data;
                let html = "";
                for (let i = 0; i < chats.length; i++) {
                    let addClass = "";
                    if (chats[i].sender_id == sender_id) {
                        addClass = "chat-sender";
                    } else {
                        addClass = "chat-receiver";
                    }
                    html +=
                        `

                        <div class=" ` +
                        addClass +
                        `" id="` +
                        chats[i].id +
                        `-chat">
                        <h4>
                        <span>` +
                        chats[i].message +
                        ` </span>`;

                    if (chats[i].sender_id == sender_id) {
                        html +=
                            `
                             <i class="fa fa-trash" aria-hidden="true" data-id="` +
                            chats[i].id +
                            `" data-bs-toggle="modal" data-bs-target="#DeleteMessageModal"></i>
                            `;
                    }

                    html += ` </h4>
                                 </div> `;
                    $("#chat-container").append(html);
                    ScrollChat();
                }
            } else {
                alert(res.message);
            }
        }
    });
    // <p>`+user.name+`</p>
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
        // console.log(users);
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
        console.log(user + "hyy");
    })

    .leaving(user => {
        //    console.log(user+'by');
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
            `-chat">
         <h4>` +
            data.chat.message +
            `</h4>
         </div>
        `;
        $("#chat-container").append(html);
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
        var message=$('#message').val();
        let url= "/groupchat/message";
        // let url= "{{ route('GroupchatStore',':id') }}";
        $.ajax({
            type: "POST",
            url:url,
            data: {message:message,group_id:global_group_id},
            success: function (res) {
                if(res.status){
                    $('#message').val('')
                    // let html=`
                    // <div class="group-chat-sender" id="group_chat-${res.data.id}">
                    //     <h4> ${res.data.message} <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="${res.data.id}" data-message="${res.data.message}" data-bs-target="#groupChatDeleteModel"></i></span> </h4>
                    //  </div>
                    // `;
                    $('#group-chat-container').append(res.view);

                }
                GroupScrollChat()
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
                //     let addClass="";
                //     let html='';
                //     let chats=res.data;
                //    for (let i = 0; i < chats.length; i++) {

                //       if(sender_id==chats[i].sender_id){
                //           addClass="group-chat-sender";
                //       }else{
                //           addClass="group-chat-receiver";
                //       }
                //       if(sender_id ==chats[i].sender_id){

                //           html +=`
                //                 <div class="${addClass}" id="group_chat-${chats[i].id}">
                //                 <h4> ${chats[i].message}  <span class= "group_message_modal"><i class="fa fa-trash " aria-hidden="true"  data-bs-toggle="modal" data-id="${chats[i].id}" data-message="${chats[i].message}" data-bs-target="#groupChatDeleteModel"></i></span>
                //                 </h4></div>
                //              `;
                //         }
                //       else{
                //                 html +=`
                //                       <div class="${addClass}" id="group_chat-${chats[i].id}">
                //                       <h4> ${chats[i].message}  </h4>
                //                      </div>
                //                    `;

                //       }
                //    } 
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

});
Echo.private("delete-groupChat-message").listen("GroupChatMessageDelete", data =>{
    $('#group_chat-'+data.id).remove();
});
// for create message broadcast 
Echo.private("group-chat-channel").listen(".groupChatData", data => {
    // alert(data);
    if (
        sender_id != data.chat.sender_id &&
        global_group_id == data.chat.group_id
    ) {
        let html =
            `
        <div class="chat-color group-chat-receiver" id="group_chat-${ data.chat.id }">
         <h4> ${ data.chat.message }</h4>
         <div class="image-section">
         <img src="${data.src}" alt="" width="25px" height="25px">
         <span class="group-chat-user-name">  </span> <span class="date_chat-user">${data.time}</span>
        
        </div>
         </div>
        `;
        $("#group-chat-container").append(html);
    }
});



