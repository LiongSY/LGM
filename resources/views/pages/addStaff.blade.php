@extends('layouts.app', ['class' => '', 'elementActive' => 'staff'])

@section('content')

<div class="content"> <div class="row">
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
            <form method="POST" action="{{ route('admin.store') }}">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" >
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="phoneNo">Phone Number (number only)</label>
        <input type="tel" class="form-control @error('phoneNo') is-invalid @enderror" placeholder="01xxxxxxxxx" id="phoneNo" name="phoneNo" value="{{ old('phoneNo') }}" >
        @error('phoneNo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Password Input -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Confirm Password Input -->
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" >
        @error('confirm_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Identity Number Input -->
    <div class="form-group">
        <label for="identityNo">Identity Number</label>
        <input type="text" class="form-control @error('identityNo') is-invalid @enderror" placeholder="xxxxxx-xx-xxxx" id="identityNo" name="identityNo" value="{{ old('identityNo') }}" >
        @error('identityNo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Address Input -->
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" >
        @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
                <label for="gender">Gendar:</label>
                <select class="form-control" id="gender" name="gender" >
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

    <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role" >
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

            </div>
        </div>
    </div>
</div>
</div>




@endsection