<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Emails Lists') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="shadow-xl sm:rounded-lg px-4 py-4">
                <a href="{{ url('/emails/create/'.Auth::user()->id) }}"
                   class="bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none inline-flex items-center px-4 py-2 mb-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:shadow-outline-gray disabled:opacity-25">
                   Create New Email
                </a>
                <form action="{{ url('/emails/'.Auth::user()->id) }}" method="GET">
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
                              <th class="px-4 py-2 border desc">@sortablelink('subject')</th>
                              <th class="px-4 py-2 border">@sortablelink('recipient')</th>
                              <th class="px-4 py-2 border">@sortablelink('message')</th>
                              <th class="px-4 py-2 border">@sortablelink('send')</th>
                              <th class="px-4 py-2 border">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(!empty($emails && count($emails) > 0))
                              @foreach($emails as $row)
                                  <tr>
                                  <td class="px-4 py-2 border">{{ $row->id }}</td>
                                      <td class="px-4 py-2 border">{{ $row->subject }}</td>
                                      <td class="px-4 py-2 border">{{ $row->recipient }}</td>
                                      <td class="px-4 py-2 border">{{ $row->message }}</td>
                                      <td class="px-4 py-2 border">{{ $row->send }}</td>
                                      <td class="px-4 py-2 border">
                                          <form action="{{ url('/emails/'. $row->id) }}" method="POST">
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
                                <td class="px-4 py-2 border text-red-500" colspan="9">No emails found.</td>
                            </tr>
                          @endif
                      </tbody>
                  </table>
                  <div>
                    {{ $emails->links() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
    @section('page-script')
        
    @stop
</x-app-layout>

