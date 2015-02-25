<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {

	protected $fillable = ['name'];

	public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function setSlugAttribute($name)
    {
        $slug = Str::slug($name);
    	$this->attributes['slug'] = $slug;
    }

}
