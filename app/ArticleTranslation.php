<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ArticleTranslation
 *
 * @mixin \Eloquent
 */
class ArticleTranslation extends Model
{
    protected $table = 'article_translations';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
