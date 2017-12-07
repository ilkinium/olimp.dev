<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Page
 *
 * @property-read \App\MenuItem $menuElement
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PageTranslation[] $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PageTranslation[] $translations
 * @mixin \Eloquent
 */
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

    public static function templates(){
        return collect([
            ['value' => 'about', 'name' => 'About us template'],
            ['value' => 'contacts', 'name' => 'Contact us template'],
            ['value' => 'simple', 'name' => 'Simple page template'],
            ['value' => 'rightSideBar', 'name' => 'Page with right sidebar']
        ]);
    }
}
