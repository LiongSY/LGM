@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'booking'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
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
                    <h4 style="float:left" class="card-title">Booking</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('booking.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search booking by Booking ID" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Booking ID</th>
                                <th>Booking Date</th>
                                <th>Booking Status</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->bookingID }}</td>
                                    <td>{{ $booking->bookingDate }}</td>
                                    <td>
                                        <form onsubmit="return validateForm()"
                                            action="{{ route('booking.updateStatus', $booking->bookingID) }}"
                                            method="POST" id="bookingForm_{{ $booking->bookingID }}">
                                            @csrf
                                            @method('PATCH')
                                            <select class="form-control" id="bookingStatus_{{ $booking->bookingID }}"
                                                name="bookingStatus"
                                                onchange="confirmStatusUpdate('{{ $booking->bookingID }}','{{ $booking->bookingStatus }}')">
                                                @foreach(['Room Pending', 'Pending Approval', 'Booking Approved', 'Booking Rejected', 'Completed'] as $statusOption)
                                                <option value="{{ $statusOption }}"
                                                    {{ $booking->bookingStatus === $statusOption ? 'selected' : '' }}>
                                                    {{ $statusOption }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="customMessage" name="customMessage" value=""/>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('booking.show', [$booking->bookingID]) }}"
                                            class="btn btn-info">View</a>
                                        <a href="{{ route('booking.edit', [$booking->bookingID]) }}"
                                            class="btn btn-warning">Edit</a>

                                        <form action="{{ route('booking.destroy', [$booking->bookingID]) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
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

<!-- Modal for entering rejected reason -->
<div class="modal fade" id="rejectedReasonModal" tabindex="-1" role="dialog" aria-labelledby="rejectedReasonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectedReasonModalLabel">Enter Rejected Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rejectedReasonForm">
                    <div class="form-group">
                        <label for="rejectedReason">Reason:</label>
                        <textarea class="form-control" id="rejectedReason" name="customMessage" rows="4"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitRejectedReason()">Submit Reason</button>
            </div>
        </div>
    </div>
</div>


<script>
var currentBookingID;
var originalBookingStatus;

function confirmStatusUpdate(bookingID, bookingStatus) {
    var selectedStatus = document.getElementById('bookingStatus_' + bookingID).value;

    if (selectedStatus === 'Booking Rejected') {
        currentBookingID = bookingID;
        originalBookingStatus = bookingStatus; 

        $('#rejectedReasonModal').modal('show');
        $('#rejectedReasonModal').on('hidden.bs.modal', function () {
            handleRejectedReasonModalClose();
        });
    } else {
        var confirmationMessage = "Are you sure you want to update the booking status to '" + selectedStatus + "'?";

        if (confirm(confirmationMessage)) {
            document.getElementById('bookingForm_' + bookingID).submit();
        } else {
            document.getElementById('bookingStatus_' + bookingID).value = bookingStatus;
        }
    }
}

function handleRejectedReasonModalClose() {
    var bookingID = currentBookingID;

    document.getElementById('bookingStatus_' + bookingID).value = originalBookingStatus;
}

function submitRejectedReason() {
    var rejectedReason = document.getElementById('rejectedReason').value;
    console.log('Rejected Reason:', rejectedReason);

    if (!rejectedReason.trim()) {
        alert('Please provide a rejected reason.'); 
    }

    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "customMessage");
    hiddenInput.setAttribute("value", rejectedReason);

    var bookingID = currentBookingID;
    console.log('Booking ID:', bookingID);

    var additionalConfirmationMessage = "Are you sure you want to submit the rejected reason and update the booking status?";
    if (confirm(additionalConfirmationMessage)) {
        var form = document.getElementById('bookingForm_' + currentBookingID);
    form.appendChild(hiddenInput);

    form.submit();
    } else {

    }

       $('#rejectedReasonModal').modal('hide');




}

</script>

@endsection
