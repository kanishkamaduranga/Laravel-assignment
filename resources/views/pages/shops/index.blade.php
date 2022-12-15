@extends('layouts.app')
@section('content')

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" >
            Repair Shops
        </h2>
        <div class="mt-4 text-sm ">
            <a href="{!! route('repair-shop.create') !!}">
                <button  class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    + Add
                </button>
            </a>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th></th>
                        <th class="px-4 py-3">Shop Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">TP</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800" >

                    @foreach( $shops as $shop)
                        <tr class="text-gray-700 dark:text-gray-400">

                            <td>
                                <form action="{{ route('repair-shop.destroy',$shop->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete?');">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{!! route('repair-shop.edit', $shop->id ) !!}" style="float:left"
                                       class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                       aria-label="Edit"
                                       title="Edit" >
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20" >
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                            ></path>
                                        </svg>
                                    </a>

                                    <a href="{!! route('repair-shop.show', $shop->id ) !!}" style="float:left"
                                       class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                       aria-label="Show"
                                       title="Show" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                                        </svg>
                                    </a>

                                    @if('deleted' != $shop->status)
                                        <button
                                            title="Delete"
                                            type="submit"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                        </button>
                                    @endif
                                </form>
                            </td>
                            <td class="px-4 py-3">
                                {{ $shop->name }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ $shop->email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $shop->tp }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $status_list[$shop->status] }}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="grid   " >
                {{ $shops->links('pagination::tailwind') }}

            </div>
        </div>

    </div>
@endsection
