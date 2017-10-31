<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    public $timestamps = true;
    protected $fillable = [
        'slug',
        'image',
        'thumbnail',
        'link_target',
        'icon',
        'template',
    ];
    protected $guarded = ['id'];


    /**
     * @return $this
     */
    public function translation()
    {
        return $this->hasMany(PageTranslation::class)->where('lang', \LaravelLocalization::getCurrentLocale());
    }

    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function menuElement()
    {
        return $this->morphOne('App\MenuItem', 'menuElement');
    }
}
