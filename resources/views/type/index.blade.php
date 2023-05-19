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
                            <h1 class="m-0">Manage Type List</h1>
                        </div>
                    </div>
                    @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-end">
                            <form action="{{route('createType')}}" method="post">
                                @csrf
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="type" class="col-form-label">Type Name</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="type" class="form-control"
                                            placeholder="Enter Type Name" required>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
            <!-- body content header end -->

            <!-- Body main content start -->
            <section class="content">
                <div class="container-fluid">
                    <!-- notification alart section start -->
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center">
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

                    <div class="col-md-6">
                        <table class="table table-striped table-hover">
                            <thead class="text-center text-uppercase">
                                <tr>
                                    <td>#</td>
                                    <td>Type Name</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($types as $key=> $type)
                                <tr>
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->type}}</td>
                                    <td class="text-center">
                                        @if(Auth::user()->type == 1 || Auth::user()->type == 2)
                                        <a style="font-size:18px; margin:2px; text-decoration:none;"
                                            href="{{route('editType',['id'=> $type->id])}}">
                                            <i class="fa-solid fa-edit text-primary"></i>
                                        </a>
                                        <a style="font-size:18px; margin:2px; text-decoration:none;"
                                            href="{{route('deleteType',['id'=> $type->id])}}">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach()
                            </tbody>
                        </table>
                        <span>{{$types->links()}}</span>
                    </div>
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />