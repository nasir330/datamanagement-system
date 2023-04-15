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
                            <h1 class="m-0">Add New Member</h1>
                        </div>
                    </div>
                    <div class="row mb-4 p-2">
                        <strong>
                            ...* Please fill-in all required information below
                        </strong>
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

                    <!-- member create form start -->
                    <div class="row mb-4 p-2">
                        <form action="{{route('addMembers')}}" method="post">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="first_name">First Name</label>
                                    <div class="input-group">
                                        <input type="text" name="first_name" class="form-control"
                                            placeholder="Enter first name" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="middle_name">Middle Name</label>
                                    <div class="input-group">
                                        <input type="text" name="middle_name" class="form-control"
                                            placeholder="Enter middle name">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="last_name">Last Name</label>
                                    <div class="input-group">
                                        <input type="text" name="last_name" class="form-control"
                                            placeholder="Enter last name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="email">Email address</label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter email address" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter password" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="suffix">Extension name (Sr./Jr.)</label>
                                    <div class="input-group">
                                        <select name="suffix" id="" class="form-select form-control">
                                            <option value="">--Select here--</option>
                                            <option value="sr.">Sr.</option>
                                            <option value="jr.">Jr.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="gender">Gender</label>
                                    <div class="input-group">
                                        <select name="gender" id="" class="form-select form-control" required>
                                            <option value="">--Select here--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="dob">Date of Birth</label>
                                    <div class="input-group">
                                        <input type="date" name="dob" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="user_type">Append as</label>
                                    <div class="input-group">
                                        <select name="user_type" id="" class="form-select form-control" required>
                                            <option value="">--Select here--</option>
                                            @foreach($type as $key=> $item)
                                            <option value="{{$item->id}}">{{$item->type}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="status" value="Pending">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="input-group">
                                    <button class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- member create form end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />