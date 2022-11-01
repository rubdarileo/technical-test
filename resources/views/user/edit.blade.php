<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-gray disabled:opacity-25">
                    <- Go back
                </a>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="mb-4">
                    <label for="textname"
                        class="block mb-2 text-sm font-bold text-gray-700">Name</label>
                    <input type="text"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        name="name"
                        value="{{ $user->name }}"
                        placeholder="Enter name">
                    @error('name') <span class="text-red-500">{{ $message }}
                    </span>@enderror
                </div>
                <div class="mb-4">
                    <label for="textemail"
                        class="block mb-2 text-sm font-bold text-gray-700">Email</label>
                    <input type="text"
                        disabled
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        name="email"
                        value="{{ $user->email }}"
                        placeholder="Enter email">
                    @error('email') <span class="text-red-500">{{ $message }}
                    </span>@enderror
                </div>
                <!-- Phone -->
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Phone')" />

                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $user->phone }}" />

                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Identification -->
                <div class="mt-4">
                    <x-input-label for="identification" :value="__('Identification')" />

                    <x-text-input disabled id="identification" class="block mt-1 w-full" type="text" name="identification" value="{{ $user->identification }}" required />

                    <x-input-error :messages="$errors->get('identification')" class="mt-2" />
                </div>

                <!-- Birthdate -->
                <div class="mt-4">
                    <x-input-label for="birthdate" :value="__('Birthdate')" />

                    <input type="date" name="birthdate" class="form-control w-full" value="{{ $user->birthdate }}" placeholder="Date" required>

                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                </div>

                <!-- Country -->
                <div class="mt-4">
                    <x-input-label for="country" :value="__('Country')" />
                    
                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="country" id="country" required>
                        <option value="0">
                            Select
                        </option>
                        @foreach ($countries as $key => $value)
                            <option value="{{ $value->id }}" @selected($value->id == $user->city->state->country->id)>
                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

                <!-- State -->
                <div class="mt-4">
                    <x-input-label for="state" :value="__('State')" />

                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="state" id="state" required>
                        <option value="0">
                            Select
                        </option>
                        @foreach ($states as $key => $value)
                            <option value="{{ $value->id }}" @selected($value->id == $user->city->state->id)>
                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>

                <!-- City -->
                <div class="mt-4">
                    <x-input-label for="city" :value="__('City')" />

                    <select name="city" id="city" required class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                        <option value="0">
                            Select
                        </option>
                        @foreach ($cities as $key => $value)
                            <option value="{{ $value->id }}" @selected($value->id == $user->city->id)>
                                {{ $value->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div>
                    <button type="submit"
                    class="inline-flex items-center px-4 py-2 my-3 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                        Save
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @section('page-script')
        <script type="text/javascript">
            $("document").ready(function () {
                $('#country').on('change', function() {
                    var country_id = $("#country").val();
                    
                    $.ajax({
                        url: "/api/states/" + country_id,
                        type: "GET",
                        cache: false,
                        success: function(result){
                            document.getElementById("state").innerHTML= "";
                            document.getElementById("city").innerHTML= "";
                            $('select[name="state"]').append('<option value="0" selected>Select</option>');
                            $('select[name="city"]').append('<option value="0">Select</option>');
                            $.each(result, function (key, value) {
                                $('select[name="state"]').append('<option value=" ' + value.id + '">' + value.name + '</option>');
                            })
                        }
                    });
                });
                $('#state').on('change', function() {
                    var state_id = $("#state").val();
                    $.ajax({
                        url: "/api/cities/" + state_id,
                        type: "GET",
                        cache: false,
                        success: function(result){
                            document.getElementById("city").innerHTML= "";
                            $('select[name="city"]').append('<option value="0" selected>Select</option>');
                            $.each(result, function (key, value) {
                                $('select[name="city"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            })
                        }
                    });
                });
            })
            
        </script>
    @stop
</x-app-layout>
