<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone')" />

                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Identification -->
            <div class="mt-4">
                <x-input-label for="identification" :value="__('Identification')" />

                <x-text-input id="identification" class="block mt-1 w-full" type="text" name="identification" :value="old('identification')" required />

                <x-input-error :messages="$errors->get('identification')" class="mt-2" />
            </div>

            <!-- Birthdate -->
            <div class="mt-4">
                <x-input-label for="birthdate" :value="__('Birthdate')" />

                <input type="date" name="birthdate" class="form-control w-full" value="" placeholder="Date" required>

                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
            </div>

            <!-- Country -->
            <div class="mt-4">
                <x-input-label for="country" :value="__('Country')" />

                <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="country" id="country" required>
                    <option value="0" @selected(old('version') ==  0)>
                        Select
                    </option>
                    @foreach ($countries as $key => $value)
                        <option value="{{ $value->id }}">
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
                    <option value="0" @selected(old('version') ==  0)>
                        Select
                    </option>
                    @foreach ($states as $key => $value)
                        <option value="{{ $value->id }}" @selected(old('version') == $value->id)>
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
                    <option value="0" @selected(old('version') ==  0)>
                        Select
                    </option>
                    @foreach ($cities as $key => $value)
                        <option value="{{ $value->id }}" @selected(old('version') == $value->id)>
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

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
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
                            console.log('her',result)
                            $.each(result, function (key, value) {
                                console.log(value.id);
                                $('select[name="state"]').append('<option value=" ' + value.id + '">' + value.name + '</option>');
                            })
                        }
                    });
                });
                $('#state').on('change', function() {
                    var state_id = $("#state").val();
                    console.log('state');
                    $.ajax({
                        url: "/api/cities/" + state_id,
                        type: "GET",
                        cache: false,
                        success: function(result){
                            console.log(result, state_id)
                            $.each(result, function (key, value) {
                                console.log(value.id);
                                $('select[name="city"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            })
                        }
                    });
                });
            })
            
        </script>
    @stop
</x-guest-layout>
