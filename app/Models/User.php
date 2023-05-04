<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Mobile;
use App\Models\Softcompany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mobiles()
    {
        return $this->hasMany(Mobile::class);
    }

    public function softcompany()
    {
        return $this->belongsTo(Softcompany::class);
    }

    protected static function boot() {
        parent::boot();
        self::deleting(function (User $users) {
            // dump('cccccc');
            foreach ($users->mobiles as $mobile){$mobile->delete();}
        });
        
        self::restoring(function (User $users) {
            $mobiles = $users->mobiles()->withTrashed()->get();
            foreach ($mobiles as $mobile){
                $mobile->restore();
            }
        });
    }
}


