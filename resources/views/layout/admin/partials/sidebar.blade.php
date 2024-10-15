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
    $routeData = array_merge($routeKawasan, $routePenggunaan);
@endphp
<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <div class="pb-2 space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 {{ \Route::is($routeDashboard) ? 'bg-gray-100 group dark:bg-gray-700' : '' }}">
                        <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ \Route::is($routeDashboard) ? 'text-gray-900 dark:text-white' : '' }}"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                    </a>
                </div>
                <ul class="pb-2 pt-2 space-y-2">
                    <li>
                        <p class="p-2 text-black text-sm dark:text-white">Data</p>
                    </li>
                    <li>
                        <a href="{{ route('kampus.index') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 {{ \Route::is($routeKampus) ? 'bg-gray-100 group dark:bg-gray-700' : '' }}">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ \Route::is($routeKampus) ? 'text-gray-900 dark:text-white' : '' }}"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path
                                    d="M288 0L400 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-79.3 0 89.6 64L512 160c35.3 0 64 28.7 64 64l0 224c0 35.3-28.7 64-64 64l-176 0 0-112c0-26.5-21.5-48-48-48s-48 21.5-48 48l0 112L64 512c-35.3 0-64-28.7-64-64L0 224c0-35.3 28.7-64 64-64l101.7 0L256 95.5 256 32c0-17.7 14.3-32 32-32zm48 240a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM80 224c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0zm368 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zM80 352c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0zm384 0c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-32 0z" />
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Kampus</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kawasan-hijau.index') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 {{ \Route::is($routeKawasan) ? 'bg-gray-100 group dark:bg-gray-700' : '' }}">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ \Route::is($routeKawasan) ? 'text-gray-900 dark:text-white' : '' }}"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M210.6 5.9L62 169.4c-3.9 4.2-6 9.8-6 15.5C56 197.7 66.3 208 79.1 208l24.9 0L30.6 281.4c-4.2 4.2-6.6 10-6.6 16C24 309.9 34.1 320 46.6 320L80 320 5.4 409.5C1.9 413.7 0 419 0 424.5c0 13 10.5 23.5 23.5 23.5L192 448l0 32c0 17.7 14.3 32 32 32s32-14.3 32-32l0-32 168.5 0c13 0 23.5-10.5 23.5-23.5c0-5.5-1.9-10.8-5.4-15L368 320l33.4 0c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16L344 208l24.9 0c12.7 0 23.1-10.3 23.1-23.1c0-5.7-2.1-11.3-6-15.5L237.4 5.9C234 2.1 229.1 0 224 0s-10 2.1-13.4 5.9z" />
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Kawasan Hijau</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('penggunaan-lahan.index') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 {{ \Route::is($routePenggunaan) ? 'bg-gray-100 group dark:bg-gray-700' : '' }}">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ \Route::is($routePenggunaan) ? 'text-gray-900 dark:text-white' : '' }}"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path
                                    d="M48 0C21.5 0 0 21.5 0 48L0 464c0 26.5 21.5 48 48 48l96 0 0-80c0-26.5 21.5-48 48-48s48 21.5 48 48l0 80 89.9 0c-6.3-10.2-9.9-22.2-9.9-35.1c0-46.9 25.8-87.8 64-109.2l0-95.9L384 48c0-26.5-21.5-48-48-48L48 0zM64 240c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zm112-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM80 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM272 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zM576 272a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM352 477.1c0 19.3 15.6 34.9 34.9 34.9l218.2 0c19.3 0 34.9-15.6 34.9-34.9c0-51.4-41.7-93.1-93.1-93.1l-101.8 0c-51.4 0-93.1 41.7-93.1 93.1z" />
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Penggunaan Lahan</span>
                        </a>
                    </li>
                </ul>
                <ul class="pt-2 space-y-2">
                    <li>
                        <p class="p-2 text-black text-sm dark:text-white">Master</p>
                    </li>
                    <li>
                        <a href="{{ route('user.index') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 {{ \Route::is($routeUser) ? 'bg-gray-100 group dark:bg-gray-700' : '' }}">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white {{ \Route::is($routeUser) ? 'text-gray-900 dark:text-white' : '' }}"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>User</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white "
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M96 0C43 0 0 43 0 96L0 416c0 53 43 96 96 96l288 0 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64c17.7 0 32-14.3 32-32l0-320c0-17.7-14.3-32-32-32L384 0 96 0zm0 384l256 0 0 64L96 448c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16zm16 48l192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Log Aktivitas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>
