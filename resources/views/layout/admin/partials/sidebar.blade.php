@php
    $routeDashboard = 'dashboard';
    $routeKampus = ['kampus.index', 'kampus.show', 'kampus.create', 'kampus.edit', 'kampus.delete'];
    $routeUser = ['user.index', 'user.create', 'user.edit'];
    $routeKawasan = ['kawasan-hijau.index', 'kawasan-hijau.show', 'kawasan-hijau.create', 'kawasan-hijau.edit'];
    $routePenggunaan = [
        'penggunaan-lahan.index',
        'penggunaan-lahan.show',
        'penggunaan-lahan.create',
        'penggunaan-lahan.edit',
    ];
    $routeMaster = array_merge($routeKampus);
    $routeData = array_merge($routeKampus, $routeKawasan, $routePenggunaan);
@endphp
<aside id="sidebar"
    class="fixed top-0 left-0 z-40 flex flex-col flex-shrink-0 hidden w-64 h-full font-normal duration-75 lg:pt-0 lg:flex transition-width"
    aria-label="Sidebar">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-gray-800">
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex-1">
                <div class="px-3 pb-3 pt-4 items-center flex">
                    <a href="{{ route('dashboard') }}" class="flex ml-2 md:mr-24">
                        <img src="{{ asset('img/logo-putih.png') }}" class="mr-3 h-6 sm:h-7" alt="EMU Logo" />
                        <span
                            class="self-center text-l font-semibold sm:text-xl whitespace-nowrap text-white">EMU</span>
                    </a>
                </div>
                <ul class="space-y-2 pt-5">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-5 py-3 text-white {{ \Route::is($routeDashboard) ? 'border-l-2 border-l-blue-600 bg-gradient-to-r from-blue-500/20 to-transparent opacity-100' : '' }} group">
                            <svg class="flex-shrink-0 w-5 h-5 {{ \Route::is($routeDashboard) ? 'text-white' : 'text-gray-400 transition duration-75 group-hover:text-white' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <button type="button"
                            class="w-full flex items-center px-5 py-3 text-white {{ \Route::is($routeData) ? 'border-l-2 border-l-blue-600 bg-gradient-to-r from-blue-500/20 to-transparent opacity-100' : '' }} group"
                            aria-controls="dropdown-crud" data-collapse-toggle="dropdown-crud">
                            <svg class="flex-shrink-0 w-5 h-5 {{ \Route::is($routeData) ? 'text-white' : 'text-gray-400 transition duration-75 group-hover:text-white' }}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z">
                                </path>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Data</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-crud" class="space-y-2 py-2 ml-2">
                            <li>
                                <a href="{{ route('kampus.index') }}"
                                    class="text-base flex items-center p-2 group transition duration-75 pl-11 {{ \Route::is($routeKampus) ? 'text-blue-500' : 'text-gray-200 hover:text-white' }}">Kampus</a>
                            </li>
                            <li>
                                <a href="{{ route('kawasan-hijau.index') }}"
                                    class="text-base flex items-center p-2 group transition duration-75 pl-11 {{ \Route::is($routeKawasan) ? 'text-blue-500' : 'text-gray-200 hover:text-white' }}">Kawasan
                                    Hijau</a>
                            </li>
                            <li>
                                <a href="{{ route('penggunaan-lahan.index') }}"
                                    class="text-base flex items-center p-2 group transition duration-75 pl-11 {{ \Route::is($routePenggunaan) ? 'text-blue-500' : 'text-gray-200 hover:text-white' }}">Penggunaan
                                    Lahan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <button type="button"
                            class="w-full flex items-center px-5 py-3 text-white {{ \Route::is($routeData) ? 'border-l-2 border-l-blue-600 bg-gradient-to-r from-blue-500/20 to-transparent opacity-100' : '' }} group"
                            aria-controls="dropdown-crud" data-collapse-toggle="dropdown-crud">
                            <svg class="flex-shrink-0 w-5 h-5 {{ \Route::is($routeData) ? 'text-white' : 'text-gray-400 transition duration-75 group-hover:text-white' }}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z">
                                </path>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Master</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-crud" class="space-y-2 py-2 ml-2">
                            <li>
                                <a href="{{ route('kampus.index') }}"
                                    class="text-base flex items-center p-2 group transition duration-75 pl-11 {{ \Route::is($routeKampus) ? 'text-blue-500' : 'text-gray-200 hover:text-white' }}">Kampus</a>
                            </li>
                            <li>
                                <a href="{{ route('kawasan-hijau.index') }}"
                                    class="text-base flex items-center p-2 group transition duration-75 pl-11 {{ \Route::is($routeKawasan) ? 'text-blue-500' : 'text-gray-200 hover:text-white' }}">Kawasan
                                    Hijau</a>
                            </li>
                            <li>
                                <a href="{{ route('penggunaan-lahan.index') }}"
                                    class="text-base flex items-center p-2 group transition duration-75 pl-11 {{ \Route::is($routePenggunaan) ? 'text-blue-500' : 'text-gray-200 hover:text-white' }}">Penggunaan
                                    Lahan</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
