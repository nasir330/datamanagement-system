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
                        <div class="col-6">
                            <h1 class="m-0">Acitvity Log list</h1>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a href="{{route('userLog')}}" class="btn btn-warning">Back to user log </a>
                        </div>
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
                                    <td>#</td>
                                    <td>Log id</td>
                                    <td>Activity</td>
                                    <td>Time</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($data as $key=> $activity)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$activity->logId}}</td>
                                    <td>{{$activity->activity}}</td>
                                    <td>{{Carbon\Carbon::parse($activity->created_at)->toDayDateTimeString()}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />