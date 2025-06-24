<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Card: Total Buku -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
                    <h3 class="text-base font-medium text-gray-600">Total Buku</h3>
                    <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalBooks }}</p>
                </div>

                <!-- Card: User Terverifikasi -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
                    <h3 class="text-base font-medium text-gray-600">User Terverifikasi</h3>
                    <p class="text-4xl font-bold text-green-500 mt-2">{{ $verifiedUsers }}</p>
                </div>

                <!-- Card: User Belum Verifikasi -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 text-center">
                    <h3 class="text-base font-medium text-gray-600">User Belum Verifikasi</h3>
                    <p class="text-4xl font-bold text-red-500 mt-2">{{ $unverifiedUsers }}</p>
                </div>
            </div>

            <!-- Charts Side by Side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pie Chart -->
                <div class="bg-white p-6 shadow-md rounded-xl">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Perbandingan User Terverifikasi</h3>
                    <div class="max-w-xs mx-auto">
                        <canvas id="userPieChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="bg-white p-6 shadow-md rounded-xl">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Jumlah Buku / Hari (7 Hari Terakhir)</h3>
                    <canvas id="bookBarChart" height="100"></canvas>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const pieCtx = document.getElementById('userPieChart').getContext('2d');
        const barCtx = document.getElementById('bookBarChart').getContext('2d');

        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Terverifikasi', 'Belum Verifikasi'],
                datasets: [{
                    data: [{{ $verifiedUsers }}, {{ $unverifiedUsers }}],
                    backgroundColor: ['#4ade80', '#f87171'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($booksPerDay->keys()->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))) !!},
                datasets: [{
                    label: 'Jumlah Buku',
                    data: {!! json_encode($booksPerDay->values()) !!},
                    backgroundColor: '#3b82f6',
                    borderRadius: 5,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
