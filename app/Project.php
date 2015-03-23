<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $dates = ['started_at', 'completed_at'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function project_assets()
	{
		return $this->hasMany('App\ProjectAsset');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag');
	}

	public function category()
	{
		return $this->belongsTo('App\Catagory');
	}

    public function cover()
    {
        return $this->belongsTo('App\Cover');
    }

    public function getTagListAttribute()
	{
		return $this->tags->lists('id');
	}

    public function getCategoriesAttribute()
    {
        return $this->tags->lists('id', 'name');
    }

}
