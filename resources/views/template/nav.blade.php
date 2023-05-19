<div class="row">
    <nav class="navbar navbar-expand navbar-primary navbar-light">

        <div class="col-4">
            <div class="row">
                <div class="col-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto mt-2">
                    <input type="hidden" id="auth" value="{{Auth::user()}}">
                    @if(!empty(Auth::user()->appsetting))
                    <span class="text-white">
                        {{ Auth::user()->appsetting->appName }}
                        <input type="hidden" id="sysExp" value="{{ Auth::user()->appsetting->sessionExpiration }}">
                    </span>
                    @else
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <div class="row">
                <div class="col-auto notification-section">
                    <ul class="navbar-nav">
                        <!-- Messages Dropdown Menu -->
                        <li class="dropdown-center mt-2">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span id="message" class="badge badge-danger navbar-badge">3</span> <i
                                    class="icon fa-solid fa-message"></i>
                            </a>
                            <div class="dropdown-menu mt-0" aria-labelledby="dropdownMenuButton">

                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">

                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Brad Diesel
                                                <span class="float-right text-sm text-danger"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">Call me whenever you can...</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4
                                                Hours
                                                Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">

                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                John Pierce
                                                <span class="float-right text-sm text-muted"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">I got your message bro</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4
                                                Hours
                                                Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">

                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Nora Silvester
                                                <span class="float-right text-sm text-warning"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            <p class="text-sm">The subject goes here</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4
                                                Hours
                                                Ago</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                            </div>
                        </li>
                        <!-- Notifications Dropdown Menu -->
                        <li class="dropdown-center mt-2">
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span id="notification" class="badge badge-warning navbar-badge"></span>
                                <i class="icon fa-solid fa-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span id="notifications" class="dropdown-item dropdown-header"></span>
                                <div id="notification-list">

                                </div>

                                <div class="dropdown-divider"></div>
                                <a href="{{route('notification-list')}}" class="dropdown-item dropdown-footer">See
                                    All Notifications</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <h6 class="p-2">
                        {{'Hello'}} &nbsp; {{ Auth::user()->username }}
                    </h6>
                </div>
                <div class="col-auto mr-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger form-control">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>