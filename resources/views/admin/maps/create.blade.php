@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb :paths="['Maps']" :active="'Create'" />
        <div class="container grid grid-cols-2 mt-3 gap-3">
            <form action="{{ route('maps.store') }}" method="POST">
                @csrf
                <select name="campus_id" id="" class="w-full rounded-lg">
                    <option value="">- Pilih Campus -</option>
                    <option value="3">Campus 1</option>
                    <option value="2">Campus 2</option>
                    <option value="4">Campus 3</option>
                    <option value="1">Campus 4</option>
                </select>
                <input type="text" name="area" id="" class="w-full rounded-lg mt-2" placeholder="area">
                <textarea name="geom" id="" cols="30" rows="10" class="w-full" hidden></textarea>
                <button type="submit" class="w-full bg-gray-200 rounded-lg mt-2 py-2 px-3">Submit</button>
            </form>
            <x-map-view :class="'w-full h-[500px]'" />
        </div>
    </div>
@endsection

@push('scripts')
    @include('layout.partials.leaflet')
@endpush
