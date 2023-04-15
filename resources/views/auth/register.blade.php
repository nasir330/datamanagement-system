<!-- Theme header -->
<x-header />

<body>
    <div class="card login-form">
        <div class="login-logo">
            <h4 class="text-uppercase text-primary text-bold text-center p-2">Logo here</h4>
        </div>
        <div class="card card-header bg-primary text-center text-white">
            <h4>Create Super Admin </h4>
        </div>
        <!-- Register section start -->
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="card card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group mb-2">
                        <input type="hidden" name="type" value="{{$userType->id}}">
                        <input type="text" name="username" class="form-control" placeholder="Enter username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group mb-2">
                        <input type="email" name="email" class="form-control" placeholder="Enter email address">
                    </div>
                </div>               
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>
                </div>
                <input type="hidden" name="status" value="Approved">

            </div>
            <div class="input-group">
                <button class="card-footer bg-primary btn btn-primary form-control">Register</button>
            </div>
        </form>
        <a href="{{route('login')}}" class="text-primary p-2">Back to <strong>Login</strong> page</a>

        <!-- Register section end -->
    </div>


    <!-- Theme footer -->
    <x-footer />