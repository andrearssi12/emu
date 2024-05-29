@if (!request()->is('admin/*'))
    <nav id="navbar"
        class="{{ \Route::is('beranda') ? 'bg-inherit' : 'bg-black/65' }} fixed w-full z-20 top-0 start-0">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('img/logo-putih.png') }}" class="h-10" alt="UAD Logo">
                <span class="self-center text-2xl font-semibold md:whitespace-nowrap text-white">ECO
                    MAP
                    UAD</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @if (Auth::check())
                    <x-profile-image />
                @else
                    <!-- Modal toggle -->
                    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                        class="text-white bg-dark ring-2 ring-white hover:bg-white hover:text-black focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-md px-5 py-2 text-center"
                        type="button">
                        Login
                    </button>
                @endif

                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium rounded-lg bg-gray-50 bg-opacity-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-inherit">
                    <li>
                        <a href="{{ route('beranda') }}"
                            class="block py-2 px-3 rounded text-black md:text-white md:rounded-none md:bg-transparent md:p-0 md:hover:border-b-2 {{ Route::is('beranda') ? 'text-white bg-blue-700 md:border-b-2' : '' }}
                            "
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('peta') }}"
                            class="block py-2 px-3 rounded text-black md:text-white md:rounded-none md:bg-transparent md:p-0 md:hover:border-b-2 {{ Route::is('peta') ? 'text-white bg-blue-700 md:border-b-2' : '' }}">Peta</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-black rounded hover:bg-gray-300 md:hover:bg-transparent md:rounded-none md:text-white md:hover:border-b-2 md:p-0">Galeri</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-black rounded hover:bg-gray-300 md:hover:bg-transparent md:rounded-none md:text-white md:hover:border-b-2 md:p-0">Tentang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @push('modal')
        <x-modal/>
    @endpush
@else
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="{{ asset('img/logo-warna.png') }}" class="h-8 me-3" alt="UAD Logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Eco
                            Map UAD</span>
                    </a>
                </div>
                <x-profile-image />
            </div>
        </div>
    </nav>
@endif
