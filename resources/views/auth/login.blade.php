<!-- Theme header -->
<x-header />

<body>
    <div class="card login-form">
        <div class="login-logo">
            <h4 class="text-uppercase text-primary text-bold text-center p-2">Logo here</h4>
        </div>
        @if(session()->has('success'))
        <div id="successMessage" class="text-center text-success p-1">
            {{session('success')}}
        </div>
        @endif
        @if(session()->has('error'))
        <div id="successMessage" class="text-center text-danger p-1">
            {{session('error')}}
        </div>
        @endif 
        <x-input-error :messages="$errors->get('email')" style="list-style:none;" class="text-danger mt-2" />
        <x-input-error :messages="$errors->get('username')" style="list-style:none;" class="text-danger mt-2" />
        <div class="card card-header bg-primary text-center text-white">
            <!-- <h5>User Login</h5> -->
            <h5>User Login</h5>
        </div>
        <!-- Login section start -->
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="card card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group mb-2">
                        <input type="text" name="username" class="form-control" placeholder="Enter email address">
                    </div>                   
                </div>

                <div class="form-group">
                    <label for="email">User password</label>
                    <div class="input-group mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
            </div>
            <div class="input-group">
                <button class="card-footer bg-primary btn btn-primary form-control">Login</button>
            </div>
        </form>
        <div class="row d-flex justify-content-between mt-3">
            <div class="col-6">
                <a href="{{route('register')}}" class="text-primary"> <strong>Register</strong> a new account</a>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{route('register')}}" class="text-primary"> <strong>Forgot</strong> password ?</a>
            </div>
        </div>
        <!-- Login section end -->
    </div>


    <!-- Theme footer -->
    <x-footer />