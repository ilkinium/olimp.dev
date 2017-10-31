<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
