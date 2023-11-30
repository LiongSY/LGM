@extends('layouts.app', ['class' => '', 'elementActive' => 'package'])

@section('content')

<div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>

                        <!-- Form for Packages Management -->
                        <form action="{{ route('package.updatePackage', $package->packageID) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div> 
                                <a href="{{ URL::previous() }}" class="btn btn-secondary"
                                    style="float:right; top:0px">Back
                                </a>

                                <div class="card-header" style="padding-left:0px"> <b>Update Package<b>

                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="packageName">Package Name:</label>
                                        <input type="text" class="form-control" id="packageName"
                                            value="{{ $package->packageName }}" name="packageName" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="destination">Country:</label>
                                        <input type="text" class="form-control " id="destination"
                                            value="{{ $package->destination }}" name="destination" required>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="packageHighlight">Highlight of the Package:</label>
                                    <textarea class="form-control long-textarea" id="packageHighlight"
                                        name="packageHighlight" required>{{ $package->highlight }}</textarea>
                                </div>
                                <div class="form-group">
        <label for="packageImage">Upload Package Image</label>
        <div class="custom-file">
            <input type="file" class="form-control-file"  id="packageImage" name="packageImage" accept="image/*" onchange="displayImageName()">

            <label class="custom-file-label" for="packageImage">{{ $package->packageImage }}</label>
            @error('packageImage')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
    </div>
                                @error('packageImage')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="singleRoom">Single Room Price:</label>
                                        <input type="number" class="form-control" id="singleRoom"
                                            value="{{ $package->singleRoom }}" name="singleRoom" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="doubleRoom">Double Room Price:</label>
                                        <input type="number" class="form-control" id="doubleRoom"
                                            value="{{ $package->doubleRoom }}" name="doubleRoom" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="tripleRoom">Triple Room Price:</label>
                                        <input type="number" class="form-control" id="tripleRoom"
                                            value="{{ $package->tripleRoom }}" name="tripleRoom" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="remarks">Remarks for the Package:</label>
                                    <textarea class="form-control long-textarea" id="packageRemarks"
                                        name="packageRemarks" required>{{$package->remarks}}</textarea>
                                </div>


                                <button type="submit" class="btn btn-primary">Update </button>
                            </div>
                        </form>
                    </div>
                 </div>
             </div>
        </div>
</div>



        <script>
            function displayImageName() {
                var input = document.getElementById('packageImage');
                var fileName = input.files[0].name;
                var label = document.querySelector('.custom-file-label');
                label.textContent = fileName;
            }

        </script>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

        @endsection