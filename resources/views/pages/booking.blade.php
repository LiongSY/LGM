@extends('layouts.app', [
'class' => '',
'elementActive' => 'tables'
])

@section('content')
<div class="content"> <div class="row"> <div class="col-md-12">
    <div class="card">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="card-header">
    <h4 style="float:left"class="card-title">Booking</h4>
    
    <a href="{{ route('booking.create') }}" class="btn btn-primary" style="float:right">Create</a>
    </div>
    <div class="card-body">
    <form action="{{ route('booking.index') }}" method="GET" class="mb-3">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search booking" name="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    <div class="table-responsive">
        <table class="table">
        <thead class=" text-primary">
        <th>
            Booking ID
            </th>
            <th>
            Booking Date
            </th>
        <th>
            Booking Status
            </th>

        <th>
            Actions
            </th>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->bookingID }}</td>
                    <td>{{ $booking->bookingDate }}</td>
                    <td>{{ $booking->bookingStatus }}</td>
                    <td>
                        <a href="{{ route('booking.show', [$booking->bookingID]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('booking.edit', [$booking->bookingID]) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('booking.destroy', [$booking->bookingID]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
                        </form>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
    </div>
</div>
</div>
</div>
</div>
</div>

@endsection