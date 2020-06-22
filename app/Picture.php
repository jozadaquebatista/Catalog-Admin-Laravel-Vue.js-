<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'product_id'
    ];

    protected $hidden = [
        'product_id', 'deleted_at', 'created_at', 'updated_at'
    ];
}
