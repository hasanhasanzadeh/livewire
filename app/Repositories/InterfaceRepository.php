<?php

namespace App\Repositories;

interface InterfaceRepository
{
    public function getAll();

    public function getById($id);

    public function delete($id);

    public function store(array $data);

    public function update($id, array $data);

    // Add more methods as per your application needs
}
