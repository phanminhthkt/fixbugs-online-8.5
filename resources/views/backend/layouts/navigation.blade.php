<div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{Route('admin.index')}}" class="waves-effect">
                        <i class="remixicon-home-8-line"></i>
                        <span> Trang điều khiển </span>
                    </a>
                </li>
                @if(Auth::user()->can('view-group_member') || Auth::user()->can('view-member'))
                <li 
                class="{{ 
                request()->routeIs('admin.group_member.*') || request()->routeIs('admin.member.*') ? 'mm-active' : '' }}">
                    <a href="#" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Thành viên</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level mm-collapse {{ 
                request()->routeIs('admin.group_member.*') || request()->routeIs('admin.member.*') ? 'mm-show' : '' }}" aria-expanded="false">
                        @can('view-group_member')
                        <li >
                            <a href="{{Route('admin.group_member.index')}}"><i class="remixicon-movie-line"></i>Nhóm thành viên</a>
                        </li>
                        @endcan
                        @can('view-member')
                        <li >
                            <a href="{{Route('admin.member.index')}}"> <i class="remixicon-movie-line"></i>Thành viên</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('view-project')
                <li class="{{ request()->routeIs('admin.project.*') ? 'mm-active' : '' }}"> 
                    <a href="{{Route('admin.project.index')}}" class="waves-effect">
                        <i class="remixicon-book-mark-line"></i>
                        <span>Dự án</span>
                    </a>
                </li>
                @endcan
               
                @if(Auth::user()->can('view-status') || Auth::user()->can('view-group_status'))
                <li class="{{ request()->routeIs('admin.status.*') || request()->routeIs('admin.group_status.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0)" class="waves-effect">
                        <i class="fas fa-tasks"></i>
                        <span>Trạng thái</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul 
                    class="nav-second-level mm-collapse {{ request()->routeIs('admin.status.*') || request()->routeIs('admin.group_status.*') ? 'mm-show' : '' }}
                    " aria-expanded="false">
                        @can('view-group_status')
                        <li>
                            <a 

                            href="{{Route('admin.group_status.index')}}">
                            <i class="remixicon-movie-line"></i>Nhóm trạng thái</a>
                        </li>
                        @endcan
                        @can('view-status')
                        <li>
                            <a href="{{Route('admin.status.index')}}"> <i class="remixicon-movie-line"></i>Trạng thái</a>
                        </li>
                        @endcan
                    </ul>
                </li>               
                @endif
                
                @if(Auth::user()->can('view-permission') || Auth::user()->can('view-role'))

                <li 
                class="{{ request()->routeIs('admin.role.*') || request()->routeIs('admin.permission.*') ? 'mm-active' : '' }}">
                    <a href="#" class="waves-effect">
                        <i class="remixicon-vip-crown-2-line"></i>
                        <span>Phân quyền</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul  class="nav-second-level mm-collapse {{ 
                request()->routeIs('admin.role.*') || request()->routeIs('admin.permission.*') ? 'mm-show' : '' }}"  aria-expanded="false">
                        @can('view-role')
                        <li >
                            <a href="{{Route('admin.role.index')}}"> <i class="remixicon-movie-line"></i>Vai trò</a>
                        </li>
                        @endcan
                        @can('view-permission')
                        <li> 
                            <a href="{{Route('admin.permission.index')}}"> <i class="remixicon-movie-line"></i>Phân quyền</a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif

                @can('view-user')
                <li 
                class="{{ request()->routeIs('admin.user.*') ? 'mm-active' : '' }}">
                    <a href="{{Route('admin.user.index')}}" class="waves-effect">
                        <i class="fas fa-users-cog"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                @endcan
                <li class="menu-title">cấu hình</li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fe-settings"></i>
                        <span> Cấu hình website</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<script type="text/javascript">
    var URL = {
        'type': '<?=isset($_GET['type']) ? $_GET['type'] :''?>',
        'current': '<?=url()->current()?>',
    };
</script>