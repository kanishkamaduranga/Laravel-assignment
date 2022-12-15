@extends('layouts.app')
@section('content')


    <div class="container px-6 mx-auto grid">

        <!-- General elements -->
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" >
            <a href="{!! route('repair-shop.index') !!}">Repair Shops</a> > Show
        </h2>

        <div class="grid gap-6 mb-8 md:grid-cols-3">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                 <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input readonly
                           name="name"
                           id="name"
                           class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           value="{!! $shop->name !!}"/>
                </label>

                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input readonly
                           name="email"
                           id="email"
                           class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           value="{!! $shop->email !!}"/>
                </div>

                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Telephone</span>
                    <input readonly
                           name="tp"
                           id="tp"
                           class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           value="{!! $shop->tp !!}"/>
                </div>

                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Latitude</span>
                    <input readonly
                           name="latitude"
                           id="latitude"
                           class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           value="{!! $shop->latitude !!}"/>
                </div>

                <div class="mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Longitude</span>
                    <input readonly
                           name="longitude"
                           id="longitude"
                           class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           value="{!! $shop->longitude !!}"/>
                </div>

                <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                              Status
                            </span>
                    <input readonly
                           name="longitude"
                           id="longitude"
                           class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                           value="{!! $status_list[$shop->status] !!}"/>
                </label>

                <div class="mt-4 text-sm">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}">
                        <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                            Back
                        </button>
                    </a>

                </div>

            </div>
            </div>

            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Available Damage Reports
                </h4>

                <ul class="px-0">
                    @foreach( $shop->damage as $damage)
                        <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                            <span class="text-gray-600 dark:text-gray-400" >
                                {!! ViewHelper::generageStatusView(ViewHelper::returnStatusInformations($damage->status)) !!}

                                <a href="{{ route('dashboard.damage.show', [ $damage->id ]) }}"
                                   class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                   aria-label="Show" >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                                                </svg>
                                </a>
                            </span>
                            <p>
                                {!! $damage->description !!}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


@endsection
