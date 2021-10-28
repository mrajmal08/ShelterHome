@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="text-align: center;    font-size: 21px;">Password Re Generate Requests</h5>
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
                                            aria-label="Position: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1"
                                            colspan="1" style="width: 82px;"
                                            aria-label="Salary: activate to sort column ascending">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1
                                    @endphp
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$request->email}}</td>
                                            @if(auth()->user()->name == "police")

                                            @else
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id{{ $request->id }}">
                                                        Generate New Password
                                                    </button>
                                                    <a class="btn btn-danger"
                                                       href="{{route('pass-request-delete',['id'=>$request->id])}}">Delete Request</a>
                                                </td>
                                            @endif
                                        </tr>

                                        <div class="modal fade" id="id{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">

                                                <form method="post" action="{{ route('generate-password') }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Write New Password Of This User</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="hidden" name="email" value="{{ $request->email }}">
                                                                <label>Your Email</label>
                                                                <input type="text" name="email" id="user" tabindex="1" class="form-control" disabled
                                                                       placeholder="Enter Email" value="{{ $request->email }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Write New Passwordl</label>
                                                                <input type="password" name="password" id="user" tabindex="1" class="form-control"
                                                                       placeholder="Write New Password">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">❌</button>
                                                            <button type="submit" class="btn btn-primary">Send</button>
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
    </div>


@endsection()
