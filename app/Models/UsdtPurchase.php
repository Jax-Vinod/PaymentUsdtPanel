<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsdtPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'agent_id',
        'amount',
        'bank_id',
        'dest_bank_detail',
        'document',
        'txn_hash',
        'wallet_address',
        'status',
        'order_no',
        'step'
    ];

    protected $hidden = ['updated_at'];

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\User');
    }
}
