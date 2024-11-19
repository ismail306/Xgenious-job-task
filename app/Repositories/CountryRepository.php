<?php

namespace App\Repositories;

use App\Interfaces\CountryInterface;
use App\Models\Country;

class CountryRepository implements CountryInterface
{

    public function all()
    {
        return Country::all();
    }

    public function store($data)
    {


        $country = new Country();
        $country->name = $data['name'];
        $country->status = $data['status'];
        $country->save();

        return response()->json([
            'success' => true,
            'message' => 'Country created successfully!',
        ]);
    }

    public function update($data, $countryId)
    {

        $country = Country::findOrFail($countryId);

        $country->name = $data['name'];
        $country->status = $data['status'];
        $country->save();

        return response()->json([
            'success' => true,
            'message' => 'Country Updated successfully!',
        ]);
    }
}
