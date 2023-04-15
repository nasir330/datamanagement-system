<!-- Theme header -->
<x-header />

<body>
    <div class="card login-form">
    @if(session()->has('status'))
        <div id="successMessage" class="text-center text-danger p-1">
            {{session('status')}}
        </div>
        @endif
    <a href="{{route('login')}}" class="text-primary p-2"> <strong>SuperAdmin Login</strong></a> 
        <div class="card card-header bg-primary text-center text-white">
            <h5>User Login</h5>
        </div>
        <!-- Register section start -->
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="card card-body">
                <div class="form-group">
                    <label for="email">User email</label>
                    <div class="input-group mb-2">
                        <input type="email" name="email" class="form-control" placeholder="Enter email address">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">User password</label>
                    <div class="input-group mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>

            </div>
            <div class="input-group">
                <button class="card-footer bg-primary btn btn-primary form-control">Login</button>
            </div>
        </form>       
        <a href="{{route('register')}}" class="text-primary p-2"> <strong>Register</strong> a new account</a>

        <!-- Register section end -->
    </div>


    <!-- Theme footer -->
    <x-footer />