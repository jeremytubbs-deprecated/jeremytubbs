<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Post extends Model {

	protected $fillable = [];
	protected $dates = ['published_at'];

	public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

	public function setSlugAttribute($title)
    {
        $slug = Str::slug($title);
    	$slugCount = count($this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
    	$this->attributes['slug'] = ($slugCount > 0 && $this->title != $title) ? "{$slug}-{$slugCount}" : $slug;
    }

	public function getTagListAttribute() {
		return $this->tags->lists('id');
	}

	public function getPublishedAttribute() {
		return $this->published_at->diffForHumans();
	}

}
