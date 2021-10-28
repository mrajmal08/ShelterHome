@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if(auth()->user()->name == "police")

                @else
                    <a href="#" class="btn btn-success" data-toggle="modal" style="    margin-bottom: 15px;"
                       data-target="#addfacilities">Add Shelter Home</a>
                @endif
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="text-align: center; font-size: 21px;">Shelter Home List</h5>
                    </div>
                    <div id="table_id" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>

                        <form action="{{route('admin-shelter-home')}}" method="get" role="search"
                              style="margin-bottom:20px;">
                            <div class="row" style="margin:0px;">
                                <div class="col-md-7 col-lg-7 col-sm-7 text-left">
                                    <button type="submit" value="refresh">Refresh</button>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3">
                                    <label>Search By Name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="search"
                                               placeholder="Search by Name">
                                    </div>
                                </div>
                                <div class="col-lg-2 text-left" style="margin-top: 1.7rem;">
                                    <button type="submit" style="width:100%;" class="btn btn-primary">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-sm-12">
                                <table
                                    class="table table-bordered table-responsive table-striped">
                                    <thead>
                                    <tr role="row">

                                        <th class="col-sm-2">Home Name</th>
                                        <th  class="col-sm-3">Shelter Home Contact</th>
                                        <th class="col-sm-1">Home City</th>
                                        <th class="col-sm-2">Home Address</th>
                                        <th class="col-sm-1">Total Space</th>
                                        <th class="col-sm-2">Space Available</th>
                                        @if(auth()->user()->name == 'admin')
                                        
                                        <th class="col-sm-2">Action</th>
                                    
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->contact}}</td>
                                            <td>{{$value->city}}</td>
                                            <td>{{$value->address}}</td>
                                            <td>{{$value->total_rooms}}</td>
                                            <td>{{$value->remaining_rooms}}</td>
                                           @if(auth()->user()->name == "police")

                                            @else
                                                <td>
                                                    <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                       data-target="#edit{{ $value->id }}">Edit</a>
                                                    <a href="{{route('home-delete',['id'=>$value->id])}}"
                                                       class="btn btn-danger btn-sm">Delete
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>

                                        <div id="edit{{ $value->id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <form method="POST" action="{{route('home-edit')}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Shelter Home</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                                            <label>Shelter Home Name:</label>
                                                            <input type="text" class="form-control" required
                                                                   name="name" value="{{ $value->name }}">

                                                            <label>Shelter Home Contact:</label>
                                                            <input type="text" class="form-control" required
                                                                   name="contact" minlength="12" maxlength="12"
                                                                   value="{{ $value->contact }}">

                                                            <label>Shelter Home City:</label>
                                                            <input type="text" class="form-control" required
                                                                   name="city" value="{{ $value->city }}">

                                                            <label>Shelter Home Address:</label>
                                                            <input type="text" class="form-control" required
                                                                   name="address" value="{{ $value->address }}">

                                                            <label>Total Space?</label>
                                                            <input type="number" class="form-control" required
                                                                   name="total_rooms"
                                                                   value="{{ $value->total_rooms }}">

                                                            <label>Remaining Space?</label>
                                                            <input type="number" class="form-control" required
                                                                   name="remaining_rooms"
                                                                   value="{{ $value->remaining_rooms }}">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <input type="submit" value="Submit"
                                                                   class="btn btn-primary">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach()
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        <div id="addfacilities" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form method="POST" action="{{route('admin-shelter-home-save')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Shelter Home</h4>
                        </div>
                        <div class="modal-body">
                            <label>Shelter Home Name:</label>
                            <input type="text" id="myName" class="form-control" required name="name"
                                   placeholder="Enter Shelter Home">


                                <label>Shelter Home Contact:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+92</div>
                                    </div>
                                    <input type="text" class="form-control" minlength="10" maxlength="10" name="contact" id="myContact" placeholder="3044300000">
                                </div>


{{--                            <label>Shelter Home Contact:</label>--}}
{{--                            <input type="text" minlength="12" maxlength="12" class="form-control" required--}}
{{--                                   name="contact" placeholder="923000000000">--}}

                            <label>Shelter Home City:</label>
                            <input type="text" id="myCity" class="form-control" required name="city"
                                   placeholder="Enter City Name">

                            <label>Shelter Home Address:</label>
                            <input type="text" id="myAddress" class="form-control" required name="address"
                                   placeholder="Enter Address">

                            <label>Total Rooms You Have?</label>
                            <input type="number" class="form-control" required name="total_rooms">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("#myName").on("change", function () {
            var name = $(this).val();
            if ($.isNumeric(name) == true) {
                alert("Name can not be in integer");
            }
        });
        $("#myAddress").on("change", function () {
            var address = $(this).val();
            if ($.isNumeric(address) == true) {
                alert("Address can not be in integer");
            }
        });
        $("#myCity").on("change", function () {
            var city = $(this).val();
            if ($.isNumeric(city) == true) {
                alert("City can not be in integer");
            }
        });

    </script>

@endsection()
