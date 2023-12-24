@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Chats</p>
                                    <p class="card-title">{{$unreadCount}}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats" onclick="refreshPage()">
                            <i class="fa fa-refresh" ></i> Refresh
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-3 col-md-2">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-money-coins text-success"></i>
                                </div>
                            </div>
                            <div class="col-9 col-md-10">
                                <div class="numbers">
                                    @php
                                    use Carbon\Carbon;

                                    $currentMonth = Carbon::now()->format('F');
                                    @endphp
                                    
                                    <p class="card-category">Completed Revenue</p>
                                    <p class="card-title">RM {{ number_format($totalBookingAmount, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i>Month: {{$currentMonth}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Reports</p>
                                    <p class="card-title">23
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> View Reports
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-3 col-md-2">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-favourite-28 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-9 col-md-10">
                                <div class="numbers">
                                    <p class="card-category">Registered Customers</p>
                                    <p class="card-title">{{$customersCount}}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> View Customers
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Customer chat</h5>
                        <p class="card-category">Live chat</p>
                    </div>
                    <div class="card-body ">
                    <div class="table-responsive">
        <table class="table">
        <thead class=" text-primary">
        <th>
            Customer Name            
        </th>
        <th>
            Message
            </th>
        <th>
            Action
        </th>
            </thead>
            <tbody>
            @foreach($customerList as $customer)
    <tr>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->email }}</td>
        <td>

        @php

        $conversation = App\Models\Conversation::where('userID', $customer->userID)->first();

        @endphp

        @if($conversation->messageStatus == 1)
        <a href="{{ route('chat.show', $customer->userID) }}" class="btn btn-danger">REPLY</a>
            @else
            <a href="{{ route('chat.show', $customer->userID) }}" class="btn btn-info">REPLIED</a>
            @endif

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

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.initChartsPages();
        });

        function refreshPage() {
        location.reload(true);
    }
    </script>
@endpush