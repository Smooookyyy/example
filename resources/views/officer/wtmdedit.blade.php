@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md w-fit rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-4">Edit Formulir HHMD</h1>

        @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('officer.wtmd.update', $form->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white p-4" style="width: 210mm; min-height: 297mm;">
                <div id="format" class="mx-auto">
                    <div class="border-t-2 border-x-2 border-black bg-white shadow-md p-4">
                        <div class="flex items-center justify-between">
                            <img src="{{ asset('images/airport-security-logo.png') }}" alt="Logo" class="w-20 h-20">
                            <h1 class="text-xl font-bold text-center flex-grow px-2">
                                CHECK LIST PENGUJIAN HARIAN<br>
                                PENDETEKSI LOGAM GENGGAM<br>
                                (HAND HELD METAL DETECTOR/HHMD)<br>
                                PADA KONDISI NORMAL (HIJAU)
                            </h1>
                            <img src="https://via.placeholder.com/80x80" alt="Additional Logo" class="w-20 h-20">
                        </div>
                    </div>

                    <div class="border-2 border-black bg-white shadow">
                        <table class="w-full text-sm">
                            <tbody>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Nama Operator Penerbangan:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="operatorName" value="{{ old('operatorName', $form->operatorName) }}"
                                            class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Tanggal & Waktu Pengujian:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="datetime-local" name="testDateTime"
                                            value="{{ old('testDateTime', $form->testDateTime->format('Y-m-d\TH:i')) }}"
                                            class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Lokasi Penempatan:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="location" value="{{ old('location', $form->location) }}"
                                            class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Merk/Tipe/Nomor Seri:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="deviceInfo" value="{{ old('deviceInfo', $form->deviceInfo) }}"
                                            class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                                <tr class="border-b border-black">
                                    <th class="w-1/3 text-left p-2">Nomor dan Tanggal Sertifikat:</th>
                                    <td class="w-2/3 p-2">
                                        <input type="text" name="certificateInfo" value="{{ old('certificateInfo', $form->certificateInfo) }}"
                                            class="w-full border rounded px-2 py-1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

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
                                        <input type="radio" name="result" value="pass" {{ old('result', $form->result) == 'pass' ? 'checked' : '' }}>
                                        <label class="text-sm ml-2">PASS</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="result" value="fail" {{ old('result', $form->result) == 'fail' ? 'checked' : '' }}>
                                        <label class="text-sm ml-2">FAIL</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">CATATAN:</label>
                                <textarea name="notes" class="w-full border rounded px-2 py-1" rows="3">{{ old('notes', $form->notes) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Perubahan
                </button>
                <a href="{{ route('officer.dashboard') }}" class="text-gray-600 hover:text-gray-800">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection