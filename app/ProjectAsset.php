<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAsset extends Model {

	public function cover()
    {
        return $this->hasOne('App\Cover');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}
