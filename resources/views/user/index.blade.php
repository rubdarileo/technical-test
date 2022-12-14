<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Lists') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="shadow-xl sm:rounded-lg px-4 py-4">
                <a href="{{ route('users.create') }}"
                   class="bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-gray disabled:opacity-25">
                   Create New User
                </a>
                <form action="{{ route('users.index') }}" method="GET">
                    @csrf
                    <input type="text" id="search" name="search" placeholder="search by name, email, document and phone..." />
                    <button type="submit" id="search-button" class="inline-flex items-center px-4 py-2 mx-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25"> Search </button>
                </form>
                @if ($message = Session::get('success'))
                <div style="background: green; color: white;" class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ $message }}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="table-responsive" style="overflow:auto">
                  <table class="table table-bordered table-sortable" cellspacing="0" width="100%">
                      <thead>
                          <tr class="bg-gray-100">
                              <th class="px-4 py-2 border asc">@sortablelink('id')</th>
                              <th class="px-4 py-2 border desc">@sortablelink('name')</th>
                              <th class="px-4 py-2 border">@sortablelink('email')</th>
                              <th class="px-4 py-2 border">@sortablelink('phone')</th>
                              <th class="px-4 py-2 border">@sortablelink('identification')</th>
                              <th class="px-4 py-2 border">@sortablelink('age')</th>
                              <th class="px-4 py-2 border">@sortablelink('country')</th>
                              <th class="px-4 py-2 border">@sortablelink('state')</th>
                              <th class="px-4 py-2 border">@sortablelink('city')</th>
                              <th class="px-4 py-2 border">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(!empty($users && count($users) > 0))
                              @foreach($users as $row)
                                  <tr>
                                  <td class="px-4 py-2 border">{{ $row->id }}</td>
                                      <td class="px-4 py-2 border">{{ $row->name }}</td>
                                      <td class="px-4 py-2 border">{{ $row->email }}</td>
                                      <td class="px-4 py-2 border">{{ $row->phone }}</td>
                                      <td class="px-4 py-2 border">{{ $row->identification }}</td>
                                      <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse( $row->birthdate )->age }}</td>
                                      <td class="px-4 py-2 border">{{ $row->city->state->country->name }}</td>
                                      <td class="px-4 py-2 border">{{ $row->city->state->name }}</td>
                                      <td class="px-4 py-2 border">{{ $row->city->name }}</td>
                                      <td class="px-4 py-2 border">
                                          <form action="{{ route('users.destroy', $row->id) }}" method="POST">
                                              <a href="{{ route('users.show', $row->id) }}" class="inline-flex items-center px-4 py-2 mx-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                                                  Show
                                              </a>
                                              <a href="{{ route('users.edit', $row->id) }}" class="inline-flex items-center px-4 py-2 mx-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                                                  Edit
                                              </a>
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" title="delete" class="inline-flex items-center px-4 py-2 mx-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25">
                                                  Delete
                                              </button>
                                          </form>
                                      </td>
                                  </tr>
                              @endforeach
                          @else
                            <tr>
                                <td class="px-4 py-2 border text-red-500" colspan="9">No users found.</td>
                            </tr>
                          @endif
                      </tbody>
                  </table>
                  <div>
                    {{ $users->links() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
    @section('page-script')
        
    @stop
</x-app-layout>

