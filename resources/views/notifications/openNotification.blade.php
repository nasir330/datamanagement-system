<!-- theme header -->
<x-header />

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- main wrapper start -->
    <div class="wrapper">

        <!-- Navbar start-->
        @include('template.nav')
        <!-- Navbar end-->
        <!-- Menu start -->
        @include('template.menu')
        <!-- Menu end -->

        <!-- body content start -->
        <div class="content-wrapper dashboard-seciton">

            <!-- body content header start -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h1 class="m-0">Notification on action</h1>
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
                                    <td>User</td>
                                    <td>Present type</td>
                                    <td>Requested type</td>
                                    <td>Operating Admin</td>
                                    <td>Updated</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <tr>
                                    <td>
                                        {{$notification->id}}
                                    </td>
                                    <td>{{$notification->status}}</td>
                                    <td>{{$notification->user->username}}</td>
                                    <td>{{$notification->user->usertype->type}}</td>
                                    <td>{{$notification->usertype->type}}</td>
                                    <td>{{$notification->actionBy}}</td>
                                    <td> {{Carbon\Carbon::parse($notification->created_at)->toDayDateTimeString()}}</td>
                                    <td>
                                    @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                                    <div class="row">
                                            <div class="col-auto">
                                                <form action="{{route('approveNotification')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$notification->id}}">
                                                    <input type="hidden" name="actionBy" value="{{Auth::user()->id}}">

                                                    <button class="bg-transparent border-0">
                                                        <i style="font-size:18px; margin:2px;"
                                                            class="fa-solid fa-check text-success"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-auto">
                                                <form action="" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$notification->id}}">

                                                    <button class="bg-transparent border-0">
                                                        <i style="font-size:18px; margin:2px;"
                                                            class="fa-solid fa-xmark text-danger"></i>

                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- data table end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />