<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }
    public function getRedirectRoute()
    {
        if ($this->isEditor()) {
            return ('editor.home');
        } else if ($this->isAdmin()) {
            return ('admin.home');
        }
        return RouteServiceProvider::HOME;
    }
    public function permisions()
    {
        return DB::table('permission_user')->where('user_id',$this->id)->get();
    }
    public function hasPermision(String $per)
    {
        $permision = Permision::where('name',$per)->first();
        if ($permision){
            return DB::table('permission_user')->where('user_id',$this->id)->where('permission_id',$permision->id)->first() ? true : false;
        }
        return false;
    }
}
