@extends('layouts.app', [
'class' => '',
'elementActive' => 'booking'
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
                    <td>    

                    <form onsubmit="return validateForm()" action="{{ route('booking.updateStatus', $booking->bookingID) }}" method="POST" id="bookingForm_{{ $booking->bookingID }}">
    @csrf
    @method('PATCH')
        <select class="form-control" id="bookingStatus_{{ $booking->bookingID }}" name="bookingStatus" onchange="confirmStatusUpdate('{{ $booking->bookingID }}','{{ $booking->bookingStatus }}')">
            @foreach(['Room Pending', 'Pending Approval', 'Booking Approved', 'Booking Rejected', 'Completed'] as $statusOption)
                <option value="{{ $statusOption }}" {{ $booking->bookingStatus === $statusOption ? 'selected' : '' }}>{{ $statusOption }}</option>
            @endforeach
        </select>
</form>
                   </td>
                    <td>
                        <a href="{{ route('booking.show', [$booking->bookingID]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('booking.edit', [$booking->bookingID]) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('booking.destroy', [$booking->bookingID]) }}" method="POST" style="display:inline;">
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
          

            <div>
            
</div>
    </div>
</div>
</div>
</div>
</div>
</div>


<script>
    function confirmStatusUpdate(bookingID,bookingStatus) {
        var selectedStatus = document.getElementById('bookingStatus_' + bookingID).value;
        var confirmationMessage = "Are you sure you want to update the booking status to '" + selectedStatus + "'?";

        if (confirm(confirmationMessage)) {
            // If the user confirms, submit the form directly
            document.getElementById('bookingForm_' + bookingID).submit();
        } else {
            document.getElementById('bookingStatus_' + bookingID).value = bookingStatus ;

        }
    }
</script>

@endsection