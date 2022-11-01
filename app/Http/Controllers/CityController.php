<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return response()->json($state->cities);
    }
}
