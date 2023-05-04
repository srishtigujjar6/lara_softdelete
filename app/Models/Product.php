<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['name','price',];

    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
