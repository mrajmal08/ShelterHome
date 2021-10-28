<div class="vertical-menu" style="background-color: #95c111;">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                @can('admin')
                    <li>
                        <a href="{{route('admin-shelter-list')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Shelter Request</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin-shelter-home')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Shelter Home</span>
                        </a>

                    </li>

{{--                    <li>--}}
{{--                        <a href="{{route('homless')}}" class="waves-effect">--}}
{{--                            <i class="bx bx-home-circle" style="    color: white;"></i><span--}}
{{--                                class="badge badge-pill badge-info float-right"></span>--}}
{{--                            <span key="t-dashboards" style="color: white;">Homeless</span>--}}
{{--                        </a>--}}

{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="{{route('room-list')}}" class="waves-effect">--}}
{{--                            <i class="bx bx-home-circle" style="    color: white;"></i><span--}}
{{--                                class="badge badge-pill badge-info float-right"></span>--}}
{{--                            <span key="t-dashboards" style="color: white;">Room</span>--}}
{{--                        </a>--}}

{{--                    </li>--}}

                    <li>
                        <a href="{{route('trust-affair')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Trust Affair</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{route('missing-person-list')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Missing Person</span>
                        </a>

                    </li>


                    <li>
                        <a href="{{route('volunter-list')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Volunteers</span>
                        </a>

                    </li>
                    @if(auth()->user()->name == "police")

                    @else
                    <li>
                        <a href="{{ route('password-requests') }}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Password Change list</span>
                        </a>

                    </li>
                    @endif

                    <li>
                        <a href="{{route('logout')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Logout</span>
                        </a>

                    </li>

                    @endcan()




            <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-layout"></i>
                                    <span key="t-layouts">Layouts</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="layouts-horizontal.html" key="t-horizontal">Horizontal</a></li>
                                    <li><a href="layouts-vertical.html" key="t-vertical">Vertical</a></li>
                                    <li><a href="layouts-light-sidebar.html" key="t-light-sidebar">Light Sidebar</a></li>
                                    <li><a href="layouts-compact-sidebar.html" key="t-compact-sidebar">Compact Sidebar</a></li>
                                    <li><a href="layouts-icon-sidebar.html" key="t-icon-sidebar">Icon Sidebar</a></li>
                                    <li><a href="layouts-boxed.html" key="t-boxed-width">Boxed Width</a></li>
                                    <li><a href="layouts-preloader.html" key="t-preloader">Preloader</a></li>
                                    <li><a href="layouts-colored-sidebar.html" key="t-colored-sidebar">Colored Sidebar</a></li>
                                    <li><a href="layouts-scrollable.html" key="t-scrollable">Scrollable</a></li>
                                </ul>
                            </li> -->






















                @can('volunter')

                    <li>
                        <a href="{{route('volunter-shelter-list')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Shelter Request</span>
                        </a>

                    </li>
                    <li>
                        <a href="{{route('logout')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Logout</span>
                        </a>

                    </li>
                @endcan()

                @can('police')
                    <li>
                        <a href="{{route('missing-person-list')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Missing Person</span>
                        </a>

                    </li>


                    <li>
                        <a href="{{route('volunter-list')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Volunteers</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{route('logout')}}" class="waves-effect">
                            <i class="bx bx-home-circle" style="    color: white;"></i><span
                                class="badge badge-pill badge-info float-right"></span>
                            <span key="t-dashboards" style="color: white;">Logout</span>
                        </a>

                    </li>

                @endcan()


            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
