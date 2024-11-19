<?php

namespace App\Interfaces;

interface CountryInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data, $id);
}
