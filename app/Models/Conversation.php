<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    protected $table = 'conversation';

    protected $fillable = ['userID','messageStatus'];
}
