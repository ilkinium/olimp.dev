<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = [];
    protected $guarded = ['id'];
}
