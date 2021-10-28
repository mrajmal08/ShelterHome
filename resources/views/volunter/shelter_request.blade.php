@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="btn btn-success" data-toggle="modal" style="    margin-bottom: 15px;"
                   data-target="#addfacilities">Add Shelter Request</a>
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
                    <div class="card-body">
                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="datatable_length">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
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
                                                aria-label="Position: activate to sort column ascending">CNIC
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 241px;"
                                                aria-label="Position: activate to sort column ascending">City
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 241px;"
                                                aria-label="Position: activate to sort column ascending">Image
                                            </th>

                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 241px;"
                                                aria-label="Position: activate to sort column ascending">Scan Qr
                                            </th>

                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 82px;"
                                                aria-label="Salary: activate to sort column ascending">Action
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @php $i=1;
                                        @endphp

                                        @foreach($list as $l)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$l->name}}</td>
                                                <td>{{$l->f_name}}</td>
                                                <td>{{$l->contact}}</td>
                                                <td>{{$l->cnic}}</td>
                                                <td>{{$l->city}}</td>
                                                <td>
                                                <img src="{{ asset('images')."/".$l->image }}" style="width: 50px;height: 50px;" />
                                                </td>
                                                <td>
                                                    {!! QrCode::size(100)->generate(
    "Name: ".$l->name."\n"."Father Name: ".$l->f_name."\n"."Contact: ".$l->contact."\n"."CNIC: ".$l->cnic."\n"."City:".$l->city."\n"."Image: ". asset('images')."/".$l->image

) !!}
                                                </td>

                                                <td><a href="{{route('shelter-delete',['id'=>$l->id])}}"
                                                       class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach()
                                        </tbody>
                                    </table>
                                    {{ $list->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>


        <div id="addfacilities" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form method="POST" action="{{route('shelter-request-save')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Shelter Request</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <label>Name:</label>
                            <input type="text" id="myName" class="form-control" required name="name" placeholder="Enter your nice name">

                            <label>Father Name:</label>
                            <input type="text" id="myFather" class="form-control" required name="f_name" placeholder="Enter your father name">

                            <label>Contact:</label>

                                <label>Contact</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+92</div>
                                    </div>
                                    <input type="text" class="form-control" minlength="10" maxlength="10" name="contact" id="myContact" placeholder="3044300000">
                                </div>

                            <label>City:</label>
                            <input type="text" id="myCity" class="form-control" required name="city" placeholder="Enter Your City name">

                            <label>CNIC:</label>
                            <input type="text" id="cnic" maxlength='15' class="form-control" name="cnic" placeholder="34603-1166609-7">


                            <div class="mt-2 form-group">
                            <label>Image:</label>
                            <input type="file" class="form-control" required name="image" required>
                            </div>
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
        $("#myName").on("change", function() {
            var name = $(this).val();
            if($.isNumeric(name) == true){
                alert("Name can not be in integer");
            }
        });
        $("#myFather").on("change", function() {
            var fName = $(this).val();
            if($.isNumeric(fName) == true){
                alert("Father Name can not be in integer");
            }
        });
        $("#myCity").on("change", function() {
            var city = $(this).val();
            if($.isNumeric(city) == true){
                alert("City can not be in integer");
            }
        });

    </script>

    <script>
        $(document).ready(function () {
            $("#cnic").keyup(function () {
                if ($(this).val().length == 5) {
                    $(this).val($(this).val() + "-");
                }
                else if ($(this).val().length == 13) {
                    $(this).val($(this).val() + "-");
                }
                else if ($(this).val().length == 15) {
                    $(this).val($(this).val());
                }
            });
        });
    </script>

@endsection()
