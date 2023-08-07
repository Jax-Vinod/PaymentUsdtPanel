<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'name',
        'email',
        'phone',
        'upi',
        'note',
        'sum',
        'is_active'
    ];

    protected $hidden = ['updated_at'];

    public function agent()
    {
        return $this->belongsTo('\App\Models\User', 'agent_id', 'id');
    }
}
