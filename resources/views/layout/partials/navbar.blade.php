<nav class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 py-3 px-4">
    <div class="flex justify-between items-center max-w-screen-2xl mx-auto">
        <div class="flex justify-start items-center">
            <a href="{{ route('beranda') }}" class="flex mr-14">
                <img src="{{ asset('img/logo-putih.png') }}" class="mr-3 h-8 hidden dark:block" alt="EMU Logo" />
                <img src="{{ asset('img/logo-hitam.png') }}" class="mr-3 h-8 dark:hidden" alt="EMU Logo" />
                <span
                    class="self-center hidden sm:flex text-2xl font-semibold whitespace-nowrap dark:text-white">EMU</span>
            </a>
        </div>
        <div class="hidden lg:flex lg:items-center lg:justify-center lg:flex-1">
            <ul class="flex flex-col mt-4 space-x-6 text-sm font-medium lg:flex-row xl:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ route('beranda') }}"
                        class="block rounded  {{ \Route::is('beranda') ? 'text-primary-700 dark:text-primary-500' : 'text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white' }}"
                        aria-current="page">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('peta.kampus') }}"
                        class="block {{ \Route::is('peta.kampus') ? 'text-primary-700 dark:text-primary-500' : 'text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white' }}">Kampus</a>
                </li>
                <li>
                    <a href="{{ route('peta') }}"
                        class="block text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white">Kawasan
                        Hijau</a>
                </li>
                <li>
                    <a href="#"
                        class="block text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white">Tentang
                        Kami</a>
                </li>
            </ul>
        </div>
        <div class="flex justify-between items-center lg:order-2">
            <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div id="tooltip-toggle" role="tooltip"
                class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                Toggle dark mode
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            @if (Auth::check())
                <button type="button"
                    class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 flex-shrink-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="userMenuDropdownButton" aria-expanded="false" data-dropdown-toggle="userMenuDropdown">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>

                <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="userMenuDropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm font-semibold text-gray-900 dark:text-white">Neil Sims</span>
                        <span
                            class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
                    </div>
                    <ul class="py-1 font-light text-gray-500 dark:text-gray-400"
                        aria-labelledby="userMenuDropdownButton">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Dashboard
                                Admin</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
                                settings</a>
                        </li>
                    </ul>
                    <ul class="py-1 font-light text-gray-500 dark:text-gray-400"
                        aria-labelledby="userMenuDropdownButton">
                        <li>
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                    class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd"></path>
                                </svg> My likes</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                    class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                                    </path>
                                </svg> Collections</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex w-full items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                        class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm10 8a1 1 0 100 2h3a1 1 0 100-2h-3zm-2-8a1 1 0 00-1 1v3H7a1 1 0 100 2h3v3a1 1 0 102 0V7h3a1 1 0 100-2h-3V2a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg> Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <!-- Modal toggle -->
                <button onclick="showDialog()"
                    class="lg:block hidden text-sm rounded-lg px-4 py-2 text-center mx-3 text-black ring-2 ring-black hover:bg-black hover:text-white dark:text-white dark:ring-white dark:hover:bg-white dark:hover:text-black"
                    type="button">
                    Login
                </button>
            @endif

            <button type="button" id="toggleMobileMenuButton" data-collapse-toggle="toggleMobileMenu"
                class="items-center p-2 text-gray-500 rounded-lg md:ml-2 lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                <span class="sr-only">Open menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>
<nav class="bg-white dark:bg-gray-800 fixed w-full z-30 top-16">
    <ul id="toggleMobileMenu" class="hidden flex-col w-full text-sm font-medium lg:hidden">
        <li
            class="block border-y dark:border-gray-700  {{ \Route::is('beranda') ? 'dark:bg-gray-900' : 'dark:hover:bg-gray-900' }}">
            <a href="{{ route('beranda') }}"
                class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0"
                aria-current="page">Beranda</a>
        </li>
        <li
            class="block border-b dark:border-gray-700 {{ \Route::is('peta.kampus') ? 'dark:bg-gray-900' : 'dark:hover:bg-gray-900' }}">
            <a href="{{ route('peta.kampus') }}"
                class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Kampus</a>
        </li>
        <li
            class="block border-b dark:border-gray-700 {{ \Route::is('peta') ? 'dark:bg-gray-900' : 'dark:hover:bg-gray-900' }}">
            <a href="{{ route('peta') }}"
                class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Kawasan
                Hijau</a>
        </li>
        <li onclick="showDialog()"
            class="{{ Auth::check() ? 'hidden' : 'block' }} border-b dark:border-gray-700 dark:hover:bg-gray-900 cursor-pointer">
            <span class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Login</span>
        </li>
        <li class="block border-b dark:border-gray-700 dark:hover:bg-gray-900">
            <button type="button" data-collapse-toggle="dropdownMobileNavbar"
                class="flex justify-between items-center py-3 px-4 w-full text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Dropdown
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg></button>
            <ul id="dropdownMobileNavbar" class="hidden">
                <li class="block border-t border-b dark:border-gray-700">
                    <a href="#"
                        class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Item
                        1</a>
                </li>
                <li class="block border-b dark:border-gray-700">
                    <a href="#"
                        class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Item
                        2</a>
                </li>
                <li class="block">
                    <a href="#"
                        class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Item
                        3</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

@push('modal')
    <div id="authentication-modal"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-screen opacity-0 transition-opacity duration-500 bg-gray-500/50">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Login
                    </h3>
                    <button onClick="hideDialog()" type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div id="alert-2"
                                class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                                <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-2" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="email" required />
                        </div>
                        <div class="mb-4">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required />
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 my-2">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="toast-success"
        class="hidden fixed top-0 left-0 z-50 items-center w-screen p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">Berhasil Login</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endpush

@push('scripts')
    <script>
        function showDialog() {
            let dialog = document.getElementById("authentication-modal");
            dialog.classList.remove("hidden");
            dialog.classList.add("flex");
            document.body.classList.add("overflow-hidden");
            setTimeout(() => {
                dialog.classList.add("opacity-100");
            }, 100);
        }

        function hideDialog() {
            let dialog = document.getElementById("authentication-modal");
            dialog.classList.remove("opacity-100");
            dialog.classList.add("opacity-0");
            setTimeout(() => {
                document.body.classList.remove("overflow-hidden");
                dialog.classList.remove("flex");
                dialog.classList.add("hidden");
            }, 300);
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if ($errors->any())
                showDialog();
            @endif
            @if (session('success'))
                let toast = document.getElementById("toast-success");
                toast.classList.remove("hidden");
                toast.classList.add("flex");
                setTimeout(() => {
                    toast.classList.remove("flex");
                    toast.classList.add("hidden");
                }, 3000);
            @endif
        });
    </script>
@endpush
