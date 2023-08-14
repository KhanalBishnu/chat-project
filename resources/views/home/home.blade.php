<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container-fluid py-3 bg-light  navbar_head ">
        <div class="row justify-content-evenly">
            <div class="col-md-3 nav_logo px-3">
                {{-- <img class="img-fluid" src="{{ asset('image/download.jpg') }}" alt="" height="40" width="30"> --}}
                <a href="" class=" text-decoration-none text-primary">Chat</a>
            </div>
            <div class="col-md-6 logo_center">
                <small class="search_icon"><i class="fa-solid px-4 fa-magnifying-glass"></i></small> <input type="text"
                    name="" id="" placeholder="search here" class="">
                <div class="search-another-icon">
                    <a href=""> <i class="fa-solid fa-house"></i></a>
                    <a href=""> <i class="fa-solid fa-video  px-2"></i></a>
                    <a href=""> <i class="fa-regular fa-user  px-2"></i></a>
                    <a href=""> <i class="fa-solid fa-film  px-2"></i></a>
                </div>
            </div>
            <div class="col-md-2  logo_end_nav  ">
                <a href=""> <i class="fa-solid fa-bell  px-2  text-primary"><sup class="text-danger">*</sup></i></a>
                <a href=""> <i class="fa-solid fa-message  px-2  text-primary"></i></a>
                <a href=""> <i class="fa-solid fa-gear  px-2 text-primary"></i></a>
                <div class="img-header-div">
                    <img class="" src="{{ asset('image/download.jpg') }}" alt="" height="100%" width="100%">
                </div>

            </div>
        </div>
    </div>

    <div id="mainDiv">
        <div id="sidebarDiv">
            <div class="row">
                <div class="body_left_sidebar_top col-md-12">

                    <p>new feeds</p>

                    <a href="" class="icon-sidebar"> <i class="fa-solid fa-bell  "></i>home</a>
                    <a href="" class="icon-sidebar"> <i class="fa-solid fa-message"></i>Chat</a>
                    <a href="" class="icon-sidebar"> <i class="fa-brands fa-rocketchat"></i> Group Chat</a>
                    <a href="" class="icon-sidebar"><i class="fa-solid fa-people-group"></i>Group</a>
                    <a href="" class="icon-sidebar"> <i class="fa-solid fa-user-group"></i>Friends</a>
                </div>
                <div class="body_left_sidebar_top col-md-12">

                    <p>Setting</p>
                    <a href="" class="icon-sidebar"> <i class="fa-solid fa-bell  "></i>home</a>
                    <a href="" class="icon-sidebar"> <i class="fa-solid fa-message  "></i>News feed</a>
                    <a href="" class="icon-sidebar"> <i class="fa-solid fa-gear  "></i>Testing</a>
                    <a href=""> <i class="fa-solid fa-gear  "></i>Purpose</a>
                </div>
                <div class="body_left_sidebar_copy ">

                    <h6>CopyRight @2020</h6>
                </div>
            </div>
          
        </div>
        <div id="mainPageDiv">
            <div id="mp1">
                <div class="body_main_content_post_create pt-1">
                    <div class="circle_image">

                        <img class="img-fluid" src="{{ asset('image/download.jpg') }}" alt="" height="100%"
                            width="100%">
                    </div>
                    <textarea name="" id="" cols="30" rows="10" placeholder="What is on your mind?"></textarea>
                </div>
                <div class=" body_main_content_post_create_write ">
                    <div class="body_main_content_post_create_icon">

                        <i class="fa-solid fa-video fa-video-text  px-3"></i> <a href="">Live Video</a>
                        <i class="fa-solid fa-bell fa-bell-text  px-3"></i><a href="">home</a>
                        <i class="fa-solid fa-image fa-image-text px-3"></i><a href=""> Images</a>
                    </div>
                    <div class="fa-bar">

                        <a id="fa-bar" href=""><i class="fa-solid fa-bars"></i></a>
                    </div>
                </div>

                <div class=" body_main_content_post_other">
                    <div class="circle_image">

                        <img class="img-fluid" src="{{ asset('image/photo.jpg') }}" alt="" height="100%" width="100%">
                    </div>
                    <small class="name-other-post">Ram Bahadur Chaudhary</small><br>
                    <span class="time-other-post">5th mar 2023</span>
                    <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde labore eius
                        voluptates expedita beatae magnam, voluptatem cum impedit tenetur earum
                        similique soluta natus dicta optio ex aut perferendis vitae repellendus.
                    </p>
                    <div class="image-section-other-post">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('image/download.jpg') }}" alt="Images of post" width="100%"
                                    height="100%">
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('image/final.jpg') }}" alt="Images of post" width="100%"
                                    height="100%">

                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('image/test.jpg') }}" alt="Images of post" width="100%"
                                    height="100%">

                            </div>
                        </div>
                    </div>
                    <div class="footer-icon-post">
                        <div class="like-comment-icon">
                            <small> <i class="fa fa-thumbs-up text-primary" aria-hidden="true"></i></small>
                            <small><i class="fa-solid fa-heart text-danger"></i></small>
                            <small>2.4k Likes</small>
                            <small><i class="fa-regular fa-comment"></i></small>
                            <span>23 comments</span>
                        </div>
                        <div class="share-post">
                            <small> <i class="fas fa-share"></i></small>
                            <span>Share</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mp2">

                <div class="friend-request-main-div">
                    <div class="friend-request">
                        <h6> Friend Request </h6>
                        <small><a href="">See all</a></small>
                    </div>
                    <div class="friend-request_see">
                        <div class="circle_image ">

                            <img class="img-fluid" src="{{ asset('image/photo.jpg') }}" alt="" height="100%"
                                width="100%">
                        </div>
                        <small class="name-request-post">Ram Bahadur Chaudhary</small><br>
                        <span class="friend-mutual-post">23 mutual friend</span>
                        <div class="confirm-cancel-friend">
                            <small class="confirm">Confirm</small>
                            <small class="cancel">Cancel</small>
                        </div>
                    </div>
                    <div class="friend-request_see">
                        <div class="circle_image ">

                            <img class="img-fluid" src="{{ asset('image/photo.jpg') }}" alt="" height="100%"
                                width="100%">
                        </div>
                        <small class="name-request-post">Ram Bahadur Chaudhary</small><br>
                        <span class="friend-mutual-post">23 mutual friend</span>
                        <div class="confirm-cancel-friend">
                            <small class="confirm">Confirm</small>
                            <small class="cancel">Cancel</small>
                        </div>
                    </div>
                </div>
                <div class="friend-confirm-main-div">
                    <div class="friend-request">
                        <h6>Confirm Friend </h6>
                        <small><a href="">See all</a></small>
                    </div>
                    <div class="friend-request_see">
                        <div class="circle_image ">

                            <img class="img-fluid" src="{{ asset('image/photo.jpg') }}" alt="" height="100%"
                                width="100%">
                        </div>
                        <small class="name-request-post">Ram Bahadur Chaudhary</small><br>
                        <span class="friend-mutual-post">23 mutual friend</span>

                    </div>
                    <div class="friend-request_see">
                        <div class="circle_image ">

                            <img class="img-fluid" src="{{ asset('image/photo.jpg') }}" alt="" height="100%"
                                width="100%">
                        </div>
                        <small class="name-request-post">Ram Bahadur Chaudhary</small><br>
                        <span class="friend-mutual-post">23 mutual friend</span>

                    </div>
                </div>
                <div class=" suggest-group">
                    <div class="suggest-group-div">
                        <div class="friend-request">
                            <h6>Suggest group</h6>
                            <small><a href="">See all</a></small>
                        </div>
                        <div class="suggest-group-image">
                            <img class="img-fluid" src="{{ asset('image/photo.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="suggest-group-join">
                            <small class="post-count-group ">25+ posts a day</small>
                            <small class="join ">Join</small>
                        </div>
                    </div>
                </div>
            <div id="mp3">
                <div class="sidebae_end">

                    <div class=" body_left_sidebar_end ">
                        <p>Recent friend</p>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
    
                    </div>
                    <div class=" body_left_sidebar_end ">
                        <p>Suggest Friend</p>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend ">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="40" width="40"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>