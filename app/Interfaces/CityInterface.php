<?php

namespace App\Interfaces;

interface CityInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data, $id);
}
