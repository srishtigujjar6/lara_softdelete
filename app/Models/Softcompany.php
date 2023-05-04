<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Softcompany extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['name','address',];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected static function boot() {
        parent::boot();
        self::deleting(function (Softcompany $company) {
            // dump('aaaaaa');
            foreach ($company->users as $user){
                $user->delete();
            }
        });
        self::restoring(function (Softcompany $company) {
            $users = $company->users()->withTrashed()->where('deleted_at',$company->deleted_at)->get();
            foreach ($users as $user){
                $user->restore();
            }
        });
    }
}



