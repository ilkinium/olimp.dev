<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
