<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'trader_id',
        'amount',
        'bank_id'
    ];

    protected $hidden = ['updated_at'];

    public function bank()
    {
        return $this->hasOne('App\Models\Bank');
    }

    public function trader()
    {
        return $this->hasOne('App\Models\Trader');
    }
}
