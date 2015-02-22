<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {

	protected $fillable = [];

	public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function setSlugAttribute($title)
    {
        $slug = Str::slug($title);
    	$slugCount = count($this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
    	$this->attributes['slug'] = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

}
