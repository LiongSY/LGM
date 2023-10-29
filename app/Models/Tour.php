<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{

     public function package()
     {
         return $this->belongsTo(Package::class,'packageID',);
     }

     public function flight() {
          return $this->belongsTo(Flight::class);
      }
    protected $fillable = [
        'tourCode', 'tourLanguages', 'tourPrice', 'tourStatus', 'noOfSeats', 'packageID','flightID'
    ];}
