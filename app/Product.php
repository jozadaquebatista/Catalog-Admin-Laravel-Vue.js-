<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Picture;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'status'
        /*
        'description',
        'price',
        'status',
        'category'
        */
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}