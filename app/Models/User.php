<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'api_token'
    ];

    public function generateToken()
    {
        $this->api_token = Str::random(32);
        $this->save();

        return $this->api_token;
    }

    public function removeToken()
    {
        $this->api_token = null;
        $this->save();

        return null;
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
}
