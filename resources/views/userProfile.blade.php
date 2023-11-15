@extends('layouts.customers.app')

@section('content')

<div class="container mt-5" style="padding: 30px;">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg profile-card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="row z-depth-3">
                    <div class="col-sm-4 custom-bg-color rounded-left" style="background-color:#94c2e3;">
                        <div class="card-block text-center text-white">
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <h2 class="font-weight-bold mt-4">user name</h2>
                            <p>Customer/Admin</p>
                            <a href="{{ route('profile.edit') }}" class="text-white">Edit Profile</a>
                        </div>
                    </div>
                    <div class="col-sm-8 bg-white rounded-right">
                        <div class="text-center">
                           <h3 class="mt-3"><em> Profile Info </em></h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-9" style="margin-bottom: 5px;">
                                <p class="font-weight-bold" style="margin-bottom: 3px;">Email:</p>
                                <h6 class="text-muted" style="margin-bottom:3px;">pohlianchin0107@gmail.com</h6>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <p class="font-weight-bold" style="margin-bottom: 3px;">Phone:</p>
                                <h6 class="text-muted" style="margin-bottom: 3px;">017-7110309</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <p class="font-weight-bold" style="margin-bottom: 3px;">Gender:</p>
                                <h6 class="text-muted" style="margin-bottom: 3px;">female</h6>
                            </div>
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <p class="font-weight-bold" style="margin-bottom: 3px;">Nationality:</p>
                                <h6 class="text-muted" style="margin-bottom: 3px;">Malaysia</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="margin-bottom: 5px;">
                                <p class="font-weight-bold" style="margin-bottom: 3px;">Identity no:</p>
                                <h6 class="text-muted" style="margin-bottom: 3px;">020601-10-0654</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8" style="margin-bottom: 5px;">
                                <p class="font-weight-bold" style="margin-bottom: 3px;">Home Address:</p>
                                <h6 class="text-muted" style="margin-bottom: 3px;">No 6, Jalan Pelangi 3, Tmn Pelangi ,35900. Tanjung Malim. Perak</h6>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

@endsection
