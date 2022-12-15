@extends('layouts.login_app')
@section('content')
    <div class="h-screen font-sans login bg-cover">
        <div class="container mx-auto h-full flex flex-1 justify-center items-center">
            <div class="w-full max-w-lg">
                <div class="leading-loose">
                    @include('layouts.includes.flash-message')
                    <form method="POST" action="{{ route('web.post.login') }}"
                          class="max-w-xl m-4 p-10 bg-white rounded shadow-xl">
                        @csrf
                        <p class="text-gray-800 font-medium text-center text-lg font-bold">Login</p>
                        <div class="">
                            <label class="block text-sm text-gray-00" for="email">Email</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email" name="email"
                                   type="text" required="" placeholder="User Name" aria-label="email">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="password">Password</label>
                            <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="password"
                                   name="password" type="text" required="" placeholder="*******" aria-label="password">
                        </div>
                        <div class="mt-4 items-center justify-between">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                    type="submit">Login
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
