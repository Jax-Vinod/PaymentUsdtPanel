<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsdtPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'amount',
        'bank_id',
        'dest_bank_detail',
        'document',
        'status'
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
