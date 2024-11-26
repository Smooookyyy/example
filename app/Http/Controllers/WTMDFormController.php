<?php

namespace App\Http\Controllers;

use App\Models\wtmdsaved;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class WTMDFormController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Received WTMD data:', $request->all());

        $validatedData = $request->validate([
            'operatorName' => 'required|string',
            'testDateTime' => 'required|date',
            'location' => 'required|string',
            'deviceInfo' => 'required|string',
            'certificateInfo' => 'required|string',
            'resultPassIntest1' => 'nullable|boolean',
            'resultPassOuttest1' => 'nullable|boolean',
            'resultPassIntest2' => 'nullable|boolean',
            'resultPassOuttest2' => 'nullable|boolean',
            'resultPassIntest3' => 'nullable|boolean',
            'resultPassOuttest3' => 'nullable|boolean',
            'resultPassIntest4' => 'nullable|boolean',
            'resultPassOuttest4' => 'nullable|boolean',
            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending_supervisor,approved,rejected',
            'officer_signature' => 'nullable|string',
            'supervisor_signature' => 'nullable|string',
            'supervisor_id' => 'required|exists:users,id,role,supervisor',
        ]);

        $validatedData['resultPassIntest1'] = $request->has('resultPassIntest1');
        $validatedData['resultPassOuttest1'] = $request->has('resultPassOuttest1');
        $validatedData['resultPassIntest2'] = $request->has('resultPassIntest2');
        $validatedData['resultPassOuttest2'] = $request->has('resultPassOuttest2');
        $validatedData['resultPassIntest3'] = $request->has('resultPassIntest3');
        $validatedData['resultPassOuttest3'] = $request->has('resultPassOuttest3');
        $validatedData['resultPassIntest4'] = $request->has('resultPassIntest4');
        $validatedData['resultPassOuttest4'] = $request->has('resultPassOuttest4');
        // Menyimpan data tanda tangan jika ada
        if ($request->has('officer_signature_data')) {
            $validatedData['officer_signature'] = $request->input('officer_signature_data'); // Simpan tanda tangan officer
        }

        if ($request->has('supervisor_signature_data')) {
            $validatedData['supervisor_signature'] = $request->input('supervisor_signature_data'); // Simpan tanda tangan supervisor
        }

        $wtmdsave = new wtmdsaved($validatedData);
        if (Auth::guard('web')->check()) {
            $wtmdsave->submitted_by = Auth::guard('web')->id();
            $wtmdsave->officerName = Auth::user()->name;
        } elseif (Auth::guard('officer')->check()) {
            $wtmdsave->submitted_by = Auth::guard('officer')->id();
            $wtmdsave->officerName = Auth::guard('officer')->user()->name;
        } else {
            return redirect()->back()->with('error', 'Anda harus login untuk mengirimkan formulir ini.');
        }
        $wtmdsave->supervisor_id = $validatedData['supervisor_id'];

        try {
            $wtmdsave->save();
            return redirect()->route('officer.dashboard')->with('success', 'WTMD data berhasil disimpan dan menunggu persetujuan supervisor.');
        } catch (\Exception $e) {
            Log::error('Error saving WTMD data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        } // ... implementasi lainnya mirip dengan HHMDFormController
    }
    public function review($id)
    {
        $form = wtmdsaved::findOrFail($id);
        $supervisor = User::find($form->supervisor_id);

        return view('review.wtmd.reviewwtmd', compact('form', 'supervisor'));
    }

    public function updateStatus(Request $request, $id)
    {
        $form = wtmdsaved::findOrFail($id);

        // Validasi input
        $request->validate([
            'status' => 'required|in:pending_supervisor,approved,rejected',
            'rejection_note' => 'required_if:status,rejected|nullable|string',
            'supervisor_signature_data' => 'nullable|string',
        ]);

        // Update status dan data review
        $form->status = $request->status;
        $form->reviewed_at = now();
        $form->reviewed_by = Auth::id();
        // Jika ditolak, simpan catatan penolakan
        if ($request->status === 'rejected') {
            $form->rejection_note = $request->rejection_note;
        }
        // Jika disetujui
        if ($request->status === 'approved') {
            $form->supervisorName = Auth::user()->name;
            // Simpan tanda tangan supervisor jika ada
            if ($request->has('supervisor_signature_data')) {
                $form->supervisor_signature = $request->supervisor_signature_data;
            }
        }
        try {
            $form->save();

            $message = $request->status === 'rejected'
                ? 'Form ditolak dan catatan telah disimpan.'
                : 'Form berhasil disetujui!';

            return redirect()->route('dashboard')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error updating WTMD status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status.');
        }
    }
    public function saveSupervisorSignature(Request $request, $id)
    {
        $form = wtmdsaved::findOrFail($id);
        $request->validate([
            'signature' => 'required|string',
        ]);
        $form->supervisor_signature = $request->signature;
        $form->supervisorName = Auth::user()->name;
        $form->save();
        return response()->json(['success' => true]);
    }
    public function create()
    {
        return view('officer.wtmd.create');
    }
    public function edit($id)
    {
        $form = wtmdsaved::findOrFail($id);
        // Pastikan officer hanya bisa edit formnya sendiri
        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke form ini');
        }
        return view('officer.wtmdedit', compact('form'));
    }
    public function update(Request $request, $id)
    {
        $form = wtmdsaved::findOrFail($id);
        // Validasi akses
        if ($form->submitted_by !== Auth::guard('officer')->id()) {
            return redirect()->route('officer.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke form ini');
        }


        $validatedData = $request->validate([
            'operatorName' => 'required|string',
            'testDateTime' => 'required|date',
            'location' => 'required|string',
            'deviceInfo' => 'required|string',
            'certificateInfo' => 'required|string',
            'resultPassIntest1' => 'nullable|boolean',
            'resultPassOuttest1' => 'nullable|boolean',
            'resultPassIntest2' => 'nullable|boolean',
            'resultPassOuttest2' => 'nullable|boolean',
            'resultPassIntest3' => 'nullable|boolean',
            'resultPassOuttest3' => 'nullable|boolean',
            'resultPassIntest4' => 'nullable|boolean',
            'resultPassOuttest4' => 'nullable|boolean',
            'result' => 'required|in:pass,fail',
            'notes' => 'nullable|string',
        ]);
        try {
            // Ubah nilai checkbox menjadi boolean
            $validatedData['resultPassIntest1'] = $request->has('resultPassIntest1');
            $validatedData['resultPassOuttest1'] = $request->has('resultPassOuttest1');
            $validatedData['resultPassIntest2'] = $request->has('resultPassIntest2');
            $validatedData['resultPassOuttest2'] = $request->has('resultPassOuttest2');
            $validatedData['resultPassIntest3'] = $request->has('resultPassIntest3');
            $validatedData['resultPassOuttest3'] = $request->has('resultPassOuttest3');
            $validatedData['resultPassIntest4'] = $request->has('resultPassIntest4');
            $validatedData['resultPassOuttest4'] = $request->has('resultPassOuttest4');


            // Set status ke pending_supervisor
            $validatedData['status'] = 'pending_supervisor';
            $form->update($validatedData);
            $form->status = 'pending_supervisor'; // Reset status ke pending
            $form->save();
            return redirect()->route('officer.dashboard')
                ->with('success', 'Form berhasil diperbarui dan menunggu review ulang');
        } catch (\Exception $e) {
            Log::error('Error updating WTMDform: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui form');
        }
    }
}   
