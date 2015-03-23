<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Project extends Model {

	protected $table = 'projects';
	protected $fillable = ['category_id', 'cover_id', 'title', 'medium', 'summary', 'summary_background_color', 'summary_font_color', 'link', 'link_text', 'markdown', 'html', 'featured', 'published', 'started_at', 'completed_at'];
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

	public function setSlugAttribute($title)
	{
		$slug = Str::slug($title);
		$slugCount = count($this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
		$this->attributes['slug'] = ($slugCount > 0 && $this->title != $title) ? "{$slug}-{$slugCount}" : $slug;
	}

	public function setHtmlAttribute($markdown)
	{
		$parsedown = new \Parsedown();
		$html = $parsedown->text($markdown);
		$this->attributes['html'] = $html;
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
