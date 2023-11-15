                    <?php

                    use App\Models\AccessMenu;
                    use App\Models\AccessSubMenu;
                    use App\Models\DataWarga;
                    use App\Models\FotoUser;
                    use App\Models\LayoutAppUser;
                    use App\Models\ProfileApp;
                    use Illuminate\Support\Facades\Auth;

                    $profile_app = ProfileApp::first();
                    $warna_sid = LayoutAppUser::where('user_id', Auth::user()->id)->first();
                    $access_menu = AccessMenu::where('role_id', Auth::user()->role_id)->get();


                    $user = DataWarga::find(Auth::user()->data_warga_id);
                    $foto = FotoUser::where('data_warga_id', $user->id)->where('is_active', 1)->first();
                    ?>
                    <!-- Main Sidebar Container -->
                    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: {{$warna_sid->sider}};">
                        <!-- Sidebar -->
                        <div class=" sidebar">
                            <!-- Sidebar user panel (optional) -->
                            <div class="image justify-content-center">
                                <center>
                                    <img src="{{asset($foto->foto)}}" class="img-circle " width="50%" alt="User Image">

                                    <p> {{ Auth::User()->name}} </p>
                                    <p> {{ Auth::User()->email }} </p>
                                </center>
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

                                    @foreach($access_menu as $data)
                                    @if($data->menu->kategori == 'sidebar')
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
                                    @endif
                                    @endforeach
                                    <li class="nav-item has-treeview">
                                        <a class="dropdown-item active" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i> &nbsp; Kaluar</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    <br>
                                </ul>
                            </nav>
                            <!-- /.sidebar-menu -->
                        </div>
                        <!-- /.sidebar -->
                    </aside>