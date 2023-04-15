<!-- Theme header -->
<x-header />

<body class="dashboard-body">
    <div class="container-fluid">
        <!-- navigation start -->
        <div class="row">
            @include('template.nav')
        </div>
        <!-- navigation end -->


        <div class="row">
            <!-- menu start -->
            @include('template.menu')
            <!-- menu end -->

            <!-- dashboard section start -->
            <div class="col-10">
                <div class="row">
                    <div class="dashboard-seciton m-1">
                        <div class="row">
                            <h5 class="mb-2 p-2">User Logs</h5>
                        </div>
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
                        <!-- user search form start -->
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
                                    @foreach($searchByDate as $key=> $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->user->username}}</td>
                                        <td>{{$data->type}}</td>
                                        <td>
                                            @if(!empty($data->activitylog))
                                            <a href="{{route('userActivityLog',['id'=>$data->id])}}"
                                                class="text-primary">
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
                    </div>
                </div>
            </div>
            <!-- dashboard section start -->

        </div>


    </div>
    <!-- Theme footer -->
    <x-footer />