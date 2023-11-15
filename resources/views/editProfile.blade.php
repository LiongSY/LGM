@extends('layouts.customers.app')

@section('content')

<div class="container mt-5" style="padding: 30px;">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <!-- Display success message if any -->
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Your edit profile form goes here -->
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('put') <!-- Use PUT method for updating -->

                        <!-- Add your form fields for editing profile information -->
                        <!-- For example: -->
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}">

                        <!-- Add other form fields as needed -->

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

@endsection
