@extends('layouts.customers.app')

@section('content')


<h1>Compare Packages</h1>

<!-- Display details of selected packages here -->
<div>
    <h2>Package 1</h2>
    <ul>
        <li>Package Name: {{ $package1Details->packageName }}</li>
        <li>Destination: {{ $package1Details->destination }}</li>
        <li>Highlight: {{ $package1Details->highlight }}</li>
        <!-- Add more details based on your package structure -->
    </ul>
</div>

<div>
    <h2>Package 2</h2>
    <ul>
        <li>Package Name: {{ $package2Details->packageName }}</li>
        <li>Destination: {{ $package2Details->destination }}</li>
        <li>Highlight: {{ $package2Details->highlight }}</li>
        <!-- Add more details based on your package structure -->
    </ul>
</div>
@endsection
