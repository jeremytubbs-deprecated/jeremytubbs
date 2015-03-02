<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;

use App\Tag;
use App\Repositories\Eloquent\EloquentBaseRepository;

class EloquentTagRepository extends EloquentBaseRepository
{

    /**
     * @var Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

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

    public function tagList()
    {
        $tags = $this->model->lists('name', 'id');
        return $tags;
    }

    public function createOrUpdate($tags)
    {
        foreach($tags as $key => $tag)
        {
            if (! is_numeric($tag))
            {
                $newTag = $this->create($tag);
                $tags[$key] = $newTag->id;
            }
        }
        return $tags;
    }

    public function create($tag) {
        $newTag = new Tag();
        $newTag->name = $tag;
        $newTag->slug = $tag;
        $newTag->save();
        return $newTag;
    }
}
