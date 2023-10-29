<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'bookingDate', 'noOfAdult', 'noOfChild', 'noOfInfant', 'noOfRoom', 'typesOfRoom', 'additionalDays', 'additionalActivities',
        'bookingAmount', 'bookingDeposit', 'bookingStatus', 'bookingRemarks', 'tourCode', 'customerID'
    ];}
