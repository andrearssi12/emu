@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb :paths="['Campus', $campus->id]" :active="'Edit'" />
        <div class="container mt-4">
            <form action="{{ route('campus.update', $campus->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $campus->name }}"
                            class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" value="{{ $campus->address }}"
                            class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="lat">Latitude</label>
                        <input type="text" name="lat" id="lat" value="{{ $campus->lat }}"
                            class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="long">Longitude</label>
                        <input type="text" name="long" id="long" value="{{ $campus->long }}"
                            class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-2">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
