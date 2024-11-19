<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\Interfaces\CountryInterface;
use App\Http\Requests\CountryUpdateRequest;
use App\Models\Country;



class CountryController extends Controller
{

    protected $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    public function index()
    {
        $countries = $this->countryRepository->all();
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(CountryStoreRequest $request)
    {

        $data = $request->all();
        return $this->countryRepository->store($data);
    }

    public function show(Country $country)
    {
        //

    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(CountryUpdateRequest $request, $country)
    {
        $result = $this->countryRepository->update($request->all(), $country);
        return $result;
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('success', 'Country deleted successfully');
    }
}
