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
                            <h1 class="m-0"> HuAlarm Edit </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <strong>
                                ...* Please fill-in all required information below
                            </strong>
                        </div>
                        <div class="col d-flex justify-content-end">
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
                        <form action="{{route('updateHuAlarm')}}" method="post">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="logSNumber">LogSNumber</label>
                                    <div class="input-group">
                                        <input type="hidden" name="id" value="{{$editAlarm->id}}">
                                        <input type="hidden" name="username" value="{{$editAlarm->username}}">
                                        <input type="text" name="logSNumber" class="form-control"
                                            value="{{$editAlarm->logSNumber}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="oIName">OIName</label>
                                    <div class="input-group">
                                        <input type="text" name="oIName" class="form-control"
                                            value="{{$editAlarm->oIName}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="objIden">ObjIden</label>
                                    <div class="input-group">
                                        <input type="text" name="objIden" class="form-control"
                                            value="{{$editAlarm->objIden}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="nType">Ntype</label>
                                    <div class="input-group">
                                        <select name="nType" id="" class="form-select form-control" required>
                                            <option value="{{$editAlarm->nType}}">{{$editAlarm->netypes->ne_type}}
                                            </option>
                                            @foreach($neTypes as $nType)
                                            <option value="{{$nType->id}}">{{$nType->ne_type}}</option>
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
                                            value="{{$editAlarm->identity}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="aSource">Asource</label>
                                    <div class="input-group">
                                        <input type="text" name="aSource" class="form-control"
                                            value="{{$editAlarm->aSource}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="eAlrmSN">EAlrmSN</label>
                                    <div class="input-group">
                                        <input type="text" name="eAlrmSN" class="form-control"
                                            value="{{$editAlarm->eAlrmSN}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="aName">Aname</label>
                                    <div class="input-group">
                                        <input type="text" name="aName" class="form-control"
                                            value="{{$editAlarm->aName}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="type">Type</label>
                                    <div class="input-group">
                                        <select name="type" id="" class="form-select form-control" required>
                                            <option value="{{$editAlarm->type}}">{{$editAlarm->types->type}}</option>
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="sev">Sev</label>
                                    <div class="input-group">
                                        <select name="sev" id="" class="form-select form-control" required>
                                            <option value="{{$editAlarm->sev}}">
                                                {{$editAlarm->sev}}
                                            </option>
                                            @foreach($severites as $sev)
                                            <option value="{{$sev->id}}">{{$sev->severity}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="status">Status</label>
                                    <div class="input-group">
                                        <input type="text" name="status" class="form-control"
                                            value="{{$editAlarm->status}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="oTime">Otime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="oTime" class="form-control"
                                            value="{{date('Y-m-d\TH:i:s', strtotime($editAlarm->oTime))}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="ackTime">AckTime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="ackTime" class="form-control"
                                            value="{{date('Y-m-d\TH:i:s', strtotime($editAlarm->ackTime))}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="cTime">Ctime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="cTime" class="form-control"
                                            value="{{date('Y-m-d\TH:i:s', strtotime($editAlarm->cTime))}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="unAckOper">UNAckOper</label>
                                    <div class="input-group">
                                        <input type="text" name="unAckOper" class="form-control"
                                            value="{{$editAlarm->unAckOper}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="clrOper">ClrOper</label>
                                    <div class="input-group">
                                        <input type="text" name="clrOper" class="form-control"
                                            value="{{$editAlarm->clrOper}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="locInfor">LocInfor</label>
                                    <div class="input-group">
                                        <input type="text" name="locInfor" class="form-control"
                                            value="{{$editAlarm->locInfor}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="lnkFDN">LnkFDN</label>
                                    <div class="input-group">
                                        <input type="text" name="lnkFDN" class="form-control"
                                            value="{{$editAlarm->lnkFDN}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="lnkName">LnkName</label>
                                    <div class="input-group">
                                        <input type="text" name="lnkName" class="form-control"
                                            value="{{$editAlarm->lnkName}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="ltype">Ltype</label>
                                    <div class="input-group">
                                        <input type="text" name="ltype" class="form-control"
                                            value="{{$editAlarm->ltype}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="alrmIdent">AlrmIdent</label>
                                    <div class="input-group">
                                        <input type="text" name="alrmIdent" class="form-control"
                                            value="{{$editAlarm->alrmIdent}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="alrmId">AID</label>
                                    <div class="input-group">
                                        <input type="text" name="alrmId" class="form-control"
                                            value="{{$editAlarm->alrmId}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="oType">Otype</label>
                                    <div class="input-group">
                                        <input type="text" name="oType" class="form-control"
                                            value="{{$editAlarm->oType}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="autoClear">AutoClear</label>
                                    <div class="input-group">
                                        <input type="text" name="autoClear" class="form-control"
                                            value="{{$editAlarm->autoClear}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="aCType">ACType</label>
                                    <div class="input-group">
                                        <input type="text" name="aCType" class="form-control"
                                            value="{{$editAlarm->aCType}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="busaffected">busaffected</label>
                                    <div class="input-group">
                                        <input type="text" name="busaffected" class="form-control"
                                            value="{{$editAlarm->busaffected}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="addText">addText</label>
                                    <div class="input-group">
                                        <input type="text" name="addText" class="form-control"
                                            value="{{$editAlarm->addText}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="arriUtcTime">arriUtcTime</label>
                                    <div class="input-group">
                                        <input type="datetime-local" name="arriUtcTime" class="form-control"
                                            value="{{date('Y-m-d\TH:i:s', strtotime($editAlarm->arriUtcTime))}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="lstid">lstid</label>
                                    <div class="input-group">
                                        <input type="text" name="lstid" class="form-control"
                                            value="{{$editAlarm->lstid}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="relLogId">relLogId</label>
                                    <div class="input-group">
                                        <input type="text" name="relLogId" class="form-control"
                                            value="{{$editAlarm->relLogId}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="aid">Aid</label>
                                    <div class="input-group">
                                        <input type="text" name="aid" class="form-control" value="{{$editAlarm->aid}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="rid">rid</label>
                                    <div class="input-group">
                                        <input type="text" name="rid" class="form-control" value="{{$editAlarm->rid}}">
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