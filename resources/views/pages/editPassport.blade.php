@extends('layouts.app', ['class' => '', 'elementActive' => 'customer'])

@section('content')


<div class="content">

    <div class="row">
    <div class="col-md-8"> 

        <div class="card">

        <div class="card-body">
        <form action="{{ route('passport.update', ['passportNo' => $passport->passportNo]) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="passportNo">Passport Number</label>
        <input type="text" class="form-control" id="passportNo" name="passportNo" value="{{ $passport->passportNo }}" required>
        @error('passportNo')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="expiryDate">Expiry Date</label>
        <input type="date" class="form-control" id="expiryDate" name="expiryDate" value="{{ $passport->expiryDate }}" required>
        @error('expiryDate')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="passportImage">Upload Passport Image</label>
        <div class="custom-file">
            <input type="file" class="form-control-file"  id="passportImage" name="passportImage" accept="image/*" onchange="displayImageName()">

            <label class="custom-file-label" for="passportImage">{{ $passport->passportImage }}</label>
            @error('passportImage')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <a href="{{ route('users.customers') }}" class="btn btn-secondary" style="float:right; ">Back</a>

</form>

           

        </div>
        </div>
    </div>
</div>
</div>
<script>
    function displayImageName() {
        var input = document.getElementById('passportImage');
var fileName = input.files[0].name;
var label = document.querySelector('.custom-file-label');
label.textContent = fileName;
} 
    </script>

@endsection