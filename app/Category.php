<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property-read \App\MenuItem $menuElement
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CategoryTranslation[] $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CategoryTranslation[] $translations
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = [
        'slug',
        'image',
        'thumbnail',
        'link_target',
        'icon',
        'template'
    ];
    protected $guarded = ['id'];

    public function menuElement()
    {
        return $this->morphOne('App\MenuItem', 'menuElement');
    }

    public function translation()
    {
        return $this->hasMany(CategoryTranslation::class)->where('lang', \LaravelLocalization::getCurrentLocale());
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
}
