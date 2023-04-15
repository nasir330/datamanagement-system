<!-- Theme header -->
<x-header />

<body>
    <div class="card login-form">
        @if(session()->has('success'))
        <div id="successMessage" class="text-center text-success p-1">
            {{session('success')}}
        </div>
        @endif
        <div class="login-logo">
            <h4 class="text-uppercase text-primary text-bold text-center p-2">Logo here</h4>
        </div>
        <div class="card card-header bg-primary text-center text-white">
            <h4>Register New User</h4>
        </div>
        <!-- Register section start -->
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="card card-body">
                <div class="input-group mb-2">
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                </div>
                <div class="input-group mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Enter email address">
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                </div>

                <div class="input-group mb-2">
                    <select name="type" id="" class="form-select form-control" required>
                        <option value="">--User Type--</option>
                        @foreach($type as $key=> $item)
                        <option value="{{$item->id}}">{{$item->type}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="status" value="Pending">
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