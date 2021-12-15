<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item user-profile">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <img src="{{env('ASSET_URL')}}templates/theme-forest-admin-pro/main/admin-pro/src/assets/images/users/profile.png"
                            alt="user">
                        <span class="hide-menu">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                    </a>

                    <ul aria-expanded="false" class="collapse  first-level">
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
                {{--  --}}
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('dashboard') }}" aria-expanded="false"><i data-feather="home"
                            class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span></a>
                </li>


                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('cases') }}" aria-expanded="false"><i data-feather="briefcase"
                            class="feather-icon"></i><span class="hide-menu">Cases</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('checklists') }}" aria-expanded="false"><i data-feather="clipboard"
                            class="feather-icon"></i><span class="hide-menu">Checklists</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('quotes') }}" aria-expanded="false"><i data-feather="file-text"
                            class="feather-icon"></i><span class="hide-menu">Quotes</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('invoices') }}" aria-expanded="false"><i data-feather="file-text"
                            class="feather-icon"></i><span class="hide-menu">Invoices</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('payments') }}" aria-expanded="false"><i data-feather="credit-card"
                            class="feather-icon"></i><span class="hide-menu">Payments</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"  href="{{ route('commboard') }}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">Comm board</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('documents') }}" aria-expanded="false"><i data-feather="file"
                            class="feather-icon"></i><span class="hide-menu">Documents</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                        aria-expanded="false"><i data-feather="credit-card" class="feather-icon"></i><span
                            class="hide-menu">Make a payment</span></a></li>


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
            </ul>
            {{-- <user-aside-tools></user-aside-tools> --}}
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
