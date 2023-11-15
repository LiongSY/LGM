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
    <h4 style="float:left"class="card-title">Customers</h4>
    
    <!-- <a href="{{ route('admin.addStaff') }}" class="btn btn-primary" style="float:right">Add Staff</a> -->
    </div>
    <div class="card-body">
    <form action="{{ route('users.customers') }}" method="GET" class="mb-3">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search customers" name="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    <div class="table-responsive">
        <table class="table">
        <thead class=" text-primary">
        <th>
            Title
            </th>
        <th>
            Customer Name
            </th>
        <th>
            Identity NO
        </th>
        <th>
            Email
        </th>
        <th>
            Actions
            </th>
            </thead>
            <tbody>
                @foreach ($users as $customer)
                <tr>
                <td>{{ $customer->titles }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->identityNo }}</td>
                    <td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
                    <td>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#viewStaffModal{{ $customer->customerID }}">View</a>
                    @if($customer->passportNo)
                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#viewPassportModal{{ $customer->passportNo }}">View Passport</a>
                    @else
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addPassportModal{{ $customer->customerID }}">Add Passport</a>
                    @endif
                    @if($customer->benID)
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#viewBenModal{{ $customer->benID }}">View Beneficiary</a>
                    @else
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#addBenModal{{ $customer->customerID }}">Add Beneficiary</a>
                    @endif
                    </td>
                </tr>
                <div class="modal fade" id="viewStaffModal{{ $customer->customerID }}" tabindex="-1" role="dialog" aria-labelledby="viewStaffModalLabel{{ $customer->customerID }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStaffModalLabel{{ $customer->customerID }}">Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Name:</b> {{ $customer->name }}</p>
                    <p><b>Phone:</b> {{ $customer->phoneNo }}</p>
                    <p><b>Gender:</b> {{ $customer->gender }}</p>
                    <p><b>Nationality:</b> {{ $customer->nationality }}</p>
                    <p><b>Remarks:</b> {{ $customer->remarks }}</p>
                    <p><b>Address:</b> {{ $customer->address }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if($customer->passportNo)

    <!-- view passport modal -->
    <div class="modal fade" id="viewPassportModal{{ $customer->passportNo }}" tabindex="-1" role="dialog" aria-labelledby="viewPassportModalLabel{{ $customer->passportNo }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPassportModal{{ $customer->passportNo }}">Passport Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>PassportNo:</b> {{ $customer->passportNo }}</p>
                    <p><b>Passport Expiry Date:</b> {{ $customer->expiryDate }}</p>
                    <b>Passport Image:</b> 
                    <br>
                    <img src="{{ url('storage/images/'.$customer->passportImage) }}" width='100%' height='300' />

                </div>
                <div class="modal-footer">
                <a href="{{ route('passport.edit', ['passportNo' => $customer->passportNo]) }}" class="btn btn-warning">Edit Passport</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
                    </div>
@endif
@if($customer->benID)

<!-- view beneficiary modal -->
<div class="modal fade" id="viewBenModal{{ $customer->benID }}" tabindex="-1" role="dialog" aria-labelledby="viewPassportModalLabel{{ $customer->benID }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewBenModal{{ $customer->benID }}">Beneficiary Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Name:</b> {{ $customer->benName }}</p>
                    <p><b>Phone:</b> {{ $customer->benContact }}</p>
                    <p><b>Relationship:</b> {{ $customer->benRelationship }}</p>
                    <p><b>IC no:</b> {{ $customer->benIC }}</p>
                    <p><b>Address:</b> {{ $customer->benAddress }}</p>

                </div>
                <div class="modal-footer">
                <a href="{{ route('beneficiary.edit', ['benID' => $customer->benID]) }}" class="btn btn-warning">Edit Beneficiary</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
                    </div>

                    @endif

                    <div class="modal fade" id="addPassportModal{{ $customer->customerID }}" tabindex="-1" role="dialog" aria-labelledby="addPassportModalLabel{{ $customer->customerID }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPassportModal{{ $customer->customerID }}">Add Passport Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!-- <div id="errorMessages{{ $customer->customerID }}" class="alert alert-danger" style="display: none;"></div> -->

            <form action="{{ route('passport.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="customerID" value="{{ $customer->customerID }}">
                    <div class="form-group">
                        <label for="passportNo">Passport Number</label>
                        <input type="text" class="form-control" id="passportNo" name="passportNo" >
                    </div>
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="date" class="form-control" id="expiryDate" name="expiryDate" >
                    </div>
                    <div class="form-group">
                    <label for="expiryDate">Upload Passport Image</label>
                    <div class="custom-file">
                    <input type="file" class="form-control-file" id="passportImage" name="passportImage" accept="image/*" onchange="displayImageName(this)">
                                <label class="custom-file-label" for="passportImage">Choose file</label>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Passport</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addBenModal{{ $customer->customerID }}" tabindex="-1" role="dialog" aria-labelledby="addBenModalLabel{{ $customer->customerID }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBenModalLabel{{ $customer->customerID }}">Add Beneficiary Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="benErrorMessages" class="alert alert-danger" style="display: none;"></div>

                <form onsubmit="return validateBeneficiary()" action="{{ route('beneficiary.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="customerID" value="{{ $customer->customerID }}">
                    <div class="form-group">
    <label for="title">Title</label>
    <select class="form-control" id="benTitle" name="benTitle" required>
        <option value="">Select Title</option>
        <option value="Mr.">Mr.</option>
        <option value="Mrs.">Mrs.</option>
        <option value="Miss">Miss</option>
        <option value="Ms.">Ms.</option>
        <option value="Mx.">Mx.</option>
    </select>
</div>
                    <div class="form-group">
                        <label for="benName">Name</label>
                        <input type="text" class="form-control" id="benName" name="benName" >
                    </div>
                    <div class="form-group">
                        <label for="benIC">IC Number</label>
                        <input type="text" class="form-control" id="benIC" name="benIC" >
                    </div>
                    <div class="form-group">
                        <label for="benRelationship">Relationship</label>
                        <input type="text" class="form-control" id="benRelationship" name="benRelationship" >
                    </div>
                    <div class="form-group">
                        <label for="benContact">Contact Number</label>
                        <input type="text" class="form-control" id="benContact" name="benContact" >
                    </div>
                    <div class="form-group">
                        <label for="benAddress">Address</label>
                        <textarea class="form-control" id="benAddress" name="benAddress" rows="3" ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Beneficiary</button>
                </form>
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
<script>
function displayImageName(input) {
    var fileName = input.files[0].name;
    var label = input.closest('.custom-file').querySelector('.custom-file-label');
    label.textContent = fileName;
} 



</script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
@endsection





