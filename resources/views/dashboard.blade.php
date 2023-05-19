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
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- user search form start -->
                            <form id="userSearchForm" action="{{route('dashboardSearchUser')}}" method="post">
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
                                        <button id="searchUserbtn" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <!-- user search form end -->
                        </div>
                    </div>
                    <div class="row">
                        <!-- date search form start -->
                        <form id="dateSearchForm" action="{{route('dashboardSearchbyDate')}}" method="post">
                            @csrf
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label for="date_from" class="col-form-label">From date</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="date_from" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <label for="date_to" class="col-form-label">To date</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="date_to" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <button id="searchDatebtn" class="btn btn-primary">Search</button>
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
                    <!-- Main row start-->
                    <div class="row">
                        <div class="card piechart mb-2">
                            <div class="card-header text-white">
                                <h5>Pie chart summery</h5>
                            </div>
                            <div id="donutchart" style="height: 380px; width: 100%;"></div>
                        </div>
                        <div class="card barChart mb-2">
                            <div class="card-header text-white">
                                <h5>Bar chart summery</h5>
                            </div>
                            <div id="barChart" style="height: 280px; width: 100%;"></div>
                        </div>
                    </div>
                    <!-- Main row end-->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />