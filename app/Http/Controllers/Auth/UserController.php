<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if($search != ""){
            $users = User::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('identification', 'like', '%'.$search.'%');
            })
            ->sortable()
            ->paginate(env('PAGINATION_MAX'));
            $users->appends(['q' => $search]);
        } else{
            $users = User::sortable()->paginate(env('PAGINATION_MAX'));
        }

        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
            'phone' => ['nullable', 'max:10'],
            'birthdate' => ['required', 'date','before:'.Carbon::now()->subYears(18)],
            'identification' => ['required', 'max:11'],
            'city' => ['numeric', 'required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'identification' => $request->identification,
            'city_id' => $request->city,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  user $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries = Country::all();
        $states = State::where('country_id', $user->city->state->country->id)->get();
        $cities = City::where('state_id', $user->city->state->id)->get();
        return view('user.edit', compact('user', 'countries','states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
            'phone' => ['nullable', 'max:10'],
            'birthdate' => ['required', 'date','before:'.Carbon::now()->subYears(18)],
            'city' => ['numeric', 'required']
        ]);

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'city_id' => $request->city,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User Deleted Successfully.');
    }
}
