@extends('layout.app')

@push('stylesheet')
    @vite('resources/css/map/mapbox-gl.css')
@endpush

@section('content')
    <div class="row gap-4 md:gap-0">
        <div class="col-12 md:col-4">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700">
                    <i class="fa fa-regular fa-user text-blue-500 text-xl"></i>
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
                    <i class="fa fa-regular fa-map text-blue-500 text-xl"></i>
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
                    <i class="fa fa-regular fa-square text-blue-500  text-xl"></i>
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

    <div class="row mt-6 gap-4 md:gap-0">
        <div class="col-12 md:col-8 order-2 md:order-1">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-center items-center">
                    <div id="chart2" class="w-full"></div>
                </div>
            </div>
        </div>
        <div class="col-12 md:col-4 order-1 md:order-2">
            <div
                class="p-6 h-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-auto">
                <h4 class="mb-4 font-bold tracking-tight text-gray-900 dark:text-white">Proporsi: Hijau &lt; 30% </h4>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Kampus
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Proporsi (%)
                            </th>
                        </tr>
                    </thead>
                    <tbody id="proporsi-list"
                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex w-full mt-6">
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h4 class="mb-4 font-bold tracking-tight text-gray-900 text-center dark:text-white">Persebaran Kawasan Hijau
            </h4>
            <div id="map" class="w-full h-[360px] md:h-[500px] rounded-md"></div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/map/mapbox-gl.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to get the current theme
            function getCurrentTheme() {
                return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            }

            // Function to set chart options based on the theme
            function getChartOptions(theme, proporsiValues, kampusNames) {
                var textColor, gridColor;
                if (theme === 'dark') {
                    textColor = '#FFFFFF';
                    gridColor = '#374151';
                } else {
                    textColor = '#000000';
                    gridColor = '#e0e0e0';
                }

                return {
                    chart: {
                        type: 'bar',
                        height: 350,
                        width: '100%',
                        background: theme === 'dark' ? '#1f2937' : '#FFFFFF'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '50%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val + "%";
                        },
                        style: {
                            colors: [textColor]
                        }
                    },
                    series: [{
                        name: 'Proporsi Kawasan Hijau',
                        data: proporsiValues
                    }],
                    xaxis: {
                        categories: kampusNames,
                        title: {
                            text: 'Kampus',
                            style: {
                                color: textColor
                            }
                        },
                        labels: {
                            style: {
                                colors: textColor
                            }
                        },
                        axisBorder: {
                            color: textColor
                        },
                        axisTicks: {
                            color: textColor
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Proporsi Kawasan Hijau (%)',
                            style: {
                                color: textColor
                            }
                        },
                        labels: {
                            style: {
                                colors: textColor
                            }
                        },
                        axisBorder: {
                            color: textColor
                        },
                        axisTicks: {
                            color: textColor
                        }
                    },
                    grid: {
                        borderColor: gridColor
                    },
                    title: {
                        text: 'Proporsi Luas Kawasan Hijau',
                        align: 'center',
                        style: {
                            color: textColor
                        }
                    },
                    legend: {
                        labels: {
                            colors: [textColor]
                        }
                    }
                };
            }

            // Fetch the data
            fetch('/proporsi-luas-kawasan-hijau')
                .then(response => response.json())
                .then(data => {
                    // Get the list container
                    const listContainer = document.getElementById('proporsi-list');

                    // Extract kampus names and proportions
                    const kampusNames = data.map(item => item.nama_kampus);
                    const proporsiValues = data.map(item => parseFloat(item.proporsi_luas_kawasan_hijau)
                        .toFixed(2));

                    // Filter data to get proporsi less than 30%
                    const filteredData = data.filter(item => parseFloat(item.proporsi_luas_kawasan_hijau) < 30);

                    // Sort data by proporsi from smallest to largest
                    filteredData.sort((a, b) => parseFloat(a.proporsi_luas_kawasan_hijau) - parseFloat(b
                        .proporsi_luas_kawasan_hijau));

                    // Create table rows for each filtered data
                    filteredData.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">${item.nama_kampus}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${parseFloat(item.proporsi_luas_kawasan_hijau).toFixed(2)}%</td>
                        `;
                        listContainer.appendChild(row);
                    });

                    // Get the current theme and set the chart options
                    var currentTheme = getCurrentTheme();
                    var options = getChartOptions(currentTheme, proporsiValues, kampusNames);

                    // Render the chart
                    const chart = new ApexCharts(document.querySelector("#chart2"), options);
                    chart.render();

                    // Listen for theme changes
                    document.addEventListener('dark-mode', function() {
                        currentTheme = getCurrentTheme();
                        options = getChartOptions(currentTheme, proporsiValues, kampusNames);
                        chart.updateOptions(options);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
@endpush
