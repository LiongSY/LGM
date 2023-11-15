@extends('layouts.app', ['class' => '', 'elementActive' => 'map'])

@section('content')


<div class="content">

    <div class="row">
    <div class="col-md-8"> 

        <div class="card">

        <div class="card-body">
        
        <form action="{{ route('beneficiary.update', ['benID' => $beneficiary->benID]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="benTitle">Title</label>
        <select class="form-control" id="benTitle" name="benTitle" >
            <option value="">Select Title</option>
            <option value="Mr." {{ old('benTitle', $beneficiary->benTitle) == 'Mr.' ? 'selected' : '' }}>Mr.</option>
            <option value="Mrs." {{ old('benTitle', $beneficiary->benTitle) == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
            <option value="Miss" {{ old('benTitle', $beneficiary->benTitle) == 'Miss' ? 'selected' : '' }}>Miss</option>
            <option value="Ms." {{ old('benTitle', $beneficiary->benTitle) == 'Ms.' ? 'selected' : '' }}>Ms.</option>
            <option value="Mx." {{ old('benTitle', $beneficiary->benTitle) == 'Mx.' ? 'selected' : '' }}>Mx.</option>
        </select>
        @error('benTitle')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="benName">Name</label>
        <input type="text" class="form-control" id="benName" name="benName" value="{{ old('benName', $beneficiary->benName) }}" >
        @error('benName')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="benIC">IC Number</label>
        <input type="text" class="form-control" id="benIC" name="benIC" value="{{ old('benIC', $beneficiary->benIC) }}" >
        @error('benIC')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="benRelationship">Relationship</label>
        <input type="text" class="form-control" id="benRelationship" name="benRelationship" value="{{ old('benRelationship', $beneficiary->benRelationship) }}" >
        @error('benRelationship')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="benContact">Contact Number</label>
        <input type="text" class="form-control" id="benContact" name="benContact" value="{{ old('benContact', $beneficiary->benContact) }}" >
        @error('benContact')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="benAddress">Address</label>
        <textarea class="form-control" id="benAddress" name="benAddress" rows="3" >{{ old('benAddress', $beneficiary->benAddress) }}</textarea>
        @error('benAddress')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Beneficiary</button>
</form>


        </div>
        </div>
    </div>
</div>
</div>


@endsection