<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $fillable = [
       'passportNo', 'expiryDate', 'passportImage','customerID'
    ];}
