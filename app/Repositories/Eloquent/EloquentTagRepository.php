<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use App\Repositories\TagRepository;
use App\Repositories\Eloquent\EloquentBaseRepository;

class EloquentTagRepository extends EloquentBaseRepository implements TagRepository
{
    /**
     * Find a tag by its name
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        $tags = $this->model->where('name', '=', $name)->get();
        return $tags;
    }
}
