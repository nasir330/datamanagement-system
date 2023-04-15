<!-- Theme header -->
<x-header/>

<body>   
    @if($data->isEmpty())
    @include('auth.register')
    @else
    @include('auth.login')
    @endif

<!-- Theme footer -->
<x-footer/>