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
            <!-- Body main content start -->
            <section class="content">
                <div class="container-fluid">
                    @if(!empty($setting))
                    <form action="{{route('updateSetting')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4 d-flex justify-content-start mt-2">
                                <h5 class="mb-2 p-2">Settings</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center mt-2">
                                @if(session()->has('success'))
                                <div id="successMessage" class="text-center text-success p-1">
                                    {{session('success')}}
                                </div>
                                @endif
                            </div>
                            <div class="col-4 d-flex justify-content-end mt-2">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <button class="btn btn-success">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item-section mb-2">
                            <div class="card-header bg-primary text-white">
                                <strong>Application</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Application Display Name</td>
                                        <td>
                                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                            <input class="form-control" type="text" name="appName"
                                                value="{{$setting->appName}}">
                                        </td>
                                        <td>Application display name that will be place into header above</td>
                                    </tr>
                                    <tr>
                                        <td>Application Logo</td>
                                        <td>                                          
                                            <input class="form-control" type="file" name="appLogo">
                                        </td>
                                        <td>Application display name that will be place into header above</td>
                                    </tr>
                                    <tr>
                                        <td>Session Expiration</td>
                                        <td>
                                            <input class="form-control" type="number" name="sessionExpiration"
                                                value="{{$setting->sessionExpiration/60}}">
                                        </td>
                                        <td>Sesseion expiration once user deactivated the app</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="setting-item-section mb-2">
                            <div class="card-header bg-primary text-white">
                                <strong>Pagination</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Page size</td>
                                        <td>
                                            <input class="form-control" type="text" name="pagination"
                                                value="{{$setting->pagination}}">
                                        </td>
                                        <td>The page size or the top records that will be retrive from the database
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="setting-item-section mb-2">
                            <div class="card-header bg-primary text-white">
                                <strong>Excel import and export</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Excel path</td>
                                        <td>
                                            <input name="filePath" type="file" webkitdirectory="true" directory
                                                value="{{$setting->filePath}}" />
                                        </td>
                                        <td>Localtion where exported file will be saved</td>
                                    </tr>
                                    <tr>
                                        <td>Excel file name</td>
                                        <td>
                                            <input class="form-control" name="fileName" type="text"
                                                value="{{$setting->fileName}}" />
                                        </td>
                                        <td>file name for exported file</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="setting-item-section mb-4">
                            <div class="card-header bg-primary text-white">
                                <strong>Theme</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Theme Mode</td>
                                        <td>
                                            <select name="themeMode" class="form-select form-control">
                                                <option value="">Default</option>
                                                <option value="">Dark</option>
                                            </select>
                                        </td>
                                        <td>Theme mode</td>
                                    </tr>
                                    <tr>
                                        <td>Accent color</td>
                                        <td>
                                            <input class="form-control" name="accentColor" type="text" />
                                        </td>
                                        <td>Primary color</td>
                                    </tr>
                                    <tr>
                                        <td>Sub-accent color</td>
                                        <td>
                                            <input class="form-control" name="subAccentColor" type="text" />
                                        </td>
                                        <td>Secondary color</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    @else
                    <form action="{{route('storeSetting')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4 d-flex justify-content-start mt-2">
                                <h5 class="mb-2 p-2">Settings</h5>
                            </div>
                            <div class="col-4 d-flex justify-content-center mt-2">
                                @if(session()->has('success'))
                                <div id="successMessage" class="text-center text-success p-1">
                                    {{session('success')}}
                                </div>
                                @endif
                            </div>
                            <div class="col-4 d-flex justify-content-end mt-2">
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <button class="btn btn-success">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="setting-item-section mb-2">
                            <div class="card-header bg-primary text-white">
                                <strong>Application</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Application Display Name</td>
                                        <td>
                                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                            <input class="form-control" type="text" name="appName" value="" required>
                                        </td>
                                        <td>Application display name that will be place into header above</td>
                                    </tr>
                                    <tr>
                                        <td>Application Logo</td>
                                        <td>                                          
                                            <input class="form-control" type="file" name="appLogo">
                                        </td>
                                        <td>Application display name that will be place into header above</td>
                                    </tr>
                                  
                                    <tr>
                                        <td>Session Expiration</td>
                                        <td>
                                            <input class="form-control" type="number" name="sessionExpiration" value="" required>
                                        </td>
                                        <td>Sesseion expiration once user deactivated the app</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="setting-item-section mb-2">
                            <div class="card-header bg-primary text-white">
                                <strong>Pagination</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Page size</td>
                                        <td>
                                            <input class="form-control" type="text" name="pagination" value="">
                                        </td>
                                        <td>The page size or the top records that will be retrive from the database
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="setting-item-section mb-2">
                            <div class="card-header bg-primary text-white">
                                <strong>Excel import and export</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Excel path</td>
                                        <td>
                                            <input name="filePath" type="file" webkitdirectory="true" directory
                                                value="" />
                                        </td>
                                        <td>Localtion where exported file will be saved</td>
                                    </tr>
                                    <tr>
                                        <td>Excel file name</td>
                                        <td>
                                            <input class="form-control" name="fileName" type="text" value="" />
                                        </td>
                                        <td>file name for exported file</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="setting-item-section mb-4">
                            <div class="card-header bg-primary text-white">
                                <strong>Theme</strong>
                            </div>
                            <table class="table no-border">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">Name</th>
                                        <th style="width:30%;">Value</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Theme Mode</td>
                                        <td>
                                            <select name="themeMode" class="form-select form-control">
                                                <option value="">Default</option>
                                                <option value="">Dark</option>
                                            </select>
                                        </td>
                                        <td>Theme mode</td>
                                    </tr>
                                    <tr>
                                        <td>Accent color</td>
                                        <td>
                                            <input class="form-control" name="accentColor" type="text" />
                                        </td>
                                        <td>Primary color</td>
                                    </tr>
                                    <tr>
                                        <td>Sub-accent color</td>
                                        <td>
                                            <input class="form-control" name="subAccentColor" type="text" />
                                        </td>
                                        <td>Secondary color</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    @endif
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />