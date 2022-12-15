@extends('layouts.app')
@section('content')

    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" >
            <a href="{!! route('repair-shop.index') !!}">Repair Shops</a> > Edit
        </h2>
        <div class="max-w-2xl overflow-hidden rounded-lg shadow-xs">
            <div class="max-w-2xl  overflow-x-auto">
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >

                    <form action="{{ route('repair-shop.update',$shop->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Name</span>
                            <input
                                name="name"
                                id="name"
                                class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="{!! $shop->name !!}"/>
                        </label>

                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input
                                name="email"
                                id="email"
                                class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="{!! $shop->email !!}"/>
                        </div>

                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Telephone</span>
                            <input
                                name="tp"
                                id="tp"
                                class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="{!! $shop->tp !!}"/>
                        </div>

                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Latitude</span>
                            <input
                                name="latitude"
                                id="latitude"
                                class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="{!! $shop->latitude !!}"/>
                        </div>

                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Longitude</span>
                            <input
                                name="longitude"
                                id="longitude"
                                class="block min-w-full  mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                value="{!! $shop->longitude !!}"/>
                        </div>

                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                              Status
                            </span>
                            <select
                                name="status"
                                id="status"
                                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" >
                                    @foreach($status_list as $key => $status)
                                        <option
                                            value="{{$key}}"
                                            @if( $key == $shop->status ) selected @endif >
                                                {{$status}}
                                        </option>
                                    @endforeach
                            </select>
                        </label>

                        <div class="mt-4 text-sm">
                            <button type="reset" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Reset
                            </button>


                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
                                Submit
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
