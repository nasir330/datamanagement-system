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
                            <h1 class="m-0">Members search result</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- user search form start -->
                            <form action="{{route('searchMembers')}}" method="post">
                                @csrf
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label for="name" class="col-form-label">First/Last Name</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="name" class="form-control" placeholder="Enter a name">
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
                        <form action="{{route('searchMembersByDate')}}" method="post">
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
                    <!-- members data table start -->
                    <div class="row mb-4 p-2">
                        <table class="table table-striped table-hover">
                            <thead class="text-center text-uppercase">
                                <tr>
                                    <td>ID</td>
                                    <td>Last Name</td>
                                    <td>First Name</td>
                                    <td>Middle Name</td>
                                    <td>Suffix</td>
                                    <td>Birth Date</td>
                                    <td>Gender</td>
                                    <td>Updated at</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($memberSearch as $key=> $members)
                                <tr>
                                    <td>{{$members->id}}</td>
                                    <td>{{$members->last_name}} </td>
                                    <td>{{$members->first_name}} </td>
                                    <td>{{$members->middle_name}} </td>
                                    <td>{{$members->suffix}} </td>
                                    <td>{{$members->birth_date}} </td>
                                    <td>{{$members->gender}} </td>
                                    <td> {{Carbon\Carbon::parse($members->updated_at)->toDayDateTimeString()}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- members data table end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />