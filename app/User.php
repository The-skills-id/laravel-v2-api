<?php

namespace App;
//use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /* public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    } */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* protected $fillable = [
        'name', 'email', 'password',
    ]; */

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

    /**
 * Override the mail body for reset password notification mail.
 */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetNotification($token));
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'courses_taken');
    }
}
