<header id="page-topbar">
                <div class="navbar-header" style="background-color: #284820">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="background-color: #284820">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17">
                                </span>
                            </a>

                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-light.svg')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/Must-logo-.png')}}" alt="" height="70">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>
                    <div class="text-white">
                        Password Reset Requests: ( {{ empty($count) ? '0' : $count }} )
                    </div>
                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-1.jpg')}}"
                                    alt="Header Avatar">
                                     
                                <span class="d-none d-xl-inline-block ml-1" key="t-henry" style="color: white;">{{Auth::user()->name}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> <span key="t-profile">Profile</span></a>

                                <a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
