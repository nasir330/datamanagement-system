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
                     <div class="col-6 p-4">
                         <h4>
                             Personal information
                             <a style="margin:2px; text-decoration:none;"
                                 href="{{route('profile.personalInfo.edit',['id'=>Auth::user()->id])}}">
                                 <i class="fa-solid fa-edit text-primary"></i>
                             </a>
                         </h4>
                         <form action="{{route('profile.personalInfo.update')}}" method="post">
                             @csrf
                             <div class="row mb-2">
                                 <div class="col-4">
                                     <label for="first_name">First Name</label>
                                     <div class="input-group">
                                         <input type="text" name="first_name" class="form-control"
                                             value="{{$users->member->first_name}}" required>
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
                                             value="{{$users->member->last_name}}" required>
                                     </div>
                                 </div>
                             </div>
                             <div class="row mb-2">
                                 <div class="col-4">
                                     <label for="suffix">Extension name (Sr./Jr.)</label>
                                     <div class="input-group">
                                         <select name="suffix" id="" class="form-select form-control">
                                             <option value="{{$users->member->suffix}}">
                                                 {{$users->member->suffix}}
                                             </option>
                                             <option value="sr.">Sr.</option>
                                             <option value="jr.">Jr.</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-4">
                                     <label for="gender">Gender</label>
                                     <div class="input-group">
                                         <select name="gender" id="" class="form-select form-control">
                                             <option value="{{$users->member->gender}}">
                                                 {{$users->member->gender}}
                                             </option>
                                             <option value="Male">Male</option>
                                             <option value="Female">Female</option>
                                             <option value="Other">Other</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-4">
                                     <label for="dob">Date of Birth</label>
                                     <div class="input-group">
                                         <input type="date" name="dob" class="form-control"
                                             value="{{$users->member->birth_date}}" required>
                                     </div>
                                 </div>

                             </div>

                             <div class="row mb-2">
                                 <div class="input-group">
                                     <button class="btn btn-primary">
                                         Update
                                     </button>
                                     &nbsp; <a href="{{route('profile.edit')}}" class="btn btn-warning">Cancel</a>
                                 </div>
                             </div>

                         </form>
                     </div>
                     <!-- personal information end -->

                     <div class="col-6 p-4">
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
                             <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
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