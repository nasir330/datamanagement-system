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
                            <h1 class="m-0">Add New HuAlarm</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <strong>
                                ...* Please fill-in all required information below
                            </strong>
                        </div>
                        <div class="col d-flex justify-content-end">
                            &nbsp;
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Import
                            </a>
                            &nbsp; <a href="{{route('huAlarm')}}" class="btn btn-warning">Cancel</a>
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

                    <!-- HuAlarm list table start -->
                    <div class="row mb-4 p-2">
                        <form action="{{route('storeHuAlarm')}}" method="post">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="logSNumber">LogSNumber</label>
                                    <div class="input-group">
                                        <input type="hidden" name="username" value="{{Auth::user()->username}}">
                                        <input type="text" name="logSNumber" class="form-control"
                                            placeholder="Enter LogSNumber" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="oIName">OIName</label>
                                    <div class="input-group">
                                        <input type="text" name="oIName" class="form-control" placeholder="Enter OIName"
                                            required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="objIden">ObjIden</label>
                                    <div class="input-group">
                                        <input type="text" name="objIden" class="form-control"
                                            placeholder="Enter ObjIden" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="nType">Ntype</label>
                                    <div class="input-group">
                                        <select name="nType" id="" class="form-select form-control" required>
                                            <option value="">--Select Ntype--</option>
                                            @foreach($neTypes as $nType)
                                            <option value="{{$nType->ne_type}}">{{$nType->ne_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="identity">Identity</label>
                                    <div class="input-group">
                                        <input type="text" name="identity" class="form-control"
                                            placeholder="Enter Identity" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="aSource">Asource</label>
                                    <div class="input-group">
                                        <input type="text" name="aSource" class="form-control"
                                            placeholder="Enter Asource" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="eAlrmSN">EAlrmSN</label>
                                    <div class="input-group">
                                        <input type="text" name="eAlrmSN" class="form-control"
                                            placeholder="Enter EAlrmSN" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="aName">Aname</label>
                                    <div class="input-group">
                                        <input type="text" name="aName" class="form-control" placeholder="Enter Aname"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="type">Type</label>
                                    <div class="input-group">
                                        <select name="type" id="" class="form-select form-control" required>
                                            <option value="">--Select type--</option>
                                            @foreach($types as $type)
                                            <option value="{{$type->type}}">{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="sev">Sev</label>
                                    <div class="input-group">
                                        <select name="sev" id="" class="form-select form-control" required>
                                            <option value="">--Select Sev--</option>
                                            @foreach($severites as $sev)
                                            <option value="{{$sev->severity}}">{{$sev->severity}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="status">Status</label>
                                    <div class="input-group">
                                        <input type="text" name="status" class="form-control" placeholder="Enter Status"
                                            required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="oTime">Otime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="oTime" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="ackTime">AckTime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="ackTime" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="cTime">Ctime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="cTime" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="unAckOper">UNAckOper</label>
                                    <div class="input-group">
                                        <input type="text" name="unAckOper" class="form-control"
                                            placeholder="Enter UNAckOper" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="clrOper">ClrOper</label>
                                    <div class="input-group">
                                        <input type="text" name="clrOper" class="form-control"
                                            placeholder="Enter ClrOper">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="locInfor">LocInfor</label>
                                    <div class="input-group">
                                        <input type="text" name="locInfor" class="form-control"
                                            placeholder="Enter LocInfor">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="lnkFDN">LnkFDN</label>
                                    <div class="input-group">
                                        <input type="text" name="lnkFDN" class="form-control"
                                            placeholder="Enter LnkFDN">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="lnkName">LnkName</label>
                                    <div class="input-group">
                                        <input type="text" name="lnkName" class="form-control"
                                            placeholder="Enter LnkName">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="ltype">Ltype</label>
                                    <div class="input-group">
                                        <input type="text" name="ltype" class="form-control" placeholder="Enter Ltype">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="alrmIdent">AlrmIdent</label>
                                    <div class="input-group">
                                        <input type="text" name="alrmIdent" class="form-control"
                                            placeholder="Enter AlrmIdent">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="alrmId">AID</label>
                                    <div class="input-group">
                                        <input type="text" name="alrmId" class="form-control" placeholder="Enter AID">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="oType">Otype</label>
                                    <div class="input-group">
                                        <input type="text" name="oType" class="form-control" placeholder="Enter Otype">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="autoClear">AutoClear</label>
                                    <div class="input-group">
                                        <input type="text" name="autoClear" class="form-control"
                                            placeholder="Enter AutoClear">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="aCType">ACType</label>
                                    <div class="input-group">
                                        <input type="text" name="aCType" class="form-control"
                                            placeholder="Enter ACType">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="busaffected">busaffected</label>
                                    <div class="input-group">
                                        <input type="text" name="busaffected" class="form-control"
                                            placeholder="Enter busaffected">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="addText">addText</label>
                                    <div class="input-group">
                                        <input type="text" name="addText" class="form-control"
                                            placeholder="Enter addText">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="arriUtcTime">arriUtcTime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="arriUtcTime" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="lstid">lstid</label>
                                    <div class="input-group">
                                        <input type="text" name="lstid" class="form-control" placeholder="Enter lstid">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="relLogId">relLogId</label>
                                    <div class="input-group">
                                        <input type="text" name="relLogId" class="form-control"
                                            placeholder="Enter relLogId">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="aid">Aid</label>
                                    <div class="input-group">
                                        <input type="text" name="aid" class="form-control" placeholder="Enter Aid">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="rid">rid</label>
                                    <div class="input-group">
                                        <input type="text" name="rid" class="form-control" placeholder="Enter rid">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="input-group">
                                    <button class="btn btn-info mt-2">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- HuAlarm list table end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form action="{{route('importHuAlarm')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Excel file</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <input type="file" name="importFile_alarm" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- theme footer -->
        <x-footer />