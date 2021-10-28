@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
               @if(auth()->user()->name == "police")

                @else
                    <a href="#" class="btn btn-success" data-toggle="modal" style="    margin-bottom: 15px;"
                       data-target="#addfacilities">Add Trusties</a>
                @endif
            </div>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="text-align: center;    font-size: 21px;">Shelter Trusties List </h5>
                    </div>
                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <form action="{{route('trusties-list')}}" method="get" role="search"
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
                                <table id="datatable"
                                       class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                       style="border-collapse: collapse; border-spacing: 0px; width: 100%;"
                                       role="grid" aria-describedby="datatable_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 158px;" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending">Sr.
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 241px;"
                                            aria-label="Position: activate to sort column ascending">Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 241px;"
                                            aria-label="Position: activate to sort column ascending"> Father Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 241px;"
                                            aria-label="Position: activate to sort column ascending">Contact
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 241px;"
                                            aria-label="Position: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 241px;"
                                            aria-label="Position: activate to sort column ascending">City
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 241px;"
                                            aria-label="Position: activate to sort column ascending">Amount
                                        </th>


                                        @if(auth()->user()->name == 'admin')

                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 82px;"
                                            aria-label="Salary: activate to sort column ascending">Action
                                        </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1
                                    @endphp
                                    @foreach($list as $l)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$l->name}}</td>
                                            <td>{{$l->f_name}}</td>
                                            <td>{{$l->contact}}</td>
                                            <td>{{$l->email}}</td>
                                            <td>{{$l->city}}</td>
                                            <td>{{$l->amount}}</td>

                                            @if(auth()->user()->name == "police")

                                            @else
                                                <td>
                                                    <a href="{{route('trusties-delete',['id'=>$l->id])}}"
                                                       class="btn btn-danger">Delete</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach()
                                    </tbody>
                                </table>
                                {{$list->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        <div id="addfacilities" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form method="POST" action="{{route('trusties-save')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Trusties</h4>
                        </div>
                        <div class="modal-body">
                            <label>Name:</label>
                            <input type="text" id="myName" class="form-control" required name="name"
                                   placeholder="Enter Name">

                            <label>Father Name:</label>
                            <input type="text" id="myFather" class="form-control" required name="f_name"
                                   placeholder="Enter Father Name">

                            <div class="form-group">
                                <label class="col-form-label">Contact</label>
                                <br>
                                <div class="">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+92</div>
                                        <input type="text" class="form-control" minlength="10" maxlength="10" name="contact" id="myContact" required placeholder="3044300000">
                                    </div>

                                </div>
                            </div>

                            <label>Email:</label>
                            <input type="email" class="form-control" required name="email" placeholder="Enter Email">

                            <label>City:</label>
                            <input type="text" id="myCity" class="form-control" required name="city"
                                   placeholder="Enter City">


                            <label>Amount:</label>
                            <input type="text" class="form-control" required name="amount" placeholder="Enter Ammount">


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
        $("#myFather").on("change", function () {
            var fName = $(this).val();
            if ($.isNumeric(fName) == true) {
                alert("Father Name can not be in integer");
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
