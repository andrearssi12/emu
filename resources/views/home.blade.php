@extends('layout/app')

@section('content')

<section class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply mb-4">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
            Eco Map Universitas Ahmad Dahlan
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
            How Green Is Your Campus?
        </p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Get started
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<div class="columns-2">
    <div id="map"></div>
    <div>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis beatae voluptate expedita eos, quidem adipisci asperiores sed assumenda nostrum eum? Veritatis nobis quod suscipit assumenda eos voluptas quia voluptatibus nulla obcaecati ratione totam in maxime excepturi vel iusto quisquam tempora mollitia repudiandae facilis alias asperiores error, maiores quaerat! Omnis, aspernatur nobis, accusamus eligendi aperiam quaerat unde iure dignissimos ipsam deleniti sit magnam illum facilis repellendus tempora quibusdam et ex exercitationem inventore. Aliquam, libero. Facilis tempore quisquam fugit explicabo saepe quas consectetur quis eos quo ipsa, animi quidem voluptas ipsam recusandae magnam odio nostrum suscipit veniam incidunt omnis. Ab, illum ipsam?
        </p>
    </div>

</div>

@endsection

@push('scripts')
<script>
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
</script>

@endpush