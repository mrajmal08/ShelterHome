@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('facilities-list')}}" class="btn btn-primary" style="    margin: 120px;
    padding: 40px;">Facilities</a>
                            <a href="{{route('trusties-list')}}" class="btn btn-primary" style="    margin: 120px;
    padding: 40px;">Trusties </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
