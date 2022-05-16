<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @if (Auth::user())
                    <li class="sidebar-item user-profile">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            {{-- <img src="/{{ env('ASSET_URL') }}templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/profile.png"
                            alt="user"> --}}
                            <span class="round text-white d-inline-block text-center rounded-circle bg-success">
                                {{ substr(Auth::user()->name, 0, 1) }} {{ substr(Auth::user()->last_name, 0, 1) }}
                            </span>

                            <span class="hide-menu">{{ Auth::user()->name }}
                                {{ Auth::user()->last_name }}</span>
                        </a>

                        <ul aria-expanded="false" class="collapse  first-level">
                           {{--  <li class="sidebar-item">
                                <change_themme></change_themme>
                            </li> --}}
                            <li class="sidebar-item">
                                <a href="{{ route('profile') }}" class="sidebar-link p-0">
                                    <i class="mdi mdi-adjust"></i>
                                    <span class="hide-menu"> My Profile </span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="sidebar-link p-0" href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();" aria-expanded="false">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Logout </span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                {{--  --}}
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('dashboard') }}" aria-expanded="false"><i data-feather="home"
                            class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span></a>
                </li>
                @if (Auth::user())
                    <li class="sidebar-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="route('logout')" onclick="event.preventDefault();
                         this.closest('form').submit();" aria-expanded="false">
                                <i data-feather="log-out" class="feather-icon"></i>
                                <span class="hide-menu"> Log Out</span>
                            </a>
                        </form>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
