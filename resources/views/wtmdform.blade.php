@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-2">
    <div class="bg-gradient-to-r from-white to-gray-50 shadow-lg rounded-xl px-8 pt-8 pb-10 mb-6">
        <!-- Header Section -->
        <div class="text-left mb-8">
            <h1
                class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-600 mb-4">
                Formulir WTMD
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Silakan pilih jenis formulir WTMD
            </p>
        </div>

        <!-- Grid Layout for X-ray Forms -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- WTMD pos timur Card -->
            <div onclick="window.location.href='{{ route('wtmdpostimur.index', ['location' => 'Wtmd Pos Timur']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                @if ($pendingCounts['Wtmd Pos Timur'] > 0)
                <div
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                    {{ $pendingCounts['Wtmd Pos Timur'] }}
                </div>
                @endif

                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer border border-gray-100 relative group flex flex-col justify-between hover:ring-2 hover:ring-blue-500 hover:ring-offset-2">
                    <div
                        class="bg-blue-50 p-4 rounded-full mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-blue-500 group-hover:text-blue-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        </button>
                    </div>
                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-blue-700 transition-colors duration-300">
                        Form WTMD Pos Timur
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['Wtmd Pos Timur'] > 0)
                        <span class="text-red-500 font-semibold">
                            {{ $pendingCounts['Wtmd Pos Timur'] }} Formulir Menunggu
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        @else
                        <span class="text-blue-500 hover:text-blue-700 font-medium">
                            Buka Form
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-blue-500 group-hover:text-blue-700 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        @endif
                    </div>
                </div>
            </div>


            <!-- Pos wtmd pscp utara Card -->
            <div onclick="window.location.href='{{ route('wtmdpscputara.index', ['location' => 'Wtmd PSCP Utara']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                <!-- Pending Forms Tab -->
                @if ($pendingCounts['Wtmd PSCP Utara'] > 0)
                <div
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                    {{ $pendingCounts['Wtmd PSCP Utara'] }}
                </div>
                @endif

                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer border border-gray-100 relative group flex flex-col justify-between hover:ring-2 hover:ring-blue-500 hover:ring-offset-2">
                    <div
                        class="bg-sky-50 p-4 rounded-full mb-4 group-hover:bg-sky-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-sky-500 group-hover:text-sky-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>

                    <!-- Tombol untuk Unduh PDF Gabungan -->
                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-sky-700 transition-colors duration-300">
                        Form WTMD Pscp Utara
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['Wtmd PSCP Utara'] > 0)
                        <span class="text-red-500 font-semibold">
                            {{ $pendingCounts['Wtmd PSCP Utara'] }} Formulir Menunggu
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        @else
                        <span class="text-sky-500 hover:text-sky-700 font-medium">
                            Buka Form
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-sky-500 group-hover:text-sky-700 transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        @endif
                    </div>
                </div>
            </div>
            <!-- wtmd pscp selatan Form Card -->
            <div onclick="window.location.href='{{ route('wtmdpscpselatan.index', ['location' => 'Wtmd PSCP Selatan']) }}'"
                class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100 relative group">

                @if ($pendingCounts['Wtmd PSCP Selatan'] > 0)
                <div
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold shadow-md animate-pulse">
                    {{ $pendingCounts['Wtmd PSCP Selatan'] }} Formulir Menunggu
                </div>
                @endif

                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer border border-gray-100 relative group flex flex-col justify-between hover:ring-2 hover:ring-blue-500 hover:ring-offset-2">
                    <div
                        class="bg-blue-50 p-4 rounded-full mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-blue-500 group-hover:text-blue-600 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2
                        class="text-2xl font-bold text-gray-800 mb-3 group-hover:text-blue-700 transition-colors duration-300">
                        Form WTMD Pscp Selatan
                    </h2>

                    <div class="flex items-center space-x-2">
                        @if ($pendingCounts['Wtmd PSCP Selatan'] > 0)
                        <span class="text-red-500 font-semibold">
                            {{ $pendingCounts['Wtmd PSCP Selatan'] }} Formulir Menunggu
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        @else
                        <span class="text-blue-500 hover:text-blue-700 font-medium">
                            Buka Form
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-blue-500 group-hover:text-blue-700 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- @section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('bg-blue-600', 'text-white');
                    t.classList.add('text-gray-600', 'hover:text-gray-800', 'hover:bg-gray-100');
                });
                // Hide all tab contents
                tabContents.forEach(content => content.classList.add('hidden'));

                // Activate the clicked tab
                tab.classList.add('bg-blue-600', 'text-white');
                tab.classList.remove('text-gray-600', 'hover:text-gray-800', 'hover:bg-gray-100');

                // Show the corresponding tab content
                const contentId = tab.getAttribute('onclick').match(/'([^']+)'/)[1] + '-content';
                document.getElementById(contentId).classList.remove('hidden');
            });
        });
        // Set initial active tab
        document.getElementById('tab-pending').click();
        // Dropdown filter toggle
        const filterButton = document.getElementById('filterButton');
        const filterDropdown = document.getElementById('filterDropdown');

        // Close the filter dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!filterButton.contains(e.target) && !filterDropdown.contains(e.target)) {
                filterDropdown.classList.add('hidden');
            }
        });

        // Date filter form submission
        const dateFilterForm = document.getElementById('dateFilterForm');
        dateFilterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            if (!startDate || !endDate) {
                alert('Harap isi tanggal mulai dan akhir.');
                return;
            }
            dateFilterForm.submit();
            // Example: sending data via AJAX
            fetch(dateFilterForm.action, {
                    method: 'POST',
                    body: new FormData(dateFilterForm),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Handle the response
                    alert('Filter diterapkan. Silakan perbarui data di tabel.');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menerapkan filter.');
                });
        });
    });
</script>
@endsection -->