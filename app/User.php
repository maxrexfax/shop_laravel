<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN_NAME = 'admin';

    public const VALIDATION_RULES = [
        'login' => ['required', 'max:255'],
        'first_name' => ['nullable', 'max:255'],
        'second_name' => ['nullable', 'max:255'],
        'last_name' => ['nullable', 'max:255'],
        'telephone' => ['nullable', 'max:255'],
        'email' => ['string', 'max:255', 'required'],
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'first_name', 'second_name', 'last_name', 'email', 'password', 'telephone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function getRoles()
    {
        if(!empty($this->roles)) {
            return $this->roles;
        }

        return [];
    }

    public function isAdmin()
    {
        foreach (self::getRoles() as $role) {
            if($role->role_name === self::ROLE_ADMIN_NAME) {
                return true;
            }
        }

        return false;
    }
}
