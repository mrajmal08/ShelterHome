@extends('newtemplates.partials.default')
@section('content')
<div id="layout-wrapper">





    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <div class="card-header">
                    <h5 style="text-align: center;    font-size: 21px;">Homeless</h5>
                </div>




                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="datatable_length">
                        </div></div><div class="col-sm-12 col-md-6"></div></div>
                        <div class="row"><div class="col-sm-12"><table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 158px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Sr.</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 241px;" aria-label="Position: activate to sort column ascending">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 115px;" aria-label="Office: activate to sort column ascending">Father Name</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 52px;" aria-label="Age: activate to sort column ascending">CNIC</th>

                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 82px;" aria-label="Salary: activate to sort column ascending">Contact</th>


                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 241px;" aria-label="Position: activate to sort column ascending">Room</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 82px;" aria-label="Salary: activate to sort column ascending">City</th>


                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 82px;" aria-label="Salary: activate to sort column ascending">Facilities</th>
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
                                <td>{{$l->cnic}}</td>
                                <td>{{$l->contact}}</td>
                                <td>{{$l->user_facility->room->name}}</td>
                                <td>{{$l->city}}</td>
                                <td>{{$l->user_facilities->facility_id}}</td>
                            </tr>
                            @endforeach()



                        </tbody>
                    </table>

                </div>
            </div>
                </div>

            </div>
        </div>
        </div> <!-- end col -->
    </div>






</div>
@endsection()
