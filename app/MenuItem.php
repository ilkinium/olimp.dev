<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MenuItem
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $menuElement
 * @mixin \Eloquent
 */
class MenuItem extends Model
{
    protected $table = 'menu_items';
    public $timestamps = true;
    protected $fillable = [
        'menu_id',
        'menu_element_type',
        'menu_element_id',
    ];
    protected $guarded = ['id'];

    public function menuElement()
    {
        return $this->morphTo();
    }
}
