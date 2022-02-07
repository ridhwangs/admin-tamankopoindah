<?php 
    use App\Models\Role;
?>
<header class="main-nav">
     <div class="sidebar-user text-center">
        <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        <div class="badge-bottom"><span class="badge badge-primary">Online</span></div>
        <a href="user-profile"> <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6></a>
        <p class="mb-0 font-roboto">{{ Auth::user()->email }}</p>
        <ul>
            <li>
                <span>{{ date('Y-m-d',strtotime(Auth::user()->created_at)) }}</span>
                <p>Created At</p>
            </li>
            <li>
                <span>{{ date('Y-m-d',strtotime(Auth::user()->updated_at)) }}</span>
                <p>Updated At</p>
            </li>
        </ul>
    </div>
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{ route('dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link  {{ in_array(Route::currentRouteName(), ['index','operator']) ? 'active' : '' }} " href="{{ route('operator.index') }}"><i data-feather="users"></i><span>Operator</span></a>
                    </li>
                    
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Member</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link  {{ in_array(Route::currentRouteName(), ['index','member']) ? 'active' : '' }} " href="{{ route('member.index') }}"><i data-feather="user"></i><span>Data Member</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link  {{ in_array(Route::currentRouteName(), ['index','member']) ? 'active' : '' }} " href="{{ route('member.create') }}"><i data-feather="user"></i><span>Member Top Up</span></a>
                    </li>
                     <li class="sidebar-main-title">
                        <div>
                            <h6>Settings</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/pengaturan') }}" href="javascript:void(0)"><i data-feather="anchor"></i><span>Pengaturan</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/pengaturan') }};">
                            
                            <li><a href="{{ route('tarif-berlaku.show','352a9c39-70ae-4355-90ea-4978c418df88') }}"  class="{{routeActive('pengaturan')}}">Tarif yang berlaku</a></li>
                            <li>
                                <a class="submenu-title {{ in_array(Route::currentRouteName(), ['index','pengaturan']) ? 'active' : '' }}" href="javascript:void(0)">
                                    Pengaturan Tarif<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span>
                                </a>
                                <ul class="nav-sub-childmenu submenu-content" style="display: {{ in_array(Route::currentRouteName(), ['index','pengaturan']) ? 'block' : 'none' }};">
                                    <li><a href="{{ route('tarif-flat.show','352a9c39-70ae-4355-90ea-4978c418df88') }}"  class="{{routeActive('tarif-flat')}}">Tarif Flat</a></li>
                                    <li><a href="{{ route('tarif-progressive.show','352a9c39-70ae-4355-90ea-4978c418df88') }}" class="{{routeActive('tarif-progressive')}}">Tarif Progressive</a></li>
                                    <!-- <li><a href="{{ route('tarif-member.index') }}" class="{{routeActive('layout-dark')}}">Tarif Member</a></li> -->
                                    <!-- <li><a href="{{route('layout-dark')}}" class="{{routeActive('layout-dark')}}">Tarif Optional</a></li> -->
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav-menu custom-scrollbar">
                     <li class="sidebar-main-title">
                        <div>
                            <h6>General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link " href="{{ route('dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>