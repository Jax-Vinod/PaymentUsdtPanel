<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chargeback extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'trader_id', 'amount'];

    protected $hidden = ['updated_at'];

    public function trader()
    {
        return $this->belongsTo('App\Models\Trader');
    }
}
