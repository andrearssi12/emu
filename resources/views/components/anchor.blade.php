@props(['btnClass', 'href', 'extraClasses' => ''])

@php
    $buttonClasses = [
        'primary' =>
            'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        'secondary' =>
            'text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-800 focus:outline-none',
        'success' =>
            'text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 focus:outline-none',
    ];

    // Menggabungkan kelas tambahan dengan kelas tombol utama
    $buttonClass = isset($buttonClasses[$btnClass]) ? $buttonClasses[$btnClass] . ' ' . $extraClasses : $extraClasses;
@endphp

<a href="{{ $href }}" class="{{ $buttonClass }}">
    {{ $slot }}
</a>
