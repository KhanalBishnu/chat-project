<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chat</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('sidebar/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- font     --}}

    {{-- admin/ notify  --}}
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css ')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- frontend  --}}
    <link rel="stylesheet" href="{{ asset('front/assets/css/leadmark.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/vendors/themify-icons/css/themify-icons.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('sidebar/js/main.js') }}" defer></script>
    <script src="{{ asset('sidebar/js/popper.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    {{-- for chat  --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">





</head>

<body>
    {{-- side bar  --}}
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="">
            <div class="p-4 pt-5">
                {{-- <img src="{{ asset('images/logo.jpg') }}" alt="" srcset=""> --}}

                <a href="#" class="img logo rounded-circle mb-5"><img
                        src="{{ $user->hasMedia('user_image') ?  $user->getMedia('user_image')[0]->getFullUrl():''}}"
                        height="80px" width="85%" alt="Image"> </a>

                <ul class="list-unstyled components mb-5">
                    {{-- <li class="active"> --}}
                    <li id="chat_li"
                        class="{{ request()->url()==route('chat')?'active':'' }}   ml-4 nav-link btn btn-dark btn-sm">
                        <a class="btn" href="{{ route('chat') }}">Chat</a>

                    </li>
                    <li id="post_li"
                        class="{{ request()->url()==route('post')?'active':'' }}   ml-4 nav-link btn btn-dark btn-sm">
                        <a class="btn" href="{{ route('post') }}">Post</a>
                    </li>
                    <li id="profile_li"
                        class="{{ request()->url()==route('userProfile')?'active':'' }} ml-4 nav-link btn btn-dark btn-sm">
                        <a class="btn " href="{{ route('userProfile') }}  ">Profile</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">

                        </ul>
                    </li>
                    <li>
                        <a class="btn  ml-4 nav-link btn btn-dark btn-sm" href="{{ route('friends') }}">All Friends</a>
                    </li>
                    <li>
                        <a class="btn  ml-4 nav-link btn btn-dark btn-sm" href="{{ route('Yourfriends') }}">Your Friend</a>
                    </li>
                    <li>
                        <a class="btn  ml-4 nav-link btn btn-dark btn-sm"
                            href=" https://wa.me/+977986858585?text=I'm%20interested%20to%20chat%20with%20you!"
                            target="_blank">Connect Vie WhatsApp</a>
                        </a>
                    </li>
                </ul>

                <div class="footer">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="icon-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="pb-4 p-mb-5">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link ml-4 nav-link btn btn-success btn-sm rounded"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            {{-- <li class="nav-item">
                    <a class="nav-link ml-4 nav-link btn btn-secondary btn-sm rounded" href="#"><i class="fa-solid fa-bell"></i></a>
                </li> --}}
                            <div id="notification_change">
                                <li id="notification_li" class="nav-item dropdown me-4">
                                    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                                        id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                        <i id="count_message" class="mdi mdi-bell mx-0">{{ $count }}</i>
                                        <span class="count"></span>
                                    </a>
                                    @if ($count >0 )
                                        
                                  
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                        aria-labelledby="notificationDropdown">
                                        <p class="mb-0 font-weight-normal float-left dropdown-header text-black">
                                            Notifications </p>
                                        <div id="all_notification">
                                            @if($count>1)
                                             <small onclick="readAllNotification()" class="mb-3 float-end dropdown-header text-primary btn">
                                                Read all </small>
                                            @endif
                                            <div id="all_notification">
                                                @foreach(auth()->user()->unreadnotifications as $notification)
                                                <a class="dropdown-item" id="">
                                                    <div class="container">
                                                        <div class="row"
                                                            onclick="message_read('{{ $notification['id'] }}')"
                                                            id="message_notification{{$notification['id'] }}">
                                                            <small
                                                                class="">{{ $notification['data']['sender_id'] }}:{{ $notification['data']['message'] }}</small>
                                                            <p class="text-black">
                                                                {{ $notification['created_at']->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                @endforeach
                                            </div>


                                        </div>
                                    </div>
                                    @else
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="notificationDropdown">
                                    <small class="mb-0 font-weight-normal float-left dropdown-header text-black">
                                       Not Notification send by Anyone </small>
                                        
                                    @endif
                                </li>
                            </div>
                            {{-- <li class="nav-item">
                    <a class="nav-link ml-4 nav-link btn btn-primary btn-sm rounded" href="#">Portfolio</a>
                </li> --}}
                            <li class="nav-item">
                                <a class="nav-link ml-4 nav-link btn btn-primary btn-sm rounded" href="#">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-black ml-4 nav-link btn btn-danger btn-sm rounded"
                                    href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none ">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
            @include('sweetalert::alert')



        </div>
    </div>
    <script>
         
        var sender_id=@json(auth()->user()->id);
            // console.log(sender_id);
            var receiver_id;

            // for notification read
            function message_read(noti_id){
                let url="{{ route('motification_read',':id') }}";
                url=url.replace(':id',noti_id);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {id:noti_id},
                    success: function (res) {
                        if(res.status==true){
                            // $('#notification_change').html(res.data);
                            $('#count_message').text(res.count);
                            $('#message_notification'+noti_id).remove();
                        }
                    }
                });
              }
            function readAllNotification(){
                
               
                $.ajax({
                    type: "post",
                    url: "{{ route('motification_readAll') }}",
                    success: function (res) {
                        if(res.status==true){
                            // $('#notification_change').html(res.data);
                            $('#count_message').text(res.count);
                            $('#all_notification').remove();
                        }
                    }
                });
              }
    </script>

    <script src="{{asset('admin/vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- Plugin js for this page-->
    <script src="{{asset('admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('admin/js/template.js')}}"></script>
    <!-- endinject -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom js for this page-->
    <script src="{{asset('admin/js/dashboard.js')}}"></script>
    <script src="{{asset('admin/js/data-table.js')}}"></script>
    <script src="{{asset('admin/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.js')}}"></script>
    <!-- End custom js for this page-->

    <script src="{{asset('admin/js/jquery.cookie.js')}}" type="text/javascript"></script>

    </div>
</body>

</html>