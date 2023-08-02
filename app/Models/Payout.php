<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'amount',
        'bank_id',
        'document'
    ];

    protected $hidden = ['updated_at'];

    public function bank()
    {
        return $this->hasOne('App\Models\Bank');
    }

    public function admin()
    {
        return $this->hasOne('App\Models\Admin');
    }
}
