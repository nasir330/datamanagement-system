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
                            <h1 class="m-0">Userlog result by username</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- user search form start -->
                            <form action="{{route('userLogsearchByUsername')}}" method="post">
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
                            <!-- user search form end -->
                        </div>
                    </div>
                    <div class="row">
                        <!-- date search form start -->
                        <form action="{{route('userLogsearchByDate')}}" method="post">
                            @csrf
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label for="date_from" class="col-form-label">Date from</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="date_from" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <label for="date_to" class="col-form-label">Date to</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="date_to" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary">Refresh</button>
                                </div>
                            </div>
                        </form>
                        <!-- date search form end -->
                    </div>
                </div>
            </div>
            <!-- body content header end -->

            <!-- Body main content start -->
            <section class="content">
                <div class="container-fluid">
                    <!-- log data table start -->
                    <div class="row">
                        <table class="table table-striped table-hover">
                            <thead class="text-center text-uppercase">
                                <tr>
                                    <td>ID</td>
                                    <td>Username</td>
                                    <td>Type</td>
                                    <td>Activitty</td>
                                    <td>Log time</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($searchByUsername as $key=> $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->user->username}}</td>
                                    <td>{{$data->type}}</td>
                                    <td>
                                        @if(!empty($data->activitylog))
                                        <a href="{{route('userActivityLog',['id'=>$data->id])}}" class="text-primary">
                                            <strong>View</strong>
                                        </a>
                                        @else
                                        No Activity
                                        @endif
                                    </td>
                                    <td> {{Carbon\Carbon::parse($data->created_at)->toDayDateTimeString()}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- log data table end -->

                    <!-- export to csv/excel start -->
                    <div class="row mb-2 mt-4">
                        <form action="{{route('exportUserLog')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <button class="btn btn-primary">
                                    Export
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- export to csv/excel end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />