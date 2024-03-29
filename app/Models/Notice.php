<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'trader_id',
        'document'
    ];

    protected $hidden = ['updated_at'];

    public function trader()
    {
        return $this->belongsTo('App\Models\Trader');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User');
    }
}
