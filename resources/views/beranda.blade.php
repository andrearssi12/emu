@extends('layout/app')

@section('content')
    <div>
        <section
            class="h-screen flex bg-center bg-no-repeat bg-cover bg-[url('{{ asset('img/kampus-uad.jpg') }}')] bg-gray-700 bg-blend-multiply">
            <div class="w-full flex justify-center items-center flex-col">
                <h1
                    class="text-center mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    Eco Map Universitas Ahmad Dahlan
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                    How Green Is Your Campus?
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="#"
                        class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Get started
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        <section class="w-full flex flex-col">
            <div class="flex flex-col justify-center items-center py-6 xl:flex-row md:space-x-4 bg-gray-200">
                <div id="map" class="w-full h-[400px] z-0"></div>
                <div class="w-full px-8">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis molestias corrupti illo aliquid
                        delectus,
                        mollitia sit eveniet cupiditate omnis veniam enim eum. Placeat culpa amet asperiores mollitia quam
                        incidunt
                        officiis deserunt enim pariatur, assumenda quo illum velit libero quibusdam minus nemo accusantium
                        ullam.
                        Commodi rerum ea accusantium recusandae libero pariatur voluptatem enim possimus quasi quas! Iste ex
                        dolorum
                        mollitia doloribus, corrupti, quas, quibusdam dolore pariatur ipsa quasi voluptatibus iure nesciunt
                        illo.
                        Molestiae repudiandae veritatis delectus doloribus unde. Quasi fuga quibusdam eius atque minima
                        nesciunt
                        aliquam architecto placeat veritatis! Quidem, praesentium odio magnam dolor placeat nesciunt animi
                        corrupti
                        ratione. Neque, qui?</p>
                </div>
            </div>
            <div class="w-full ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="fill-current text-gray-200">
                    <path fill-opacity="1"
                        d="M0,128L120,144C240,160,480,192,720,192C960,192,1200,160,1320,144L1440,128L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z">
                    </path>
                </svg>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        // Memilih elemen HTML yang ingin Anda pantau perubahan kelasnya
        var elemen = document.getElementById('navbar');

        // Menambahkan event listener untuk mendeteksi scroll
        window.addEventListener('scroll', function() {
            // Mendapatkan posisi scroll vertikal
            var scrollPosition = window.scrollY;

            // Menentukan kondisi untuk mengubah kelas
            if (scrollPosition > 100) { // Misalnya, mengubah kelas saat scroll melebihi 100 piksel
                elemen.classList.add('backdrop-blur-xl');
                elemen.classList.add('bg-black/60');
                elemen.classList.remove('bg-inherit');
            } else {
                elemen.classList.remove('backdrop-blur-xl');
                elemen.classList.remove('bg-black/60');
                elemen.classList.add('bg-inherit');
            }
        });

        var map = L.map('map').setView([-7.833536490400614, 110.38292221929035], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 25,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([-7.83376802838917, 110.3818587332647]).addTo(map);

        var polygon = L.polygon([
            [-7.83376802838917, 110.3818587332647],
            [-7.833867107933756, 110.3819382197563],
            [-7.83396433352309, 110.3820363023413],
            [-7.83406301196269, 110.3821314447397],
            [-7.834139378652091, 110.382220098568],
            [-7.834194353262568, 110.3822700160907],
            [-7.834276899698506, 110.3823373096487],
            [-7.834371693872288, 110.3824060651897],
            [-7.834472944150473, 110.3824768056554],
            [-7.834597711697736, 110.3825255217006],
            [-7.834590311243653, 110.3825779904231],
            [-7.834350085944627, 110.3825481065397],
            [-7.834333585972245, 110.3825781875349],
            [-7.834223017472725, 110.382597004896],
            [-7.834124179379786, 110.3832687901384],
            [-7.833958856402075, 110.3832394685207],
            [-7.834077546818872, 110.3827057775067],
            [-7.833610663548844, 110.3826330213297],
            [-7.833546725501181, 110.3826255999083],
            [-7.83352168358846, 110.3827194656108],
            [-7.833432623100387, 110.3826984946872],
            [-7.833448900570184, 110.3826003158141],
            [-7.833303290536111, 110.3825752614322],
            [-7.833354709088249, 110.3821551317078],
            [-7.833421143544419, 110.3821692071404],
            [-7.833376504273057, 110.3825586065156],
            [-7.83354002866758, 110.3825830538914],
            [-7.833553964579024, 110.3825229514301],
            [-7.833662028168346, 110.3825348782914],
            [-7.83376802838917, 110.3818587332647]
        ]).addTo(map);
    </script>
@endpush
