<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StateStoreRequest;
use App\Interfaces\StateInterface;
use App\Http\Requests\StateUpdateRequest;
use App\Models\Country;
use App\Models\State;



class StateController extends Controller
{

    protected $stateRepository;

    public function __construct(StateInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }
    public function index()
    {
        $states = State::whereHas('country', function ($query) {
            $query->whereNull('deleted_at'); // where country is not soft-deleted
        })->with('country')->get();
        return view('admin.states.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::where('status', 'active')->get();
        return view('admin.states.create', compact('countries'));
    }

    public function store(StateStoreRequest $request)
    {

        $data = $request->all();
        return $this->stateRepository->store($data);
    }

    public function show(State $state)
    {
        //

    }

    public function edit(State $state)
    {

        $countries = Country::where('status', 'active')->get();
        return view('admin.states.edit', compact('countries', 'state'));
    }

    public function update(StateUpdateRequest $request, $state)
    {
        $result = $this->stateRepository->update($request->all(), $state);
        return $result;
    }

    public function destroy(State $state)
    {
        $state->delete();
        return response()->json([
            'success' => true,
            'message' => 'State deleted successfully.'
        ]);
    }

    public function statesByCountry($country_id)
    {
        $states = State::where('country_id', $country_id)->where('status', 'active')->get();
        return response()->json(['states' => $states]);
    }
}
