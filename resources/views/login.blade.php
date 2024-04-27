@extends('layout/app')

@section('content')
    <div class="w-full h-screen flex items-start">
        <div class="relative w-1/2 h-full md:flex flex-col hidden">
            <img src="{{ asset('img/logo-login.png') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div class="w-full md:w-1/2 h-full flex flex-col p-11 md:p-20 justify-around">
            <h1 class="text-xl text-[#060606] font-semibold block md:hidden">Eco Map UAD</h1>

            <div class="w-full flex flex-col">
                <div class="w-full flex flex-col mb-5 md:mb-10">
                    <h3 class="text-2xl font-semibold mb-4 text-center">LOGIN</h3>
                </div>

                <div class="w-full flex flex-col">
                    <form>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@flowbite.com" required />
                        </div>
                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                password</label>
                            <input type="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                        <div class="flex items-start mb-5">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value=""
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                    required />
                            </div>
                            <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                                me</label>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>

            <div class="w-full flex items-center justify-center">
                <p class="text-sm font-normal text-[#060606]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, mollitia?</p>
            </div>
        </div>
    </div>
@endsection
