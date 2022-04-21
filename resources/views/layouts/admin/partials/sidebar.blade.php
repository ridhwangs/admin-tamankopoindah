<?php 
    use App\Models\Role;
    $role = new Role();
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
                    @php
                        $ref_user = Role::where('id_role', Auth::user()->id_role)->first();
                        $active_menu = explode(",", $ref_user->active_menu);
                        $menu = $role->m_menu()->whereNull('is_parent_menu')->orderBy('position', 'asc')->get(); 
                    @endphp
                    @foreach ($menu as $keys => $rows)
                        @php
                            $querySub =  $role->m_menu()->where('is_parent_menu', '=', $rows->kd_menu)->orderBy('position', 'asc'); 
                            $subMenu = $querySub->get();
                        @endphp
                        @if($querySub->count() > 0)  
                            @foreach($active_menu as $key => $rows_am)
                                @if($rows->kd_menu == $rows_am)
                                <li class="dropdown">
                                    <a class="nav-link menu-title" href="javascript:void(0)">{!! $rows->fa_icon !!}<span> {{ $rows->nm_menu }}</span></a>
                                    <ul class="nav-submenu menu-content" >
                                        <li>
                                            @foreach ($subMenu as $subRows)
                                                @foreach($active_menu as $rows_am)
                                                    @if($subRows->kd_menu == $rows_am)
                                                    <a href="{{ url($subRows->url_link) }}">{{ $subRows->nm_menu }}</a>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                        @else
                            @foreach($active_menu as $rows_am)
                                @if($rows->kd_menu == $rows_am)
                                    <li class="dropdown">
                                        <a class="nav-link " href="{{ url($rows->url_link) }}">{!! $rows->fa_icon !!}<span>{{ $rows->nm_menu }}</span></a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</header>