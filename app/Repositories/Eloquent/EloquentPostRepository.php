<?php namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use App\Post;
use App\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPostRepository extends EloquentBaseRepository
{
    /**
     * @var Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @param  int    $id
     * @return object
     */
    public function find($id)
    {
        return $this->model->with('tags')->find($id);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->with('tags')->orderBy('created_at', 'DESC')->get();
    }
    /**
     * Update a resource
     * @param $post
     * @param  array $data
     * @return mixed
     */
    public function update($post, $data)
    {
        $post->update($data);
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return $post;
    }
    /**
     * Create a blog post
     * @param  array $data
     * @return Post
     */
    public function create($data)
    {
        $post = $this->model->create($data);
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return $post;
    }
}

