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
                            <h1 class="m-0">Edit User Data</h1>
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

                    <!-- user data edit form start -->
                    <div class="row mb-4 p-2">
                        <form action="{{route('userEditSave')}}" method="post">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="first_name">First Name</label>
                                    <div class="input-group">
                                        <input type="hidden" name="id" value="{{$users->id}}">
                                        <input type="text" name="first_name" class="form-control"
                                            value="{{$users->member->first_name}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="middle_name">Middle Name</label>
                                    <div class="input-group">
                                        <input type="text" name="middle_name" class="form-control"
                                            value="{{$users->member->middle_name}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="last_name">Last Name</label>
                                    <div class="input-group">
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{$users->member->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="suffix">Extension name (Sr./Jr.)</label>
                                    <div class="input-group">
                                        <select name="suffix" id="" class="form-select form-control">
                                            <option value="{{$users->member->suffix}}">{{$users->member->suffix}}
                                            </option>
                                            <option value="sr.">Sr.</option>
                                            <option value="jr.">Jr.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="gender">Gender</label>
                                    <div class="input-group">
                                        <select name="gender" id="" class="form-select form-control" required>
                                            <option value="{{$users->member->gender}}">{{$users->member->gender}}
                                            </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="dob">Date of Birth</label>
                                    <div class="input-group">
                                        <input type="date" name="dob" class="form-control"
                                            value="{{$users->member->birth_date}}">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="user_type">Append as</label>
                                    <div class="input-group">
                                        <select name="user_type" id="" class="form-select form-control" required>
                                            <option value="{{$users->usertype->id}}">{{$users->usertype->type}}
                                            </option>
                                            @foreach($type as $key=> $item)
                                            <option value="{{$item->id}}">{{$item->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="input-group">
                                    <button class="btn btn-primary">
                                        Update
                                    </button>
                                    &nbsp; <a href="{{route('allUsers')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- user data edit form end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />