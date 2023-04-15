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
                            <h1 class="m-0">List of HuAlarm</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- user search form start -->
                            <form action="{{route('searchHuAlarmbyName')}}" method="post">
                                @csrf
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label for="oIName" class="col-form-label">OIName</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="OIName" class="form-control"
                                            placeholder="Enter  OIName">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <!-- user search form start -->
                        </div>
                    </div>
                    <div class="row">
                        <!-- search by date start -->
                        <form action="{{route('searchHuAlarmbyDate')}}" method="post">
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
                                    <button class="btn btn-primary">Search</button>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary">Refresh</button>
                                </div>
                            </div>
                        </form>
                        <!-- search by date end -->
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
                         
                            @if(session()->has('delete-success'))
                            <div id="successMessage" class="text-center text-danger p-1">
                                {{session('delete-success')}}
                            </div>
                            @elseif(session()->has('success'))
                            <div id="successMessage" class="text-center text-success p-1">
                                {{session('success')}}
                            </div>
                            @else
                            @endif
                        </div>
                    </div>
                    <!-- notification alart section end -->

                    <!-- HuAlarm list table start -->
                    <div class="row">
                        <table style="font-size:14px;" class="table table-striped table-hover">
                            <thead class="text-center text-uppercase">
                                <tr>
                                    <td>#</td>
                                    <td>OIName</td>
                                    <td>NE Type</td>
                                    <td>Domain</td>
                                    <td>NE Object Identity</td>
                                    <td>Alarm Source</td>
                                    <td>Alarm Name</td>
                                    <td>Type</td>
                                    <td>Severity</td>
                                    <td>Status</td>
                                    <td>Clearence Operator</td>
                                    <td>Location Information</td>
                                    <td>Additional Text</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($huAlarms as $key=> $huAlarm)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$huAlarm->oIName}}</td>
                                    <td>
                                        @if(!empty($huAlarm->netypes))
                                        {{$huAlarm->netypes->ne_type}}
                                        @else
                                        <strong class="text-danger">change/remove</strong>
                                        @endif

                                    </td>
                                    <td>
                                        @if(!empty($huAlarm->netypes->domain))
                                        {{$huAlarm->netypes->domain->domain}}
                                        @else
                                        <strong class="text-danger">change/remove</strong>
                                        @endif

                                    </td>
                                    <td>{{$huAlarm->objIden}}</td>
                                    <td>{{$huAlarm->aSource}}</td>
                                    <td>{{$huAlarm->aName}}</td>
                                    <td>{{$huAlarm->type}}</td>
                                    <td>{{$huAlarm->sev}}</td>
                                    <td>{{$huAlarm->status}}</td>
                                    <td>{{$huAlarm->clrOper}}</td>
                                    <td>{{$huAlarm->locInfor}}</td>
                                    <td>{{$huAlarm->addText}}</td>
                                    <td class="text-center">
                                        @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                                        <a style="font-size:18px; margin:2px; text-decoration:none;"
                                            href="{{route('editHuAlarm',['id'=>$huAlarm->id])}}">
                                            <i class="fa-solid fa-edit text-primary"></i>
                                        </a>
                                        <a style="font-size:18px; margin:2px; text-decoration:none;"
                                            href="{{route('deleteHuAlarm',['id'=>$huAlarm->id])}}">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span>{{$huAlarms->links()}}</span>
                    </div>
                    <!-- HuAlarm list table end -->

                    <!-- button and export to csv/excel start -->
                    @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                    <div class="row mb-2">
                        <div class="col-auto">
                            <a href="{{route('createHuAlarm')}}" class="btn btn-success">Add New</a>
                        </div>
                        <div class="col-auto">
                            <form action="{{route('exportHuAlarm')}}" method="post">
                                @csrf
                                <button class="btn btn-primary">
                                    Export
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <!-- button and export to csv/excel end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />