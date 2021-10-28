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
                        <h4 class="card-title mb-4">Add Missing Person</h4>
                        <form method="post" action="{{route('add-missing-save')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-4">
                                <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="name" class="form-control"
                                           id="myName" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Father Name</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="f_name" class="form-control"
                                           id="myFather" placeholder="Enter Father Name">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Contact</label>
                                <div class="col-sm-9">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+92</div>
                                        <input type="text" class="form-control" minlength="10" maxlength="10" name="contact" id="myContact" required placeholder="3044300000">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">CNIC</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="cnic" class="form-control"
                                           id="cnic" maxlength='15'
                                           placeholder="34603-4598652-3">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="city" class="form-control"
                                           id="myCity" placeholder="Enter City">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" required name="image" class="form-control"
                                           id="">
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
