<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getRole($id)
    {
        $user = Auth::user();

        $role = DB::table('roles')
        ->select('roles.name')
        ->join('user_roles','user_roles.role_id','=','roles.id')
        ->join('users','users.id','=','user_roles.user_id')
        ->where('users.id','=',$id)
        ->get();

        return $role->first()->name;
    }

    public static function getAllAdmin()
    {
        $admins = DB::table('users')
        ->select('users.*')
        ->join('user_roles','user_roles.user_id','=','users.id')
        ->join('roles','roles.id','=','user_roles.role_id')
        ->where('roles.id','=',2)
        ->get();

        return $admins;
    }
}
