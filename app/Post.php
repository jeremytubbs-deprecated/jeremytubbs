<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Post extends Model {

    protected $table = 'posts';
	protected $fillable = [];
	protected $dates = ['published_at'];

	public function tags()
	{
        return $this->belongsToMany('App\Tag');
    }

    public function category()
    {
        return $this->belongsTo('App\Catagory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function cover()
    {
        return $this->hasOne('App\Cover');
    }

	public function setSlugAttribute($title)
    {
        $slug = Str::slug($title);
    	$slugCount = count($this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
    	$this->attributes['slug'] = ($slugCount > 0 && $this->title != $title) ? "{$slug}-{$slugCount}" : $slug;
    }

	public function getTagListAttribute()
	{
		return $this->tags->lists('id');
	}

    public function getCategoriesAttribute()
    {
        return $this->tags->lists('id', 'name');
    }

    public function getProjectsAttribute()
    {
        return $this->tags->lists('id', 'title');
    }

	public function getPublishedAttribute()
	{
		return $this->published_at->diffForHumans();
	}

}
