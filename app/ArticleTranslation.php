<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    protected $table = 'article_translations';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
