@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb :paths="['Campus']" :active="'Create'" />
        <div class="container mt-4">
            <form action="{{ route('campus.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border border-gray-200 rounded-md"
                            required>
                    </div>
                    <div>
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address"
                            class="w-full p-2 border border-gray-200 rounded-md" required>
                    </div>
                    <div>
                        <label for="lat">Latitude</label>
                        <input type="text" name="lat" id="lat"
                            class="w-full p-2 border border-gray-200 rounded-md" required>
                    </div>
                    <div>
                        <label for="long">Longitude</label>
                        <input type="text" name="long" id="long"
                            class="w-full p-2 border border-gray-200 rounded-md" required>
                    </div>
                </div>
                <button type="submit" class="py-2 px-3 bg-green-500 text-white rounded-md mt-4">Submit</button>
            </form>
        </div>
    </div>
@endsection
