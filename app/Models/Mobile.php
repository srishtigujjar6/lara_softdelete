<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Mobile extends Model
{
    use HasFactory, softDeletes;    
    protected $fillable = ['mobile_no',];
    
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
