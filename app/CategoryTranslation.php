<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $table = 'category_translations';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
