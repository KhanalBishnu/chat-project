<div id="notification_change">
        <li class="nav-item dropdown me-4">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell mx-0">{{ $count }}</i>
                  <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header text-black">Notifications </p>
                  @foreach(auth()->user()->unreadnotifications as $notification)
                  <a class="dropdown-item" >
                   <div class="container">
                       <div class="row">
                             <small onclick="message_read('{{ $notification['id'] }}')" class="">{{ $notification['data']['sender_id'] }}:{{ $notification['data']['message'] }}</small>
                             <p class="text-black">{{ $notification['created_at']->diffForHumans() }}</p>
                       </div>
                   </div>
                  </a>
                  @endforeach
                 
                  
                </div>
              </li>
            </div>