
@extends('layouts.app')

@section('content')
    <h1>Search Packages</h1>

    <form action="{{ route('compare-packages') }}" method="post">
        @csrf
        <label for="destination">Destination:</label>
        <input type="text" name="destination" id="destination" required>

        <!-- Display search results here -->
        @if(isset($searchResults) && count($searchResults) > 0)
            <h2>Search Results:</h2>
            <ul>
                @foreach($searchResults as $package)
                    <li>
                        <label>
                            <input type="checkbox" name="selectedPackages[]" value="{{ $package->id }}">
                            {{ $package->name }} - {{ $package->destination }}
                        </label>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No packages found for the given destination.</p>
        @endif

        <button type="submit">Compare</button>
    </form>
@endsection
