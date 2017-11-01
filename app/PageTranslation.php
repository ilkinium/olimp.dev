<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PageTranslation
 *
 * @mixin \Eloquent
 */
class PageTranslation extends Model
{
    protected $table = 'page_translations';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
