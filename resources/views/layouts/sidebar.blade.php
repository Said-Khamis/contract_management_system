<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="app-logo-container">
            <span class="emblem-pic" tabindex="0">
                <img src="{{URL::asset('build/images/emblem.png')}}" class="bg-gradient-to-b from-cyan-500 to-blue-500 app-logo scale-up cursor-pointer" style="--order: 5;"  alt="URT National Emblem"/>
            </span>
        <div class="app-name move-up m-3" style="--order: 3.5;">
            <span>Foreign Management System</span>
            <span>FMS</span>
        </div>
    </div>

    <div id="scrollbar" data-simplebar="init" class="h-100">
        <div class="simplebar-wrapper" style="margin: 0">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content">
                        <div class="container-fluid">
                            <div id="two-column-menu">
                            </div>
                            <ul class="navbar-nav" id="navbar-nav" data-simplebar="init">
                                {{--<li class="menu-title text-lg-center"><span> Foreign Management System </span></li>--}}
                                <div class="simplebar-wrapper" style="margin: 0">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0; bottom: 0">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden;">
                                            <div class="simplebar-content">
                                                <li class="nav-item">
                                                    <a class="nav-link menu-link  {{(request()->is('/')) ?'active':''}}" href="{{url('/')}}"  aria-expanded="false" aria-controls="sidebarDashboards">
                                                        <i class="ri-dashboard-3-line"></i> <span>Dashboard</span>
                                                    </a>
                                                </li> <!-- end Dashboard Menu -->
                                                @can('manage contractss')
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link {{Request::segment(1) == 'contracts' ? 'active text-white':''}}" href="{{ route('contracts.index') }}" >
                                                            <i class="ri-list-check"></i> <span>Agreements</span>
                                                        </a>
                                                    </li>

                                                    {{--                <li class="nav-item">--}}
                                                    {{--                    <a class="nav-link {{Request::segment(1) == 'draft' & Request::segment(2) == 'contractss' ||--}}
                                                    {{--                    (Request::segment(1) == 'draft' & Request::segment(2) == 'contract' & Request::segment(3) == 'show' )? 'active text-white':''}}" href="{{route('draft.contractss')}}" >--}}
                                                    {{--                        <i class="ri-list-check"></i> <span>Draft Contracts</span>--}}
                                                    {{--                    </a>--}}
                                                    {{--                </li>--}}
                                                @endcan
                                                @can('manage user')
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link" href="#userManagement" data-bs-toggle="collapse"
                                                           role="button" aria-expanded="{{   Request::segment(1) == 'user' ? 'true' : 'false' }}" aria-controls="userManagement">
                                                            <i class="mdi mdi-account-circle"></i> <span>User Management</span>
                                                        </a>
                                                        <div class="{{ Request::segment(1) =='user' ? 'collapsed':'collapse'}} menu-dropdown" id="userManagement">
                                                            <ul class="nav nav-sm flex-column">
                                                                <li class="nav-item">
                                                                    <a href="{{ route('user.index') }} " class="nav-link {{Request::segment(1) == 'user'? 'active text-white':''}}">Users</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link" href="#rolesAndPermissions" data-bs-toggle="collapse"
                                                           role="button" aria-expanded="{{   Request::segment(1) == 'rolePermissions' || Request::segment(1) =='role' ? 'true' : 'false' }}" aria-controls="rolesAndPermissions">
                                                            <i class="mdi mdi-account-lock"></i> <span>Roles & Permissions</span>
                                                        </a>
                                                        <div class="{{ Request::segment(1) =='rolePermissions' || Request::segment(1) =='role' ? 'collapsed':'collapse'}} menu-dropdown" id="rolesAndPermissions">
                                                            <ul class="nav nav-sm flex-column">
                                                                <li class="nav-item">
                                                                    <a href="{{ route('user.role','roles') }}" class="nav-link {{(Request::segment(1) == 'rolePermissions' & Request::segment(2) == 'roles') || Request::segment(1) =='role' ? 'active text-white':''}}">Roles</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{ route('user.role','permissions') }}" class="nav-link {{Request::segment(1) == 'rolePermissions' & Request::segment(2) == 'permissions' ? 'active text-white':''}}">Permissions</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan
                                                @can('manage settings')
                                                    <li class="nav-item">
                                                        <a class="nav-link menu-link" href="#systemSettings" data-bs-toggle="collapse"
                                                           role="button" aria-expanded="{{   Request::segment(1) == 'settings' ? 'true' : 'false' }}" aria-controls="systemSettings">
                                                            <i class="ri-apps-2-line"></i> <span>System Settings</span>
                                                        </a>
                                                        <div class="{{   Request::segment(1) == 'settings' ? 'collapsed':'collapse'}} menu-dropdown" id="systemSettings">
                                                            <ul class="nav nav-sm flex-column">
                                                                <li class="nav-item">
                                                                    <a href="{{ route('sectors.index') }} " class="nav-link {{Request::segment(2) == 'sectors'? 'active text-white':''}}">Sectors</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{ route('institutions.index') }} " class="nav-link {{Request::segment(2) == 'institutions'? 'active text-white':''}}">Institutions</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{route('categories.index')}}" class="nav-link {{Request::segment(2) == 'categories'? 'active text-white':''}}">Category</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{route('contract_subtypes.index')}}" class="nav-link {{Request::segment(2) == 'contract_subtypes'? 'active text-white':''}}">Contract Subtypes</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{route('countries.index')}}" class="nav-link {{Request::segment(2) == 'locations' & Request::segment(1) == 'settings'? 'active text-white':''}}">Locations</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{ route('designations.index') }}" class="nav-link {{Request::segment(2) == 'designations' ? 'active text-white':''}}">Designations</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{ route('departments.index') }}" class="nav-link {{Request::segment(2) == 'departments' ? 'active text-white':''}}">Departments</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{ route('employees.index') }}" class="nav-link {{Request::segment(2) == 'employees' ? 'active text-white':''}}">Employees</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 827px;"></div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; display: none;"></div></div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>


{{--<!-- ========== App Menu ========== -->--}}
{{--<div class="app-menu navbar-menu">--}}
{{--    <!-- LOGO -->--}}
{{--    <div class="navbar-brand-box">--}}
{{--        <!-- Dark Logo-->--}}
{{--        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">--}}
{{--            <i class="ri-record-circle-line"></i>--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    <div id="scrollbar">--}}
{{--        <div class="container-fluid">--}}
{{--            <div id="two-column-menu">--}}
{{--            </div>--}}
{{--            <ul class="navbar-nav" id="navbar-nav">--}}
{{--                <li class="menu-title text-lg-center"><span> Foreign Management System </span></li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link menu-link  {{(request()->is('/')) ?'active':''}}" href="{{url('/')}}"  aria-expanded="false" aria-controls="sidebarDashboards">--}}
{{--                        <i class="ri-dashboard-3-line"></i> <span>Dashboard</span>--}}
{{--                    </a>--}}
{{--                </li> <!-- end Dashboard Menu -->--}}

{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link menu-link" href="#sidebarSettings" data-bs-toggle="collapse"--}}
{{--                               role="button" aria-expanded="{{Request::segment(1) == 'settings' ? 'true':'false'}}"--}}
{{--                               aria-controls="sidebarSettings">--}}
{{--                                <i class="ri-settings-2-line"></i> <span>System Settings</span>--}}
{{--                            </a>--}}
{{--                            <div class="{{Request::segment(1) == 'settings' ? 'collapsed':'collapse'}} menu-dropdown"--}}
{{--                                 id="sidebarSettings">--}}
{{--                                <ul class="nav nav-sm flex-column">--}}
{{--                                    @can('list category')--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a href="{{ route('categories.index') }}"--}}
{{--                                               class="nav-link {{Request::segment(2) == 'categories' ? 'active text-info':''}}">Category</a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}
{{--                                    @can('list institution')--}}
{{--                                        <li class="nav-item ">--}}
{{--                                            <a href="{{ route('institutions.index') }}"--}}
{{--                                               class="nav-link {{Request::segment(2) == 'institutions' ? 'active text-info':''}}"--}}
{{--                                               data-key="t-institutions">Institutions</a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}
{{--                                    @can('list country')--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a href="{{ route('countries.index') }}"--}}
{{--                                               class="nav-link {{Request::segment(2) == 'locations' ? 'active text-info':''}}"--}}
{{--                                               data-key="t-countries">Locations</a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}
{{--                                    @can('list user')--}}
{{--                                        <li class="nav-item ">--}}
{{--                                            <a href="{{ route('user.index') }}"--}}
{{--                                               class="nav-link {{Request::segment(2) == 'user' ? 'active text-info':''}}"--}}
{{--                                               data-key="t-user">Auth</a>--}}
{{--                                        </li>--}}
{{--                                    @endcan--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--            </ul>--}}

{{--        </div>--}}
{{--        <!-- Sidebar -->--}}
{{--    </div>--}}
{{--    <div class="sidebar-background"></div>--}}
{{--</div>--}}
{{--<!-- Left Sidebar End -->--}}

{{--<!-- Vertical Overlay-->--}}
{{--<div class="vertical-overlay"></div>--}}
