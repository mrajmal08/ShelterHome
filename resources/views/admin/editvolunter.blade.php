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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit Volunter</h4>
                        <form method="post" action="{{route('volunter-update')}}">
                            @csrf
                            <div class="form-group row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$edit->name}}" required name="name" class="form-control"
                                           id="myName" placeholder="Enter Name">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$edit->id}}">
                            <div class="form-group row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Father Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$edit->f_name}}" required name="f_name"
                                           class="form-control" id="myFather">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Contact</label>
                                <div class="col-sm-9">
                                    <input type="text" required value="{{$edit->contact}}" name="contact"
                                           class="form-control" minlength="12" maxlength="12" >
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$edit->city}}" required name="city" class="form-control"
                                           id="myCity" placeholder="Enter City">
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" required value="{{$edit->email}}" name="email"
                                           class="form-control" id="horizontal-password-input">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                  <input type="password"  name="password" class="form-control" id="horizontal-password-input">
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

@endsection()
