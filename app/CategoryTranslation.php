<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CategoryTranslation
 *
 * @mixin \Eloquent
 */
class CategoryTranslation extends Model
{
    protected $table = 'category_translations';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
