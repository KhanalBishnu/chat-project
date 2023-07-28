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
    <div class="container-fluid py-3 bg-light">
        <div class="row justify-content-evenly">
            <div class="col-md-3 nav_logo px-3">
                <img class="img-fluid" src="{{ asset('image/download.jpg') }}" alt="" height="30" width="30">
                <a href="" class=" text-decoration-none text-primary">Chat</a>
            </div>
            <div class="col-md-6 logo_center">
                <small class="search_icon"><i class="fa-solid px-4 fa-magnifying-glass"></i></small> <input type="text"
                    name="" id="" placeholder="search here" class="">
                <div class="search-another-icon">
                    <a href=""> <i class="fa-solid fa-house  px-2"></i></a>
                    <a href=""> <i class="fa-solid fa-video  px-2"></i></a>
                    <a href=""> <i class="fa-regular fa-user  px-2"></i></a>
                    <a href=""> <i class="fa-solid fa-film  px-2"></i></a>
                </div>
            </div>
            <div class="col-md-3  logo_end_nav  ">
                <a href=""> <i class="fa-solid fa-bell  px-2"></i></a>
                <a href=""> <i class="fa-solid fa-message  px-2"></i></a>
                <a href=""> <i class="fa-solid fa-gear  px-2"></i></a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row border ">
            <div class="col-2 body_left_sidebar">
                <div class="row">
                    <div class="body_left_sidebar_top col-md-12">

                        <p>new feeds</p>
                        <a href=""> <i class="fa-solid fa-bell  px-2"></i>home</a>
                        <a href=""> <i class="fa-solid fa-message  px-2">News feed</i></a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Testing</a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Purpose</a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Finally</a>
                    </div>
                    <div class="body_left_sidebar_top col-md-12">

                        <p>new feeds</p>
                        <a href=""> <i class="fa-solid fa-bell  px-2"></i>home</a>
                        <a href=""> <i class="fa-solid fa-message  px-2">News feed</i></a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Testing</a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Purpose</a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Finally</a>
                    </div>
                    <div class="body_left_sidebar_top col-md-12">

                        <p>new feeds</p>
                        <a href=""> <i class="fa-solid fa-bell  px-2"></i>home</a>
                        <a href=""> <i class="fa-solid fa-message  px-2">News feed</i></a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Testing</a>
                        <a href=""> <i class="fa-solid fa-gear  px-2"></i>Purpose</a>
                    </div>
                </div>
            </div>
            <div class="col-8 body_main_content">

                <div class="row">
                    <div class="col-md-9 body_main_content_post">
                        <div class="row">
                            <div class="col-md-12 body_main_content_post_create pt-3">
                                <img class="img-fluid" src="{{ asset('image/download.jpg') }}" alt="" height="30"
                                    width="30"><small>What is on your mind?</small><br>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="col-md-12 body_main_content_post_create_write ">
                                <div class="body_main_content_post_create_icon">

                                    <i class="fa-solid fa-video fa-video-text  px-2"></i><a href="">Live Video</a>
                                    <i class="fa-solid fa-bell fa-bell-text  px-2"></i><a href="">home</a>
                                    <i class="fa-solid fa-image fa-image-text"></i><a href=""> Images</a>
                                </div>
                                <div class="fa-bar">

                                    <a id="fa-bar" href=""><i class="fa-solid fa-bars"></i></a>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 body_main_content_post_other">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 body_main_content_friend_req">
                        Friend Request
                    </div>
                </div>

            </div>
            <div class="col-2 ">
                <div class="row ">
                    <div class=" body_left_sidebar_end col-md-12 pr-5 pt-2">
                        <p>Recent friend</p>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>

                    </div>
                    <div class="body_left_sidebar_top body_left_sidebar_end col-md-12">
                        <p>Suggest Friend</p>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                        <div class="recent_friend my-2">
                            <a class="text-decoration-none text-dark" href=""> <img class="img-fluid"
                                    src="{{ asset('image/download.jpg') }}" alt="" height="25" width="18"><small> Ram
                                    Bahadur chaudhary <sup class="text-success">*</sup> </small></a>
                        </div>
                      


                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>