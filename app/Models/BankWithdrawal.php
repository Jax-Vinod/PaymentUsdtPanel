<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankWithdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'bank_id', 'amount', 'note'];

    protected $hidden = ['updated_at'];

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }
}
