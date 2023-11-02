@extends('layouts.app', [
'class' => '',
'elementActive' => 'tables'
])

@section('content')
<div class="content"> <div class="row"> <div class="col-md-12">
    <div class="card">
    <div class="card-header">
    <h4 style="float:left"class="card-title">Packages</h4>
    
    <a href="{{ route('packages.create') }}" class="btn btn-primary" style="float:right">Create</a>
    </div>
    <div class="card-body">
    <form action="{{ route('packages.index') }}" method="GET" class="mb-3">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search events" name="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </form>
    <div class="table-responsive">
        <table class="table">
        <thead class=" text-primary">
        <th>
            Package Code
            </th>
        <th>
            Package Name
            </th>
        <th>
            Country
        </th>
        <th>
            Actions
            </th>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->packageID }}</td>
                    <td>{{ $package->packageName }}</td>
                    <td>{{ $package->destination }}</td>
                    <td>
                        <a href="{{ route('packages.edit', [$package->packageID]) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('packages.show', [$package->packageID]) }}" class="btn btn-info">View</a>
                        <form action="{{ route('packages.destroy', [$package->packageID]) }}" method="POST"
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