@extends('layout/app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb>
            <x-breadcrumb.path :href="route('maps.index')">Maps</x-breadcrumb.path>
            <x-breadcrumb.path-active>View</x-breadcrumb.path-active>
        </x-breadcrumb>
        <div class="container bg-gray-100 py-2 px-3 mt-2 flex rounded-t-md justify-between">
            <x-anchor btnClass="success" :href="route('maps.create')">Create</x-anchor>
            <button class="bg-gray-200 py-2 px-3 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Zm8.25-3.75a.75.75 0 0 1 .75.75v2.25h2.25a.75.75 0 0 1 0 1.5h-2.25v2.25a.75.75 0 0 1-1.5 0v-2.25H7.5a.75.75 0 0 1 0-1.5h2.25V7.5a.75.75 0 0 1 .75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="container">
            <x-map-view :class="'w-full h-[380px] z-0'" />
        </div>
    </div>
@endsection

@push('scripts')
    @include('layout.partials.leaflet')
@endpush
