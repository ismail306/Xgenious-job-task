<?php

namespace App\Repositories;

use App\Interfaces\CityInterface;
use App\Models\City;

class CityRepository implements CityInterface
{

    public function all()
    {
        return City::all();
    }

    public function store($data)
    {


        $city = new City();
        $city->name = $data['name'];
        $city->state_id = $data['state_id'];
        $city->country_id = $data['country_id'];
        $city->status = $data['status'];
        $city->save();

        return response()->json([
            'success' => true,
            'message' => 'City created successfully!',
        ]);
    }

    public function update($data, $cityId)
    {

        $city = City::findOrFail($cityId);

        $city->name = $data['name'];
        $city->country_id = $data['country_id'];

        $city->status = $data['status'];
        $city->save();

        return response()->json([
            'success' => true,
            'message' => 'City Updated successfully!',
        ]);
    }
}
