<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/**
 * Class User
 * @package App\Models
 * @version May 21, 2022, 7:23 pm UTC
 *
 * @property string $UUID
 * @property string $avatar_name
 * @property string $name
 * @property string $email
 * @property string|\Carbon\Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $api_token
 * @property string|\Carbon\Carbon $last_login_at
 * @property string $last_login_ip
 */



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    use SoftDeletes;

    use HasFactory;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'UUID',
        'avatar_name',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'api_token',
        'last_login_at',
        'last_login_ip'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'UUID' => 'string',
        'avatar_name' => 'string',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'api_token' => 'string',
        'last_login_at' => 'datetime',
        'last_login_ip' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'UUID' => 'nullable|string|max:191',
        'avatar_name' => 'nullable|string|max:191',
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'email_verified_at' => 'nullable',
        'password' => 'required|string|max:255',
        'remember_token' => 'nullable|string|max:100',
        'api_token' => 'nullable|string|max:191',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'last_login_at' => 'nullable',
        'last_login_ip' => 'nullable|string|max:191'
    ];


}
