@extends('layouts.app', [
'class' => '',
'elementActive' => 'staff'
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
    <h4 style="float:left"class="card-title">Staff</h4>
    
    <a href="{{ route('admin.addStaff') }}" class="btn btn-primary" style="float:right">Add Staff</a>
    </div>
    <div class="card-body">
    <form action="{{ route('users.index') }}" method="GET" class="mb-3">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search staff by name or email" name="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    <div class="table-responsive">
        <table class="table">
        <thead class=" text-primary">
        <th>
            Name
            </th>
        <th>
            Contact
            </th>
        <th>
            Status
        </th>
        <th>
            Actions
            </th>
            </thead>
            <tbody>
                @foreach ($users as $staff)
                <tr>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->phoneNo }}</td>
                    <td>{{ $staff->status }}</td>
                    <td>
                    <a href="mailto:{{ $staff->email }}" class="btn btn-warning">Email</a>
                    <form action="{{ route('staff.destroy', ['id' => $staff->staffID]) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff?')">Delete</button>
</form>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewStaffModal{{ $staff->staffID }}">
    View Details
</button>
                    </td>
                </tr>
                <div class="modal fade" id="viewStaffModal{{ $staff->staffID }}" tabindex="-1" role="dialog" aria-labelledby="viewStaffModalLabel{{ $staff->staffID }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStaffModalLabel{{ $staff->staffID }}">Staff Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Name: {{ $staff->name }}</p>
                    <p>Phone: {{ $staff->phoneNo }}</p>
                    <p>Gender: {{ $staff->gender }}</p>
                    <p>IC No: {{ $staff->identityNo }}</p>
                    <p>Address: {{ $staff->address }}</p>
                    <p>Role: {{ $staff->role }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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