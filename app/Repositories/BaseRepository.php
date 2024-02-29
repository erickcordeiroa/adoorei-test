<?php

namespace App\Repositories;

class BaseRepository
{
    public function all(array $data = []): object
    {
        return $this->entity->where($data)->get();
    }

    public function find(int $id): object
    {
        return $this->entity->findOrFail($id);
    }

    public function create(object $data): object
    {
        return $this->entity->create((array) $data);
    }

    public function update(object $data, int $id): object
    {
        $entity = $this->find($id);
        $entity->update((array) $data);

        return $entity;
    }

    public function destroy(int $id): object
    {
        $entity = $this->find($id);
        $entity->delete();

        return $entity;
    }

    public function relationships(...$relationships): object
    {
        return $this->entity->with($relationships);
    }
}
