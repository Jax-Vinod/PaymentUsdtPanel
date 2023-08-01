<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * ['superadmin', 'admin']
     */
    const ROLE = ['superadmin', 'admin'];

    /**
     * [
     *   'superadmin' => 'Super Admin',
     *   'admin' => 'Admin',
     *   ];
     */
    const ROLE_LABEL = [
        'superadmin' => 'Super Admin',
        'admin' => 'Admin',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'password_crypt'
    ];

    protected $hidden = ['updated_at', ];

    public function roleLabel()
    {
        return self::ROLE_LABEL[$this->role];
    }

    public function routeNotificationFor()
    {

    }
}
