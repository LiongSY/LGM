@extends('layouts.customers.app')

@section('content')
    <style>
        body {
             background-image: url("{{ asset('paper/img/bg/kl.jpg') }}");
            background-size: cover; 
            color: black; 
        }

        .btn-primary {
            background-color: #03045e; 
            color: #ffffff; 
            border: 2px solid #03045e;
            border-radius: 5px;
            transition: background-color 0.3s, border 0.3s, transform 0.3s;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent white overlay */
        }


        .btn-primary:hover {
            background-color: #0056b3;
            border: 2px solid #0056b3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Button active effect */
        .btn-primary:active {
            background-color: #003366; /* Darker shade on click */
            border: 2px solid #003366;
            box-shadow: none; /* Remove box shadow on click */
            transform: translateY(0);
        }

        .center-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease;
        }

        .form-container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .day-card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            cursor: pointer;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .tooltip-inner {
            max-width: 300px;
        }

        /* Custom animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


    <div class="center-container">
        <div class="form-container">
            <h2 class="mb-4 text-center">Generate Itinerary</h2>

            <form action="{{ route('generateItineraryAI') }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" name="country" placeholder="Country to go?" required>
                        @if(session('error'))
                            <div style="color: red;">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <input type="number" class="form-control" placeholder="How many day(s)?" name="days" min="1" required>
                        @error('days')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Generate Itinerary</button>
            </form>
        </div>
    </div>

@endsection
