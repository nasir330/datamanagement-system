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
                <!-- profile section navigation start -->
                <div class="row profile-hader bg-primary">
                    <!-- profile photo section start -->
                    <div class="col-auto p-4 d-flex justify-content-start">
                        @if(!empty(Auth::user()->member->photo))
                        <img class="img-fluid img-rounded-circle" src="{{asset('')}}{{Auth::user()->member->photo}}"
                            alt="">
                        @elseif(Auth::user()->member->gender == "Female")
                        <img class="img-fluid img-rounded-circle" src="{{asset('Assets/img/female.png')}}" alt="">
                        @else
                        <img class="img-fluid img-rounded-circle" src="{{asset('Assets/img/male.png')}}" alt="">
                        @endif
                        <span class="photo-edit-btn">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="icon fa-solid fa-camera p-2"></i>
                            </a>
                        </span>
                    </div>
                    <!-- profile photo section end -->
                    <!-- full name display start -->
                    <div class="col-auto p-4 mt-4">
                        <h4 class="text-white mt-4">
                            {{Auth::user()->member->first_name.' '.Auth::user()->member->last_name.' '.Auth::user()->member->middle_name}}
                            <br>
                            <strong class="text-dark">System Profile</strong>
                        </h4>
                    </div>
                    <!-- full name display end -->
                </div>
                <!-- profile section navigation end -->

                <!-- notification message section start -->
                <div class="row">
                    @if(session()->has('success'))
                    <div id="successMessage" class="text-center text-success p-1">
                        {{session('success')}}
                    </div>
                    @endif
                </div>
                <!-- notification message section end -->

                <!-- profile section body start -->
                <div class="row text-nowrap">
                    <!-- personal information start -->
                    <div class="col-4 p-4">
                        <h4>
                            Personal information
                            <a style="margin:2px; text-decoration:none;"
                                href="{{route('profile.personalInfo.edit',['id'=>Auth::user()->id])}}">
                                <i class="fa-solid fa-edit text-primary"></i>
                            </a>
                        </h4>
                        <div class="row">
                            <div class="col-3">Full Name</div>
                            <div class="col-6 d-flex justify-content-end">
                                {{Auth::user()->member->first_name.' '.Auth::user()->member->last_name.''.Auth::user()->member->middle_name}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">Birthday</div>
                            <div class="col-6 d-flex justify-content-end">
                                {{Carbon\Carbon::parse(Auth::user()->member->birth_date)->toFormattedDateString()}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">System Id</div>
                            <div class="col-6 d-flex justify-content-end">
                                {{Auth::user()->id}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">Record Appended</div>
                            <div class="col-6 d-flex justify-content-end">
                                {{Carbon\Carbon::parse(Auth::user()->created_at)->toFormattedDateString()}}
                            </div>
                        </div>
                    </div>
                    <!-- personal information end -->

                    <div class="col-8 p-4">
                        <div class="row">
                            <!-- profile info start -->
                            <div class="col-6">
                                <h4>
                                    Profile Information
                                    <a style="margin:2px; text-decoration:none;"
                                        href="{{route('profile.info.edit',['id'=>Auth::user()->id])}}">
                                        <i class="fa-solid fa-edit text-primary"></i>
                                    </a>
                                </h4>
                                <div class="row">
                                    <div class="col-4">Username</div>
                                    <div class="col-6 d-flex justify-content-end">
                                        {{Auth::user()->username}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Email</div>
                                    <div class="col-6 d-flex justify-content-end">
                                        {{Auth::user()->email}}
                                    </div>
                                </div>
                            </div>
                            <!-- profile info end -->
                            <!-- membership section start -->
                            <div class="col-4">
                                <h4>
                                    System Membership
                                    <a style="margin:2px; text-decoration:none;"
                                        href="{{route('profile.membership.update',['id'=>Auth::user()->id])}}">
                                        <i class="fa-solid fa-edit text-primary"></i>
                                    </a>
                                </h4>
                                <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        @if(Auth::user()->type == 1)
                                        <h4><i style="font-size:36px; color:#daa520;" class="fa-solid fa-user-tie"></i>
                                            {{Auth::user()->usertype->type}}</h4>
                                        @elseif(Auth::user()->type == 2)
                                        <h4><i style="font-size:36px; color:#e6bc53;" class="fa-solid fa-user-tie"></i>
                                            {{Auth::user()->usertype->type}}</h4>
                                        @else
                                        <h4><i style="font-size:36px; color:#87868c;" class="fa-solid fa-user-tie"></i>
                                            {{Auth::user()->usertype->type}}</h4>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- membership section end -->
                        </div>
                    </div>
                </div>
                <!-- profile section body end -->
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form action="{{route('edit.profile.photo')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Photo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <input type="hidden" name="memberId" value="{{Auth::user()->id}}">
                            <input type="file" name="photo" class="form-control" required>
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