@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb>
            <x-breadcrumb.path :href="route('maps.index')">Maps</x-breadcrumb.path>
            <x-breadcrumb.path-active>Create</x-breadcrumb.path-active>
        </x-breadcrumb>
        <div class="container grid grid-cols-2 mt-3 gap-3">
            <form action="{{ route('maps.store') }}" method="POST">
                @csrf
                <select name="campus_id" id="" class="w-full rounded-lg">
                    @foreach ($campuses as $campus)
                        <option value="{{ $campus->id }}">{{ $campus->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="area" id="" class="w-full rounded-lg mt-2" placeholder="area">
                <input type="color" name="color"
                    class="appearance-none bg-gray-100 border border-gray-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <textarea name="geom" id="" cols="30" rows="10" class="w-full" hidden></textarea>
                <x-button btnClass="light" type="submit" extraClasses="w-full mt-2">Simpan</x-button>
            </form>
            <x-map-view :class="'w-full h-[500px] z-0'" />
        </div>
    </div>
@endsection

@push('scripts')
    @include('layout.partials.leaflet')
@endpush
