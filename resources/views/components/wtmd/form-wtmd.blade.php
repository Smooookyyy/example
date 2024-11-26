<div class="bg-white p-4" style="width: 210mm; min-height: 297mm;">
    <div id="format" class="mx-auto">
        <div class="border-t-2 border-x-2 border-black bg-white shadow-md p-4">
            <div class="flex items-center justify-between">
                <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo" class="w-20 h-20">
                <h1 class="text-xl font-bold text-center flex-grow px-2">
                    CHECK LIST PENGUJIAN HARIAN<br>
                    PENDETEKSI LOGAM GENGGAM<br>
                    (WALK THOURGH METAL DETECTOR/WTMD)
                </h1>
                <img src="{{ asset('images/injourney-airports.png') }}" class="w-36 h-28">
            </div>
        </div>
        <form id="wtmdForm" action="{{ route('submit.wtmd') }}" method="POST" enctype="multipart/form-data" onsubmit="onFormSubmit(event)" class="mt-0">
            @csrf
            <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
            <div class="border-2 border-black bg-white shadow">
                <table class="w-full text-sm">
                    <tbody>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="operatorName" class="text-gray-700 font-bold">Nama Operator Penerbangan:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="operatorName" name="operatorName" class="w-full border rounded px-2 py-1" value="Bandar Udara Adisutjipto Yogyakarta" readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="testDateTime" class="text-gray-700 font-bold">Tanggal & Waktu Pengujian:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="datetime-local" id="testDateTime" name="testDateTime" class="w-full border rounded px-2 py-1" readonly>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="location" class="text-gray-700 font-bold">Lokasi Penempatan:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <select id="location" name="location" class="w-full border rounded px-2 py-1">
                                    <option value="">Pilih Lokasi</option>
                                    <option value=" Wtmd Pos Timur"> Wtmd Pos Timur</option>
                                    <option value=" Wtmd PSCP Utara">Wtmd PSCP Utara</option>
                                    <option value=" Wtmd PSCP Selatan">Wtmd PSCP Selatan</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="deviceInfo" class="text-gray-700 font-bold">Merk/Tipe/Nomor Seri:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="deviceInfo" name="deviceInfo" class="w-full border rounded px-2 py-1">
                            </td>
                        </tr>
                        <tr class="border-b border-black">
                            <th class="w-1/3 text-left p-2">
                                <label for="certificateInfo" class="text-gray-700 font-bold">Nomor dan Tanggal Sertifikat:</label>
                            </th>
                            <td class="w-2/3 p-2">
                                <input type="text" id="certificateInfo" name="certificateInfo" class="w-full border rounded px-2 py-1">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mx-10 my-4">
                    <div class="mb-3">
                        <div class="flex items-center mb-2">
                            <svg class="h-5 w-5 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <polyline points="9 11 12 14 15 10"></polyline>
                            </svg>
                            <span class="ml-3 text-gray-700 text-sm font-bold">:</span>
                            <label for="fulfilled" class="ml-2 text-sm">Terpenuhi</label>
                        </div>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-black" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" />
                                <path fill="white" d="M6.41 6L12 11.59L17.59 6L19 7.41L13.41 13L19 18.59L17.59 20L12 14.41L6.41 20L5 18.59L10.59 13L5 7.41L6.41 6Z" />
                            </svg>
                            <span class="ml-3 text-gray-700 text-sm font-bold">:</span>
                            <label for="unfulfilled" class="ml-2 text-sm">Tidak Terpenuhi</label>
                        </div>
                    </div>
                </div>
                <div class="border-t-2 border-x-2 border-black mx-10">
                    <div class="flex flex-row">
                        <div class="flex-1 relative mr-2 mt-8 mb-12">
                            <img src="/images/tampakdepan.png" alt="Tampak Depan" class="absolute inset-0 w-full h-full object-contain z-0">
                            <div class="relative z-10 h-96 flex flex-col justify-center">
                                <div class="flex flex-col space-y-2 mx-5 mt-10">
                                    <div class="flex items-center">
                                        <div class="flex flex-col">
                                            <div class="flex items-center mb-1">
                                                <label for="resultPassIntest1" class="mr-5 ml-2">IN</label>
                                                <input type="checkbox" id="resultPassIntest1" name="resultPassIntest1" class="form-checkbox h-5 w-5" onchange="updateResult()" value="1">
                                            </div>
                                            <div class="flex items-center mb-1">
                                                <label for="resultPassOuttest1" class="mr-3">OUT</label>
                                                <input type="checkbox" id="resultPassOuttest1" name="resultPassOuttest1" class="form-checkbox h-5 w-5" onchange="updateResult()" value="1">
                                            </div>
                                        </div>
                                        <div class="mx-4 transform rotate-180">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                        </div>
                                        <span class="font-bold">TEST 1</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex flex-col mt-1">
                                            <div class="flex items-center mb-1">
                                                <label for="resultPassIntest2" class="mr-5 ml-2">IN</label>
                                                <input type="checkbox" id="resultPassIntest2" name="resultPassIntest2" value="1" class="form-checkbox h-5 w-5 text-blue-600">
                                            </div>
                                            <div class="flex items-center mb-1">
                                                <label for="resultPassOuttest2" class="mr-3">OUT</label>
                                                <input type="checkbox" id="resultPassOuttest2" name="resultPassOuttest2" value="1" class="form-checkbox h-5 w-5 text-blue-600">
                                            </div>
                                        </div>
                                        <div class="mx-4 transform rotate-180 mt-1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                        </div>
                                        <span class="font-bold mt-1">TEST 2</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex flex-col mt-10">
                                            <div class="flex items-center mb-1">
                                                <label for="resultPassIntest4" class="mr-5 ml-2">IN</label>
                                                <input type="checkbox" id="resultPassIntest4" name="resultPassIntest4" value="1" class="form-checkbox h-5 w-5">
                                            </div>
                                            <div class="flex items-center mb-1">
                                                <label for="resultPassOuttest4" class="mr-3">OUT</label>
                                                <input type="checkbox" id="resultPassOuttest4" name="resultPassOuttest4" value="1" class="form-checkbox h-5 w-5">
                                            </div>
                                        </div>
                                        <div class="mx-4 transform rotate-180 mt-10">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                            </svg>
                                        </div>
                                        <span class="font-bold mt-10">TEST 4</span>
                                    </div>
                                    <div class="absolute inset-x-0 -bottom-8 ml-2">
                                        <p class="text-center text-black font-semibold">DEPAN</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 relative ml-2 mt-8 mb-12">
                            <img src="/images/tampakbelakang.png" alt="Tampak Belakang" class="absolute inset-0 w-full h-full object-contain z-0">
                            <div class="relative z-10 h-96 flex">
                                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 flex flex-col space-y-4 pr-4">
                                    <div class="flex items-center">
                                        <span class="mr-4 font-bold">TEST 3</span>
                                        <svg class="w-6 h-6 mr-4 transform-rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        <div class="flex flex-col">
                                            <div class="flex items-center mb-1">
                                                <input type="checkbox" id="resultPassIntest3" name="resultPassIntest3" value="1" class="form-checkbox h-5 w-5 text-blue-600">
                                                <label for="resultPassIntest3" class="ml-5">IN</label>
                                            </div>
                                            <div class="flex items-center mb-1">
                                                <input type="checkbox" id="resultPassOuttest3" name="resultPassOuttest3" value="1" class="form-checkbox h-5 w-5 text-blue-600">
                                                <label for="resultPassOuttest3" class="ml-3">OUT</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute inset-x-0 -bottom-8 mr-1">
                                    <p class="text-center text-black font-semibold">BELAKANG</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t-2 border-black p-4">
                    <div class="flex items-start mb-2">
                        <label class="text-gray-700 font-bold mr-4">Hasil:</label>
                        <div class="flex flex-col">
                            <div class="flex items-center mb-0">
                                <input type="radio" id="resultPass" name="result" value="pass" class="form-radio" onclick="document.getElementById('result').value='pass'">
                                <label for="resultPass" class="text-sm ml-2">PASS</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="resultFail" name="result" value="fail" class="form-radio" onclick="document.getElementById('result').value='fail'">
                                <label for="resultFail" class="text-sm ml-2">FAIL</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="notes" class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                        <textarea id="notes" name="notes" class="w-full border rounded px-2 py-1" rows="2"></textarea>
                    </div>
                </div>

                <input type="hidden" id="result" name="result" value="">

                <div class="border-t-2 border-black p-4">
                    <h3 class="text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="grid grid-rows-2 gap-2 items-center">
                            <div class="text-center self-end">
                                <h4 class="font-bold">
                                    @if(Auth::guard('officer')->check())
                                    {{ Auth::guard('officer')->user()->name }}
                                    @else
                                    {{ Auth::user()->name }}
                                    @endif
                                </h4>
                                <label for="securityOfficerSignature" class="text-gray-700 font-normal">1. Airport Security Officer</label>
                            </div>
                            <div class="text-center self-end">
                                <label for="securitySupervisorSignature" class="text-gray-700 font-normal">2. Airport Security Supervisor</label>
                            </div>
                        </div>
                        <div>
                            <!-- Kolom Kanan (Canvas dan Tombol Clear) -->
                            <div class="flex flex-col items-start">
                                <canvas class="border border-black rounded-md" id="signatureCanvas" width="200" height="100"></canvas>
                                <div class="mt-2 flex items-start">
                                    <button type="button" id="clearSignature" class="bg-slate-200 border border-black text-black px-4 py-2 rounded w-20">Clear</button>
                                    <button type="button" id="saveOfficerSignature" class="bg-slate-200 border border-black text-black px-4 py-2 rounded ml-2 w-20">Save</button>
                                </div>
                                <input type="hidden" name="officer_signature_data" id="officerSignatureData">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="status" value="pending_supervisor">

            <div class="mt-4">
                <div class="mb-4">
                    <label for="supervisor_id" class="block text-gray-700 font-bold mb-2">Pilih Supervisor:</label>
                    <select name="supervisor_id" id="supervisor_id" class="w-full border rounded px-2 py-1" required>
                        <option value="">Pilih Supervisor</option>
                        @foreach(\App\Models\User::where('role', 'supervisor')->get() as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        Submit to Approver
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>