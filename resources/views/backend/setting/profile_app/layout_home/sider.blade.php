        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <p> {{ Auth::User()->name}} </p>
                        <p> {{ Auth::User()->email }} </p>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <?php

                        use App\Models\AccessMenu;
                        use App\Models\AccessSubMenu;
                        use App\Models\ProfileApp;
                        use App\Models\SubMenu;
                        use Illuminate\Support\Facades\Auth;

                        $profile_app = ProfileApp::first();
                        $access_menu = AccessMenu::orderByRaw('created_at DESC')->where('role_id', Auth::user()->id)->get();

                        ?>
                        @foreach($access_menu as $data)
                        <li class="nav-item {{$data->menu->class}}">
                            <a href="{{Route($data->menu->route_url->route_name)}}" class="nav-link" id="{{$data->menu->nama}}">
                                <i class="nav-icon {{$data->menu->icon}}"></i>
                                <p>
                                    {{$data->menu->nama}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <?php
                            $sub_menu = AccessSubMenu::where('menu_id', $data->menu_id)->where('user_id', Auth::user()->id)->get();
                            ?>
                            @foreach($sub_menu as $data1)
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{Route($data1->sub_menu->route_url->route_name)}}" class="nav-link" id="{{$data1->sub_menu->nama}}">
                                        <i class="{{$data1->sub_menu->icon}}"></i>
                                        <p>{{$data1->sub_menu->nama}}</p>
                                    </a>
                                </li>
                            </ul>
                            @endforeach

                        </li>
                        @endforeach
                        <li class="nav-item has-treeview">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i> &nbsp; Kaluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>