@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="text-align: center;    font-size: 21px;">Shelter Request List </h5>
                    </div>
                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="datatable_length">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6"></div>
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

                        <form action="{{route('admin-shelter-list')}}" method="get" role="search"
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
                                            colspan="1" style="width: 115px;"
                                            aria-label="Office: activate to sort column ascending">Father Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 52px;"
                                            aria-label="Age: activate to sort column ascending">Contact
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 105px;"
                                            aria-label="Start date: activate to sort column ascending">CNIC
                                        </th>

                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 82px;"
                                            aria-label="Salary: activate to sort column ascending">City
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 41px;"
                                                aria-label="Position: activate to sort column ascending">Image
                                            </th>
                                            @if(auth()->user()->name == 'admin')
                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 241px;"
                                                aria-label="Position: activate to sort column ascending">Scan Qr
                                            </th>
                              @endif
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 82px;"
                                            aria-label="Salary: activate to sort column ascending">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1
                                    @endphp
                                    @foreach($list as $m)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$m->name}}</td>
                                            <td>{{$m->f_name}}</td>
                                            <td>{{$m->contact}}</td>
                                            <td>{{$m->cnic}}</td>
                                            <td>{{$m->city}}</td>
                                            <td>
                                                <img src="{{ asset('images')."/".$m->image }}" style="width: 50px;height: 50px;" />
                                                </td>
                                                
                                                @if(auth()->user()->name == 'admin')

                                                <td>
                                                    
                                                    {!! QrCode::size(100)->generate(
    "Name: ".$m->name."\n"."Father Name: ".$m->f_name."\n"."Contact: ".$m->contact."\n"."CNIC: ".$m->cnic."\n"."City:".$m->city."\n"."Image: ". asset('images')."/".$m->image

) !!}
                                                </td>
                                                @endif
                                            <td>

                                                
                                                <a href="{{route('allote-shelter',['id'=>$m->id])}}"
                                                   class="btn btn-primary">Open</a>
                                                  @if(auth()->user()->name == "police")

                                                    @else
                                                    <a href="{{route('delete-shelter-request',['id'=>$m->id])}}"
                                                       class="btn btn-danger">Delete</a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach()
                                    </tbody>
                                </table>
                                {{$list->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
