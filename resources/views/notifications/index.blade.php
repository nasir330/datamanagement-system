<!-- theme header -->
<x-header />

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- main wrapper start -->
    <div class="wrapper">
        <!-- Menu start -->
        @include('template.menu')
        <!-- Menu end -->
        <!-- body content start -->
        <div class="content-wrapper dashboard-seciton">
            <!-- Navbar start-->
            @include('template.nav')
            <!-- Navbar end-->
            <!-- body content header start -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h1 class="m-0">Notification list</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- user search form start -->
                            <form action="{{route('searchNotification')}}" method="post">
                                @csrf
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label for="username" class="col-form-label">Username</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Enter a username">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <!-- user search form start -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- body content header end -->

            <!-- Body main content start -->
            <section class="content">
                <div class="container-fluid">
                    <!-- notification alart section start -->
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            @if(session()->has('success'))
                            <div id="successMessage" class="text-center text-success p-1">
                                {{session('success')}}
                            </div>
                            @endif
                            @if(session()->has('delete-success'))
                            <div id="successMessage" class="text-center text-danger p-1">
                                {{session('delete-success')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- notification alart section end -->

                    <!-- data table start -->
                    <div class="row mb-4 p-2">
                        <table class="table table-striped table-hover">
                            <thead class="text-center text-uppercase">
                                <tr>
                                    <td>#</td>
                                    <td>Status</td>
                                    <td>Type</td>
                                    <td>User</td>
                                    <td>Present type</td>
                                    <td>Requested type</td>
                                    <td>Action-Admin</td>
                                    <td>Updated</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                                @foreach($notifications as $key=> $notification)
                                <tr>
                                    <td>
                                        {{$notification->id}}
                                    </td>
                                    <td>{{$notification->status}}</td>

                                    <td>{{$notification->type}}</td>
                                    <td>{{$notification->user->username}}</td>
                                    <td>{{$notification->user->usertype->type}}</td>
                                    <td>{{$notification->usertype->type}}</td>
                                    <td>{{$notification->actionBy}}</td>
                                    <td> {{Carbon\Carbon::parse($notification->created_at)->toDayDateTimeString()}}</td>
                                    <td>
                                        <a style="font-size:18px; margin:2px;"
                                            href="{{route('openNotification',['id'=>$notification->id])}}">Open </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span>{{$notifications->links()}}</span>
                    </div>
                    <!-- data table end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />