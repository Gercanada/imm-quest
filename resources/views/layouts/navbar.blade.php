<nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                class="ti-menu ti-close"></i></a>
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <!-- Logo icon -->
            <b class="logo-icon">
                <!--You can put here icon as well  -->
                <img src="/{{ env('ASSET_URL') }}images\immvisassquare.png"
                    alt="homepage" class="dark-logo" />
                <img src="/{{ env('ASSET_URL') }}images\immvisassquare.png"
                    alt="homepage" class="light-logo" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
                <img src="/{{ env('ASSET_URL') }}images\immvisas_rectangle.png"
                    alt="homepage" class="light-logoo" />
            </span>
        </a>
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
            data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav mr-auto float-left">
            <!-- This is  -->
            <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                    href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            {{-- <li class="nav-item d-none d-md-block search-box"> <a
                    class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i
                        class="ti-search"></i></a>
                <form class="app-search">
                    <input type="text" class="form-control" placeholder="Search & enter">
                    <a class="srh-btn"><i class="ti-close"></i></a>
                </form>
            </li> --}}
            <!-- Profile -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                        <span class="round text-white d-inline-block text-center rounded-circle bg-success">
                            {{ substr(Auth::user()->name, 0, 1) }}
                            {{ substr(Auth::user()->last_name, 0, 1) }}
                        </span>
                </a>
                <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown">
                    <ul class="dropdown-user list-style-none">
                        <li>
                            <div class="dw-user-box p-3 d-flex">
                                <div class="u-img">
                                    <span class="round text-white d-inline-block text-center rounded-circle bg-success">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                        {{ substr(Auth::user()->last_name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="u-text ml-2">
                                    <h4 class="mb-0">{{ Auth::user()->name }}
                                        {{ Auth::user()->last_name }}</h4>
                                    <p class="text-muted mb-1 font-14">{{ Auth::user()->email }} </p>
                                </div>
                            </div>
                        </li>
                        <li role="separator" class="dropdown-divider"></li>
                        <li class="user-list"><a class="px-3 py-2" href="{{ route('profile') }}">

                                <span class="fa-stack">
                                    <i class="ti-settings fa-stack-2x fa-inverse"></i>
                                    <i class="ti-user fa-stack-2x "></i>
                                </span>
                                My Account Setting</a>
                        </li>

                        <li role="separator" class="dropdown-divider"></li>
                        <li class="user-list">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="px-3 py-20" href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();" aria-expanded="false">
                                    <i class="fa fa-power-off"></i>
                                    <span class="hide-menu"> Logout </span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
