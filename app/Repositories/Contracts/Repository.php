<?php

namespace App\Repositories\Contracts;

interface Repository
{
    public function findAll();

    public function create(array  $data);

    public function update(array $data, $id);

    public function delete($id);

    public function findById($id);
}
