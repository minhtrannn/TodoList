<?php 
namespace App\Repositories;

/**
 * Class BaseRepository.
 */
class BaseRepository
{
    public function getCount()
    {
        return $this->query()->count();
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }
    public function getAll()
    {
        return $this->query()->orderBy('id', 'DESC')->get();
    }

    public function query()
    {
        return call_user_func(static::MODEL . '::query');
    }
}
?>