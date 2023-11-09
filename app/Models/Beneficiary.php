<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $table = 'beneficiary';

    protected $fillable = [
        'benID', 'benTitle', 'benName', 'benIC', 'benRelationship', 'benContact', 'benAddress', 'customerID'
    ];}
