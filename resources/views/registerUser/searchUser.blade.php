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
                            <h1 class="m-0">Search Relult of <strong class="text-primary">{{$users->username}}</strong>
                            </h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- user search form start -->
                            <form action="{{route('userSearch')}}" method="post">
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
                                    <td>ID</td>
                                    <td>Username</td>
                                    <td>User Type</td>
                                    <td>Status</td>
                                    <td>Username</td>
                                    <td>Updated at</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                                <tr>
                                    <td>
                                        {{$users->id}}
                                    </td>
                                    <td>{{$users->username}}</td>

                                    <td>{{$users->usertype->type}}</td>
                                    <td>
                                        @if($users->status == 'Approved')
                                        <strong class="text-success text-uppercase">
                                            {{$users->status}}
                                        </strong>
                                        @else
                                        <strong class="text-warning text-uppercase">
                                            {{$users->status}}
                                        </strong>
                                        @endif
                                    </td>
                                    <td>{{$users->email}}</td>
                                    <td> {{Carbon\Carbon::parse($users->created_at)->toDayDateTimeString()}}</td>
                                    <td>
                                        @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                                        <div class="row">
                                            <div class="col-auto">
                                                <form action="{{route('userApprove')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$users->id}}">

                                                    <button class="bg-transparent border-0">
                                                        <i style="font-size:18px; margin:2px;"
                                                            class="fa-solid fa-check text-success"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-auto">
                                                <a style="font-size:18px; margin:2px;"
                                                    href="{{route('userEdit',['id' => $users->id])}}">
                                                    <i class="fa-solid fa-edit text-primary"></i>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a style="font-size:18px; margin:2px;"
                                                    href="{{route('userDelete',['id'=>$users->id])}}">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </a>
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