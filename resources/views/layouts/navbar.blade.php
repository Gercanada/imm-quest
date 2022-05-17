<nav class="navbar navbar-expand-md navbar-light p-l-0">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <!-- Logo will be here -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img src="/{{ env('ASSET_URL') }}images\cropped_ger_logo.png" width="40px" sizes="40x40" alt="homepage"
            class="dark-logo" />
        <img src="/{{ env('ASSET_URL') }}images\ger_logo.png" sizes="160x34" alt="homepage" width="160px" />
    </a>
    <!-- This is the navigation menu -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto stylish-nav" style="display: inline-block">
            @if (Auth::user())
                <li class="nav-item d-md-block waves-effect waves-dark float-left" >
                    <change_themme></change_themme>
                </li>
                <li class="nav-item dropdown float-right mr-2" >
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="round text-white d-inline-block text-center rounded-circle bg-success">
                            {{ substr(Auth::user()->name, 0, 1) }}
                            {{ substr(Auth::user()->last_name, 0, 1) }}
                        </span>
                    </a>
                    <div
                        class="dropdown-menu mailbox dropdown-menu-right  bounceInDown shadow p-1 rounded">
                        <ul class="dropdown-user list-style-none">
                            <li>
                                <div class="dw-user-box p-3 d-flex">
                                    <div class="u-img">
                                        <span
                                            class="round text-white d-inline-block text-center rounded-circle bg-success">
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
                                        <i class="fa fa-power-off  text-danger"></i>
                                        <span class="hide-menu"> Logout </span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            @else
                <li class="nav-item float-left">
                    <a class="nav-link " href="/login" aria-haspopup="true">
                        <span class="text-info d-inline-block text-center btn btn-outline-success">
                            <i class="fas fa-key"> Login</i>
                        </span>
                    </a>
                </li>
                <li class="nav-item float-right ml-4">
                    <a class="nav-link " href="/register" aria-haspopup="true">
                        <span class=" text-info d-inline-block text-center btn btn-outline-info">
                            <i class="fas fa-user-plus"> Register</i>
                        </span>
                    </a>
                </li>
            @endif


            {{--  --}}
            {{-- <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Demos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../admin-pro/src/main/index.html" target="_blank">Main</a>
                    <a class="dropdown-item" href="../admin-pro/src/minisidebar/index.html"
                        target="_blank">MiniSidebar</a>
                    <a class="dropdown-item" href="../admin-pro/src/dark/index.html" target="_blank">Dark</a>
                    <a class="dropdown-item" href="../admin-pro/src/horizontal/index.html"
                        target="_blank">Horizontal</a>
                    <a class="dropdown-item" href="../admin-pro/src/stylish-menu/index.html" target="_blank">Stylish
                        Menu</a>
                    <a class="dropdown-item" href="../admin-pro/src/minimal/index.html" target="_blank">Minimal</a>
                    <a class="dropdown-item" href="../admin-pro/src/rtl/index.html" target="_blank">RTL</a>
                </div>
            </li>
            <li class="nav-item"> <a class="nav-link" href="../Documentation/document.html"
                    target="_blank">Documentation</a> </li>
            <li class="nav-item"> <a class="m-t-5 btn btn-info font-13"
                    href="https://wrappixel.com/templates/adminpro/" style="width:120px;">BUY NOW</a> </li> --}}
        </ul>
    </div>
</nav>
