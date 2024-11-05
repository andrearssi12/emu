@extends('layout.app')

@section('content')
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li aria-current="page" class="inline-flex items-center">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                </svg>
                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Dashboard</span>
            </li>
        </ol>
    </nav>

    <div class="row mt-4 gap-4 md:gap-0">
        <div class="col-12 md:col-4">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <i class="fa fa-regular fa-user text-primary-500 dark:text-white text-xl"></i>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <span class="text-sm font-medium dark:text-white">Total Pengguna Aktif</span>
                    </div>
                    <h4 class="font-bold dark:text-white">0.43%</h4>
                </div>
            </div>
        </div>
        <div class="col-12 md:col-4">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <i class="fa fa-regular fa-map text-primary-500 dark:text-white text-xl"></i>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <span class="text-sm font-medium dark:text-white">Total Kawasan Hijau</span>
                    </div>
                    <h4 class="font-bold dark:text-white">0.43%</h4>
                </div>
            </div>
        </div>
        <div class="col-12 md:col-4">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <i class="fa fa-regular fa-square text-primary-500 dark:text-white text-xl"></i>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <span class="text-sm font-medium dark:text-white">Luas Kawasan Hijau</span>
                    </div>
                    <h4 class="font-bold dark:text-white">0.43%</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 gap-4 md:gap-0">
        <div class="col-12 md:col-6">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h4 class="mb-4 font-bold tracking-tight text-gray-900 dark:text-white">Total Kawasan Hijau Tiap Kampus
                </h4>
                <div class="flex justify-center items-center">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-12 md:col-6">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h4 class="mb-4 font-bold tracking-tight text-gray-900 dark:text-white">Luas Kawasan Hijau Tiap Kampus
                </h4>
                <div class="flex justify-center items-center">
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 md:col-8">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h4 class="mb-4 font-bold tracking-tight text-gray-900 dark:text-white">Luas Kawasan Hijau Tiap Kampus
                </h4>
                <div class="flex justify-center items-center">
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
        <div class="col-12 md:col-4">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h4 class="mb-4 font-bold tracking-tight text-gray-900 dark:text-white">Luas Kawasan Hijau Tiap Kampus
                </h4>
                <div class="flex justify-center items-center">
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to set chart options based on the theme
            function getChartOptions() {
                var colors, textColors, borderColor;
                if (document.documentElement.classList.contains('dark')) {
                    colors = ['#FF4560', '#00E396', '#FEB019', '#775DD0', '#546E7A'];
                    textColors = ['#FFFFFF', '#FFFFFF', '#FFFFFF', '#FFFFFF', '#FFFFFF'];
                    borderColor = '#1f2937';
                } else {
                    colors = ['#FF4560', '#00E396', '#FEB019', '#775DD0', '#546E7A'];
                    textColors = ['#000000', '#000000', '#000000', '#000000', '#000000'];
                    borderColor = '#FFFFFF';
                }

                return {
                    series: [44, 55, 13, 43, 22],
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                    colors: colors,
                    stroke: {
                        show: true,
                        width: 2,
                        colors: [borderColor]
                    },
                    legend: {
                        labels: {
                            colors: textColors // Warna teks legend
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
            }

            var options = getChartOptions();

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();
            chart2.render();

            document.addEventListener('dark-mode', function() {
                options = getChartOptions();
                chart.updateOptions(options);
                chart2.updateOptions(options);
            });
        });
    </script>
@endpush
