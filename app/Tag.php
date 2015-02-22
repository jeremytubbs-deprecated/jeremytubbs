<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {

	protected $fillable = [];

	public function users()
    {
        return $this->belongsToMany('Post');
    }

    public function setSlugAttribute($title)
    {
        $slug = Str::slug($title);
    	$slugCount = count($this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
    	$this->attributes['slug'] = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

}
