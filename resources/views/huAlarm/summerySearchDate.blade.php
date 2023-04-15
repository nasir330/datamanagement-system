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
                            <h1 class="m-0">Summery Per NeType</h1>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <!-- summery search by neType form start -->
                            <form action="{{route('summerySearchNeType')}}" method="post">
                                @csrf
                                <div class="row g-3 align-items-center mb-2">
                                    <div class="col-auto">
                                        <label for="neType_name" class="col-form-label">Search by NeType</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="neType_name" class="form-control" placeholder="Enter a NeType">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <!-- summery search by neType form end -->
                        </div>
                    </div>
                    <div class="row">
                        <!-- summery search by date form start -->
                        <form action="{{route('summerySearchDate')}}" method="post">
                            @csrf
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label for="date_from" class="col-form-label">Date from</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="date_from" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <label for="date_to" class="col-form-label">Date to</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="date_to" class="form-control">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                        <!-- summery search by date form end -->
                    </div>
                </div>
            </div>
            <!-- body content header end -->

            <!-- Body main content start -->
            <section class="content">
                <div class="container-fluid">
                    <!-- members data table start -->
                    <div class="row mb-4 p-2">
                        <table class="table table-striped table-hover">
                            <thead class="text-center text-uppercase">
                                <tr>
                                    <td>ID</td>
                                    <td>NeType</td>
                                    <td>Alarm Source</td>
                                    <td>Alarm Name</td>
                                    <td>Domain</td>                                    
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($summerySearchDate as $key=> $neType)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(!empty($neType->netypes))
                                        {{$neType->netypes->ne_type}}
                                        @else
                                        <strong class="text-danger">change/remove</strong>
                                        @endif
                                    </td>
                                    <td>{{$neType->aSource}} </td>
                                    <td>{{$neType->aName}} </td>
                                    <td>                                        
                                        @if(!empty($neType->netypes->domain))
                                        {{$neType->netypes->domain->domain}} 
                                        @else
                                        <strong class="text-danger">change/remove</strong>
                                        @endif
                                    </td>                                                                     
                                </tr>

                                @endforeach
                            </tbody>
                        </table>                       
                    </div>
                    <!-- members data table end -->
                </div>
            </section>
            <!-- Body main content end -->
        </div>
        <!-- body content end -->

        <!-- theme footer -->
        <x-footer />