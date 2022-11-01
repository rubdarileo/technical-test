<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return response()->json($country->states);
    }
}
