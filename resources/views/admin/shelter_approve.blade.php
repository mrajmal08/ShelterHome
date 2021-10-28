@extends('newtemplates.partials.default')
@section('content')
    <div id="layout-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 style="text-align: center;font-size: 20px;">Shelter Request</h5>
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
                        <form method="post" action="{{route('approve-shelter-save')}}">
                            @csrf
                            <div class="container" style="margin-top: 2rem;">
                                <div class="row" style="margin: 0px;">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <h5 style="margin-bottom: 20px;">Personal Information:</h5>
                                        </div>
                                        <div class="row" style="margin: 0px;">
                                            <div class="col-lg-4">
                                                <h5>Name:</h5>
                                            </div>
                                            <div class="col-lg-8">
                                                <h5>{{$shelter->name}}</h5>
                                            </div>
                                            <input type="hidden" name="id" value="{{$shelter->id}}">
                                        </div>
                                        <div class="row" style="margin: 0px;">
                                            <div class="col-lg-4">
                                                <h5>Father Name:</h5>
                                            </div>

                                            <div class="col-lg-8">
                                                <h5>{{$shelter->f_name}}</h5>
                                            </div>
                                        </div>
                                        <div class="row" style="margin: 0px;">
                                            <div class="col-lg-4">
                                                <h5>CNIC:</h5>
                                            </div>

                                            <div class="col-lg-8">
                                                <h5>{{$shelter->cnic}}</h5>
                                            </div>
                                        </div>
                                        <div class="row" style="margin: 0px;">
                                            <div class="col-lg-4">
                                                <h5>Contact:</h5>
                                            </div>

                                            <div class="col-lg-8">
                                                <h5>{{$shelter->contact}}</h5>
                                            </div>

                                        </div>
                                        <div class="row" style="margin: 0px;">
                                            <div class="col-lg-4">
                                                <h5>City:</h5>
                                            </div>

                                            <div class="col-lg-8">
                                                <h5>{{$shelter->city}}</h5>
                                            </div>
                                        </div>

                                        <div class="row" style="margin: 0px;">
                                            <div class="col-lg-4">
                                                <h5>Shelter Homes:</h5>
                                            </div>
                                            <div class="col-lg-8">
                                                <select name="home_id" required class="form-control">
                                                      <option value="{{NULL}}">Choose:</option>

                                                    @foreach($shelter_rooms as $room)
                                                        <option value="{{$room->id}}"<?php if(isset($selectedHome) && $selectedHome->home_id==$room->id) echo "selected"; ?> >{{$room->name}}</option>
                                                    @endforeach()

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <h5>Facilities:</h5>
                                        </div>
                                        @foreach($facalities as $f)

                                            <div class="row" style="margin: 0px;">
                                                <div class="col-lg-4">

                                                    @if(in_array($f->id,$user_slected_facilities))
                                                        @php $checked = 'checked'; @endphp
                                                    @else
                                                        @php $checked = ''; @endphp
                                                    @endif

                                                    <input type="checkbox" value="{{$f->id}}" name="facilities[]"
                                                           {{$checked}} style="width: 20%;" class="form-control">
                                                </div>

                                                <div class="col-lg-8">
                                                    <h5>{{$f->facilities_name}}</h5>
                                                </div>
                                            </div>
                                        @endforeach()

                                        @if(auth()->user()->name == "police")

                                        @else
                                        <div class="col-lg-12">
                                            <button type="submit" style="    margin: 40px;
    padding: 10px;
    font-size: 15px;" class="btn btn-primary">Provide Shelter
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
@endsection()
