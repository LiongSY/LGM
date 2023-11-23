<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'bookingID','bookingDate', 'noOfAdult', 'noOfChild', 'noOfInfant', 'noOfRoom', 'typesOfRoom', 
        'bookingAmount', 'bookingDeposit', 'bookingStatus', 'bookingRemarks', 'tourCode', 'customerID'
    ];}
