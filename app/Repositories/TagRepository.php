<?php namespace App\Repositories;

use App\Repositories\BaseRepository;

interface TagRepository extends BaseRepository
{
    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name);
}