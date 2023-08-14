<div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
<div class="pcoded-inner-navbar main-menu">
    <div class="">
        <div class="main-menu-header">
            {{-- @if(web_configs())
            <img src="{{ web_configs()->hasMedia('web_log') ? web_configs()->getMedia('web_log')[0]->getFullUrl() : '' }}" class="image-fluid navLogo" alt="company_logo">
            @else
            <img src="{{asset('frontend/images/logo-imagine-01.png')}}" class="image-fluid navLogo" alt="company_logo">
            @endif --}}
            <!-- <div class="user-details">
                {{-- <span id="more-details">{{ auth()->user()->name }}<i class="fa fa-caret-down"></i></span> --}}
            </div> -->
        </div>

        <div class="main-menu-content">
            <ul>
                <li class="more-details">
                    <a href="user-profile.html"><i class="ti-user"></i>View Profile</a>
                    <a href="#!"><i class="ti-settings"></i>Settings</a>
                    <a href="auth-normal-sign-in.html"><i class="ti-layout-sidebar-left"></i>Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- <div class="p-15 p-b-0">
        <form class="form-material">
            <div class="form-group form-primary">
                <input type="text" name="footer-email" class="form-control" required="">
                <span class="form-bar"></span>
                <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>
            </div>
        </form>
    </div> -->
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">General Configurations</div>

    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">SEO</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.seo') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">SEO Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Web Configurations</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.webConfig') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Website Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-brands fa-google"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Google reCaptcha</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.reCaptcha') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Recaptcha Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-brands fa-google"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">QR Code </span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.qrCode') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">QR Code Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-comments"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Social Media</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.socialMedia') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Social Media Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">News & Events</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">News Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.news') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">News Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Portfolio Chart</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Chart Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.chart') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Chart Setup</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Users</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">User Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                  <a>  {{-- <a href="{{route('home.user')}}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Add User</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Services</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Service Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.service') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">View</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Service Package</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Service Package Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                 <a>   {{-- <a href="{{route('home.service_package')}}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">View</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Customer</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Customer Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.customer') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Add Customer </span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Staffs</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Staff Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.team') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Add Staff </span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Roles</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Role Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.role') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Add Role </span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Assign Roles</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Assign Role Section</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.assign') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Assign Role </span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Page Management</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Page Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.page') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Pages</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.pageContent') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Page Contents</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.pageSubcontent') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Page Subcontents</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Menu Management</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Menu Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.menu') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">Menus</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Gallery Management</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Gallery Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.gallery') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">View</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Slider Management</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Slider Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.slider') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">View</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Footer Management</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Footer Settings Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.footer') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">View</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">FAQ Management</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">FAQ Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.faq') }}" class="waves-effect waves-dark"> --}}
                        <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                        <span class="pcoded-mtext">View</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>
    {{-- <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Sections Module</div>
    <ul class="pcoded-item pcoded-left-item">

        <li class="pcoded-hasmenu">
            <a href="javascript:void(0)" class="waves-effect waves-dark">
                <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Section Setup</span>
                <span class="pcoded-mcaret"></span>
            </a>
            <ul class="pcoded-submenu">
                <li class=" ">
                    <a>{{-- <a href="{{ route('home.section') }}" class="waves-effect waves-dark">
    <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
    <span class="pcoded-mtext">Create Section</span>
    <span class="pcoded-mcaret"></span>
    </a>
    </li>
    </ul>
    </li>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Category Setup</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class=" ">
                <a>{{-- <a href="{{ route('home.category') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                    <span class="pcoded-mtext">Create Category</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="fa fa-solid fa-gear"></i></span>
            <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Subcategory Setup</span>
            <span class="pcoded-mcaret"></span>
        </a>
        <ul class="pcoded-submenu">
            <li class=" ">
                <a>{{-- <a href="{{ route('category.subcat') }}" class="waves-effect waves-dark"> 
                    <span class="pcoded-micon"><i class="fa fa-solid fa-laptop"></i></span>
                    <span class="pcoded-mtext">Create Sub Category</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </li>


    </ul>
    --}}

</div>