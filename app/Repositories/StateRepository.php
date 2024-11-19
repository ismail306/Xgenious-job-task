<?php

namespace App\Repositories;

use App\Interfaces\StateInterface;
use App\Models\State;

class StateRepository implements StateInterface
{

    public function all()
    {
        return State::all();
    }

    public function store($data)
    {


        $state = new State();
        $state->name = $data['name'];
        $state->country_id = $data['country_id'];
        $state->status = $data['status'];
        $state->save();

        return response()->json([
            'success' => true,
            'message' => 'State created successfully!',
        ]);
    }

    public function update($data, $stateId)
    {

        $state = State::findOrFail($stateId);

        $state->name = $data['name'];
        $state->country_id = $data['country_id'];

        $state->status = $data['status'];
        $state->save();

        return response()->json([
            'success' => true,
            'message' => 'State Updated successfully!',
        ]);
    }
}
