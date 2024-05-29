@extends('layout/app')

@section('content')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                <div class="flex items-center justify-center h-24 rounded ">
                    <div class="w-full h-full bg-slate-400 rounded-xl flex items-center gap-3 p-4">
                        <p>test</p>
                        <p>test</p>
                    </div>
                </div>
                <div class="flex items-center justify-center h-24 rounded ">
                    <div class="w-full h-full bg-slate-400 rounded-xl flex items-center gap-3 p-4">
                        <p>test</p>
                        <p>test</p>
                    </div>
                </div>
                <div class="flex items-center justify-center h-24 rounded ">
                    <div class="w-full h-full bg-slate-400 rounded-xl flex items-center gap-3 p-4">
                        <p>test</p>
                        <p>test</p>
                    </div>
                </div>
            </div>
            <div class="container w-full mx-auto px-2">
                <x-data-tables :headers="['No', 'Name', 'Test', 'Age', 'Start date', 'Salary']" />
            </div>
        </div>
    </div>
@endsection
