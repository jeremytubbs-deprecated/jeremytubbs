<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {

	protected $fillable = ['name', 'slug', 'description'];

	public function posts()
	{
		return $this->belongsToMany('App\Post');
	}

	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}

	public function setSlugAttribute($name)
	{
		$slug = Str::slug($name);
		$this->attributes['slug'] = $slug;
	}
}
