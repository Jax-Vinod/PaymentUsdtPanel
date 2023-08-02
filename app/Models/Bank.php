<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_name',
        'bank_name',
    ];

    protected $hidden = ['updated_at'];
}
