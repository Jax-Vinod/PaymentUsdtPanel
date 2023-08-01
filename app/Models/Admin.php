<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    protected $hidden = ['updated_at', 'password', 'remember_token'];

    public function roleLabel()
    {
        return self::ROLE_LABEL[$this->role];
    }

    public function routeNotificationFor()
    {

    }
}
