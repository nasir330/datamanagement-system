<aside class="main-sidebar elevation-4">
    <!-- Sidebar -->
    <div class="sidebar mt-4">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="fa-solid fa-house"></i>
                        <p>
                            Dashboard
                        </p>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-users-gear"></i>
                        <p>
                            Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('profile.edit')}}" class="nav-link">
                                <i class="fa fa-solid fa-gears"></i>
                                <p>Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('allUsers')}}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>All User</p>
                            </a>
                        </li>
                        @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                        <li class="nav-item">
                            <a href="{{route('addMembers')}}" class="nav-link">
                                <i class="fa-solid fa-user-plus"></i>
                                <p>Add New Member</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{route('allMembers')}}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>All Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('userLog')}}" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>User Log</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-bell"></i>
                        <p>
                            All HuAlarm
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('huAlarm')}}" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>HuAlarm List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('summeryNeType')}}" class="nav-link">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Summary NEType</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('domain')}}" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>Domain Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('netype')}}" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>NE Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('severitytype')}}" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>Severity Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('type')}}" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>Types</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('setting')}}" class="nav-link">
                        <i class="fa fa-solid fa-gears"></i>
                        <p>
                            Setting
                        </p>

                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>