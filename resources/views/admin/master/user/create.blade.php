@extends('layout.admin.app')

@section('content')
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Flowbite</span>
                </div>
            </li>
        </ol>
    </nav>

    <div
        class="w-full p-4 my-6 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
        <div class="flex justify-between mb-5">
            <h1 class="text-gray-900 dark:text-white font-bold">Tambah Data User</h1>
            <a href="{{ route('user.index') }}"
                class="py-2 px-3 text-xs text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                    class="fa-solid fa-arrow-left"></i>
                Kembali</a>
        </div>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-12 md:items-center">
                <label for="nama"
                    class="col-span-12 md:col-span-2 xl:col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <div class="flex col-span-12 md:col-span-6">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-font w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                    </span>
                    <input type="text" id="nama" name="nama"
                        class="rounded-none rounded-e-lg bg-gray-50 border  text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('nama') ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' }}"
                        placeholder="Nama Lengkap" value="{{ old('nama') }}">
                </div>
                @error('nama')
                    <div class="col-span-12 md:col-span-6 mt-1">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="grid grid-cols-12 mt-5 md:items-center">
                <label for="email"
                    class="col-span-12 md:col-span-2 xl:col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <div class="flex col-span-12 md:col-span-6">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-envelope w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                    </span>
                    <input type="email" id="email" name="email"
                        class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' }}"
                        placeholder="@gmail.com" value="{{ old('email') }}">
                </div>
                @error('email')
                    <div class="col-span-12 md:col-span-6 mt-1">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="grid grid-cols-12 mt-5 md:items-center">
                <label for="role"
                    class="col-span-12 md:col-span-2 xl:col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                <div class="col-span-12 md:col-span-6">
                    <select id="role" name="role"
                        class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  {{ $errors->has('role') ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' }}">
                        <option value="">Pilih Role</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                @error('role')
                    <div class="col-span-12 md:col-span-6 mt-1">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </div>
                @enderror
            </div>

            <div class="grid grid-cols-12 mt-5 md:items-center">
                <label for="password"
                    class="col-span-12 md:col-span-2 xl:col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <div class="flex col-span-12 md:col-span-6">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <i class="fa-solid fa-key w-4 h-4 text-gray-500 dark:text-gray-400"></i>

                    </span>
                    <input type="text" id="password" name="password"
                        class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $errors->has('password') ? 'border-red-600' : 'border-gray-300 dark:border-gray-600' }}"
                        placeholder="•••••••••" value="{{ old('password') }}" readonly>
                </div>
                @error('password')
                    <div class="col-span-12 md:col-span-6 mt-1">
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Password awal adalah email dengan tambahan @ di
                depan. Contoh: @2000018327.</p>
            <input type="text" class="hidden" value="aktif" name="status">

            <button type="submit"
                class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        function autofillPassword() {
            const email = emailInput.value.toLowerCase(); // Mengubah huruf menjadi kecil
            if (email) {
                passwordInput.value = `@${email}`;
            }
        }

        emailInput.addEventListener('input', autofillPassword);

        document.addEventListener('DOMContentLoaded', autofillPassword);
    </script>
@endpush
