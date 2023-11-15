@extends('layouts.customers.app')

@section('content')
<div class="container" style="margin-top:8%">
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

        
           
        <form class="col-md-12" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Edit Profile') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Name') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                <label class="col-md-3 col-form-label">{{ __('Phone Number') }}</label>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phoneNo }}" required>
                    </div>
                    @if ($errors->has('phoneNo'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $errors->first('phoneNo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        
                <form class="col-md-12" action="{{ route('editPassword')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
