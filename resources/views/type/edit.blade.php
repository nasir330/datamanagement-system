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
                            <h1 class="m-0">Edit Type List</h1>
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
                        <div class="col-md-4 d-flex justify-content-center">
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

                    <div class="row col-md-6 mb-4">
                        <form action="{{route('updateType')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-9 form-group">
                                    <label for="type">Type Name</label>
                                    <div class="input-group">
                                        <input type="hidden" name="typeId" value="{{$data->id}}">
                                        <input type="text" name="type" class="form-control" value="{{$data->type}}">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-auto">
                                        <button class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{route('type')}}" class="btn btn-warning">Cancel</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />