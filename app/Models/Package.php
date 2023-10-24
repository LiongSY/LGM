<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $primaryKey = 'packageID';
    protected $fillable = [
        'packageName','highlight', 'itineraryPdf', 'remarks', 'destination', 'costing', 'itineraryID', 'tourCode'
    ];}
