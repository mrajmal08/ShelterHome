@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
                  @if(auth()->user()->name == "police")

                @else
                    <a href="#" class="btn btn-success" data-toggle="modal" style="    margin-bottom: 15px;"
                       data-target="#addfacilities">Add Facilites</a>
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
                        <h5 style="text-align: center;    font-size: 21px;">Shelter Facilities List </h5>
                    </div>
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
                                            <td>{{$l->facilities_name}}</td>
                                            @if(auth()->user()->name == "police")

                                            @else
                                                <td>
                                                    <a href="{{route('facilites-delete',['id'=>$l->id])}}"
                                                       class="btn btn-primary">Delete</a>
                                                </td>
                                            @endif
                                        </tr>
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
                <form method="POST" action="{{route('facalities-save')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title">Add Facalities</h4>
                        </div>
                        <div class="modal-body">

                            @csrf
                            <label>Name:</label>
                            <input type="text" id="myName" class="form-control" required name="facalities">

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

    </script>
@endsection()
