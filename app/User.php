<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use QCod\Gamify\Gamify;

class User extends Authenticatable
{
    use Notifiable, Gamify;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

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
    public function entree()
    {
        return $this->hasMany('MattDaneshvar\Survey\Models\Entry', 'participant_id', 'id');
    }
    public function reputations()
    {
        return $this->hasMany(config('gamify.reputation_model'), 'payee_id', 'id');
    }
}
