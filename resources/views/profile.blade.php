@extends('layouts.customers.app')

@section('content')
<div class="container" style="margin-top:9%">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    @if (session('password_status'))
    <div class="alert alert-success" role="alert">
        {{ session('password_status') }}
    </div>
    @endif

    <div class="row">
        <!-- Edit Profile Form -->
        <div class="col-md-6">
        <form action="{{ route('customerProfile.update', ['id' => auth()->user()->userID]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title" style="color:blue;">{{ __('Edit Profile') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ auth()->user()->name }}" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phoneNo">{{ __('Phone Number') }}</label>
                            <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number"
                                value="{{ auth()->user()->phoneNo }}" required>
                            @error('phoneNo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nationality">{{ __('Nationality') }}</label>
                            <input type="text" name="nationality" class="form-control" placeholder="Nationality"
                                value="{{ auth()->user()->nationality }}">
                                @error('nationality')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="identityNo">{{ __('Identity Number') }}</label>
                            <input type="text" name="identityNo" class="form-control" placeholder="Identity Number"
                                value="{{ auth()->user()->identityNo }}">
                                @error('identityNo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">{{ __('Gender') }}</label>
                            <select name="gender" class="form-control">
                                <option value="default" {{ !auth()->user()->gender ? 'selected' : '' }} disabled>Select
                                    Gender</option>
                                <option value="Male" {{ auth()->user()->gender === 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ auth()->user()->gender === 'Female' ? 'selected' : ''
                                    }}>Female</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea name="address" class="form-control"
                                placeholder="Address">{{ auth()->user()->address }}</textarea>
                                @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Change Password Form -->
        <div class="col-md-6">
            <form action="{{ route('editPassword')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title" style="color:blue;">{{ __('Change Password') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="old_password">{{ __('Old Password') }}</label>
                            <input type="password" name="old_password" class="form-control" placeholder="Old password"
                                required>
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Password Confirmation') }}</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Password Confirmation" required>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    <div class="row mt-4" style="margin-bottom:15px">
        <div class="col-md-12 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>


@endsection