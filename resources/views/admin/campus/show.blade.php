@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb :paths="['Campus']" :active="$campus->id" />
        <div class="container mt-4">
            <h1>SHOW</h1>
            <div class="grid grid-cols-2">
                <p>Name</p>
                <p>{{ $campus->name }}</p>
                <p>Address</p>
                <p>{{ $campus->address }}</p>
                <p>Latitude</p>
                <p>{{ $campus->lat }}</p>
                <p>Longitude</p>
                <p>{{ $campus->long }}</p>
            </div>
        </div>
    </div>
@endsection
