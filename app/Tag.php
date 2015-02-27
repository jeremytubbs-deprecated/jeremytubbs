<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model {

	protected $fillable = ['name', 'slug', 'description'];

	public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function setSlugAttribute($name)
    {
        $slug = Str::slug($name);
    	$this->attributes['slug'] = $slug;
    }

    public function setCountAttribute($id)
    {
        $count = count(\DB::table('post_tag')->where('tag_id', '=', $id)->get());
        $this->attributes['count'] = $count + 1;
    }

}
