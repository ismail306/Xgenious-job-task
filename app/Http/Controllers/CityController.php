<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityStoreRequest;
use App\Interfaces\CityInterface;
use App\Http\Requests\CityUpdateRequest;
use App\Models\Country;
use App\Models\City;



class CityController extends Controller
{

    protected $cityRepository;

    public function __construct(CityInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    public function index()
    {
        $cities = City::whereHas('state', function ($query) {
            $query->whereNull('deleted_at'); //where state is not soft-deleted
        })->whereHas('state.country', function ($query) {
            $query->whereNull('deleted_at'); 
        })->with(['state', 'state.country'])->get();

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = Country::where('status', 'active')->get();
        return view('admin.cities.create', compact('countries'));
    }

    public function store(CityStoreRequest $request)
    {

        $data = $request->all();
        return $this->cityRepository->store($data);
    }

    public function show(City $city)
    {
        //

    }

    public function edit(City $city)
    {

        $countries = Country::where('status', 'active')->get();
        return view('admin.cities.edit', compact('countries', 'city'));
    }

    public function update(CityUpdateRequest $request, $city)
    {
        $result = $this->cityRepository->update($request->all(), $city);
        return $result;
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully.'
        ]);
    }
}
