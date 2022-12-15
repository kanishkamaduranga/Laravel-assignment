@extends('layouts.app')
@section('content')

    <div class="container px-6 mx-auto grid">

        <!-- General elements -->
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" >
            <a href="{!! route('home') !!}">Dashboard</a> > View Damage
        </h2>


        <div class="grid gap-6 mb-8 md:grid-cols-3">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Customer Details
                </h4>
                <ul class="px-0">
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Customer Reference</span>
                        <label class="float-right">{{ $damage->customer->customer_reference }}</label>
                    </li>
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Customer Name</span>
                        <label class="float-right">{{ $damage->customer->name }}</label>
                    </li>
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Customer Email</span>
                        <label class="float-right">{{ $damage->customer->email }}</label>
                    </li>
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Customer TP</span>
                        <label class="float-right">{{ $damage->customer->tp }}</label>
                    </li>
                </ul>
                <br>
            </div>

            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Description
                </h4>
                <p class="text-gray-600 dark:text-gray-400">
                    {!! $damage->description !!}
                </p>
                <br>

                @if(isset($damage->repairshop))
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Repair Shops
                    </h4>
                    <ul class="px-0">
                        @if(count($damage->repairshop ))
                            @foreach($damage->repairshop as $shop)
                                <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                                    <span class="text-gray-600 dark:text-gray-400" >{{ $shop->name }}</span>
                                    <label class="float-right">
                                        <a href="{!! route('repair-shop.show', $shop->id ) !!}"> View </a>
                                    </label>
                                </li>
                            @endforeach
                        @else
                            <span><span>not assign any repair shop </span></span>
                        @endif
                    </ul>
                    <br>
                @endif

            </div>

            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                    Damage Status {!! ViewHelper::generageStatusView(ViewHelper::returnStatusInformations($damage->status)) !!}
                </h4>

                <ul class="px-0">
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Latitude</span>
                        <label class="float-right">{{ $damage->latitude }}</label>
                    </li>
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Longitude</span>
                        <label class="float-right">{{ $damage->longitude }}</label>
                    </li>
                    <li class="border list-none rounded-sm px-3 py-3" style='border-bottom-width:0'>
                        <span class="text-gray-600 dark:text-gray-400" >Created At</span>
                        <label class="float-right">{{ $damage->created_at }}</label>
                    </li>
                </ul>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                      Change Status
                    </span>
                    <form method="post" action="{{ route('dashboard.damage.status_update',['id' => $id]) }}">
                        @csrf
                        @method('PATCH')
                        <select
                            name="status"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" >
                            @foreach($status_list as $key=> $status)
                                <option value="{!! $key !!}" @if($damage->status == $key) selected="selected" @endif >{!! $status['title'] !!}</option>
                            @endforeach
                        </select>
                        <br>
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update
                        </button>
                    </form>
                </label>

            </div>
        </div>

        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
            Images
        </h4>

        <div class="grid gap-6 mb-8 md:grid-cols-4">

            @foreach($damage->media as $image)
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800" >
                    <img src="{{ $image->path }}" title="{{ $image->title }}"></img>
                </div>
            @endforeach
        </div>


        <div class="mt-4 text-sm">
            <a href="{{ redirect()->getUrlGenerator()->previous() }}">
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Back
                </button>
            </a>

        </div>

    </div>

@endsection
