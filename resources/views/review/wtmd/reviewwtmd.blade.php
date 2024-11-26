@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md w-fit rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">Tinjau Formulir WTMD</h1>

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

                <div class="border-2 border-black bg-white shadow">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">
                                    <label for="operatorName" class="text-gray-700 font-bold">Nama Operator Penerbangan:</label>
                                </th>
                                <td class="w-2/3 p-2">{{ $form->operatorName }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">
                                    <label for="testDateTime" class="text-gray-700 font-bold">Tanggal & Waktu Pengujian:</label>
                                </th>
                                <td class="w-2/3 p-2">{{ date('d-m-Y H:i', strtotime($form->testDateTime)) }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">
                                    <label for="location" class="text-gray-700 font-bold">Lokasi Penempatan:</label>
                                </th>
                                <td class="w-2/3 p-2">{{ $form->location }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">
                                    <label for="deviceInfo" class="text-gray-700 font-bold">Merk/Tipe/Nomor Seri:</label>
                                </th>
                                <td class="w-2/3 p-2">{{ $form->deviceInfo }}</td>
                            </tr>
                            <tr class="border-b border-black">
                                <th class="w-1/3 text-left p-2">
                                    <label for="certificateInfo" class="text-gray-700 font-bold">Nomor dan Tanggal Sertifikat:</label>
                                </th>
                                <td class="w-2/3 p-2">{{ $form->certificateInfo }}</td>
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
                                                    <input type="checkbox" {{ $form->resultPassIntest1 ? 'checked' : '' }} disabled>
                                                </div>
                                                <div class="flex items-center mb-1">
                                                    <label for="resultPassOuttest1" class="mr-3">OUT</label>
                                                    <input type="checkbox" {{ $form->resultPassOuttest1 ? 'checked' : '' }} disabled>
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
                                                    <input type="checkbox" {{ $form->resultPassIntest2 ? 'checked' : '' }} disabled>
                                                </div>
                                                <div class="flex items-center mb-1">
                                                    <label for="resultPassOuttest2" class="mr-3">OUT</label>
                                                    <input type="checkbox" {{ $form->resultPassOuttest2 ? 'checked' : '' }} disabled>
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
                                                    <input type="checkbox" {{ $form->resultPassIntest4 ? 'checked' : '' }} disabled>
                                                </div>
                                                <div class="flex items-center mb-1">
                                                    <label for="resultPassOuttest4" class="mr-3">OUT</label>
                                                    <input type="checkbox" {{ $form->resultPassOuttest4 ? 'checked' : '' }} disabled>
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
                                                    <input type="checkbox" {{ $form->resultPassIntest3 ? 'checked' : '' }} disabled>
                                                    <label for="resultPassIntest3" class="ml-5">IN</label>
                                                </div>
                                                <div class="flex items-center mb-1">
                                                    <input type="checkbox" {{ $form->resultPassOuttest3 ? 'checked' : '' }} disabled>
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
                                    <input type="radio" {{ $form->result == 'pass' ? 'checked' : '' }} disabled>
                                    <label for="resultPass" class="text-sm ml-2">PASS</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" {{ $form->result == 'fail' ? 'checked' : '' }} disabled>
                                    <label for="resultFail" class="text-sm ml-2">FAIL</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="notes" class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                            <p>{{ $form->notes }}</p>
                        </div>
                    </div>

                    <div class="border-t-2 border-black p-4">
                        <h3 class="text-sm font-bold mb-2">Personel Pengamanan Penerbangan</h3>
                        <div class="grid grid-cols-2 gap-4">
                        <div class="grid grid-rows-2 gap-2 items-center">
                                <div class="text-center self-end">
                                    <h4 class="font-bold">{{ $form->officerName }}</h4>
                                    <label class="text-gray-700 font-normal">1. Airport Security Officer</label>
                                </div>
                                <div class="text-center self-end">
                                    <h4 class="font-bold">
                                        @if($supervisor)
                                            {{ $supervisor->name }}
                                        @else
                                            Nama Supervisor tidak tersedia
                                        @endif
                                    </h4>
                                    <label class="text-gray-700 font-normal">2. Airport Security Supervisor</label>
                                </div>
                            </div>
                            <div>
                                <div class="flex flex-col items-center">
                                    @if($form->officer_signature)
                                    <img src="{{ $form->officer_signature }}" alt="Tanda tangan Officer">
                                    @else
                                    <p>Tanda tangan Officer tidak tersedia</p>
                                    @endif
                                </div>
                                <div class="flex flex-col items-center">
                                    @if($form->supervisor_signature)
                                    <img src="{{ $form->supervisor_signature }}" alt="Tanda tangan Supervisor" id="supervisorSignatureImage">
                                    @else
                                    <p>Tanda tangan Supervisor tidak tersedia</p>
                                    @endif
                                </div>
                                <!-- Canvas untuk Tanda Tangan Supervisor -->
                                @if(!$form->supervisor_signature)
                                <div class="flex flex-col items-center mt-4" id="signatureContainer">
                                    <h3 class="text-sm font-bold mb-2">Tanda Tangan Supervisor</h3>
                                    <canvas id="signatureCanvas" width="300" height="150" style="border: 1px solid #000;"></canvas>
                                    <div class="mt-2">
                                        <button type="button" id="clearSignature" class="bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                                        <button type="button" id="saveSupervisorSignature" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Save</button>
                                    </div>
                                    <input type="hidden" name="supervisor_signature_data" id="supervisorSignatureData">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <form action="{{ route('wtmd.updateStatus', $form->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select name="status" id="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="approved">Setujui</option>
                    <option value="rejected">Tolak</option>
                </select>
            </div>
            <div id="rejectionNoteContainer" class="mb-4 hidden">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="rejection_note">
                    Catatan Penolakan
                </label>
                <textarea
                    name="rejection_note"
                    id="rejection_note"
                    rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Masukkan alasan penolakan..."></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Perbarui Status
                </button>
                <a href="{{ route('dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const rejectionNoteContainer = document.getElementById('rejectionNoteContainer');
        const rejectionNoteTextarea = document.getElementById('rejection_note');
        statusSelect.addEventListener('change', function() {
            if (this.value === 'rejected') {
                rejectionNoteContainer.classList.remove('hidden');
                // Tambahkan validasi bahwa catatan harus diisi
                rejectionNoteTextarea.setAttribute('required', 'required');
            } else {
                rejectionNoteContainer.classList.add('hidden');
                rejectionNoteTextarea.removeAttribute('required');
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0; // Menyimpan posisi X terakhir
        let lastY = 0; // Menyimpan posisi Y terakhir

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        document.getElementById('clearSignature').addEventListener('click', clearCanvas);
        document.getElementById('saveSupervisorSignature').addEventListener('click', saveSupervisorSignature);

        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY]; // Menggunakan offsetX dan offsetY
            draw(e);
        }

        function draw(e) {
            if (!isDrawing) return;
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            ctx.beginPath();
            ctx.moveTo(lastX, lastY); // Menggunakan posisi terakhir
            ctx.lineTo(e.offsetX, e.offsetY); // Menggunakan offsetX dan offsetY
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY]; // Memperbarui posisi terakhir
        }

        function stopDrawing() {
            isDrawing = false;
            ctx.beginPath();
        }

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSupervisorSignature() {
            const supervisorSignatureData = canvas.toDataURL('image/png');
            document.getElementById('supervisorSignatureData').value = supervisorSignatureData;

            // Menampilkan tanda tangan yang disimpan
            const signatureContainer = document.getElementById('signatureContainer');
            signatureContainer.innerHTML = `
                <h3 class="text-sm font-bold mb-2">Tanda Tangan Supervisor</h3>
                <img src="${supervisorSignatureData}" alt="Tanda tangan Supervisor" id="supervisorSignatureImage">
            `;

            // Mengirim data tanda tangan ke server
            fetch('{{ route("wtmd.saveSupervisorSignature", $form->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    signature: supervisorSignatureData
                })
            })
        }
    });
</script>
@endsection