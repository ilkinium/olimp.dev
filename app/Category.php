<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
