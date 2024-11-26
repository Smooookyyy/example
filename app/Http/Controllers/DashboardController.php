<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hhmdsaved;
use App\Models\wtmdsaved;
use App\Models\xraysaved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendingHhmdForms = collect();
        $pendingWtmdForms = collect();
        $pendingXrayForms = collect();

        if ($user->role == 'supervisor') {
            $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')
                ->where('supervisor_id', $user->id)
                ->get();
        } elseif ($user->role == 'superadmin') {
            $pendingHhmdForms = hhmdsaved::where('status', 'pending_supervisor')->get();
        }

        return view('dashboard', compact('pendingHhmdForms', 'pendingWtmdForms', 'pendingXrayForms'));

        if ($user->role == 'supervisor') {
            $pendingWrmdForms = wtmdsaved::where('status', 'pending_supervisor')
                ->where('supervisor_id', $user->id)
                ->get();
        } elseif ($user->role == 'superadmin') {
            $pendingWtmdForms = wtmdsaved::where('status', 'pending_supervisor')->get();
        }

        return view('dashboard', compact('pendingHhmdForms', 'pendingWtmdForms', 'pendingXrayForms'));
    }

    public function hhmdIndex()
    {
        $user = Auth::user();
        $locations = [
            'HBSCP',
            'Pos Kedatangan',
            'Pos Timur',
            'PSCP Selatan',
            'Pos Barat',
            'PSCP Utara'
        ];

        $pendingCounts = [];

        // Query dasar
        $baseQuery = hhmdsaved::where('status', 'pending_supervisor');

        if ($user->role == 'supervisor') {
            $baseQuery->where('supervisor_id', $user->id);
        }

        // Hitung pending untuk setiap lokasi
        foreach ($locations as $location) {
            $pendingCounts[$location] = (clone $baseQuery)
                ->where('location', $location)
                ->count();
        }

        // Query untuk semua form
        $allHhmdForms = hhmdsaved::when($user->role == 'supervisor', function ($query) use ($user) {
            return $query->where('supervisor_id', $user->id);
        })
        ->orderBy('testDateTime', 'desc')
        ->paginate(5);

        // Query untuk form yang sudah diputuskan
        $passorfailForms = hhmdsaved::whereIn('status', ['approved', 'rejected'])->get();

        return view('hhmdform', compact('pendingCounts', 'allHhmdForms', 'passorfailForms'));
    }
    public function wtmdIndex()
    {
        $user = Auth::user();
        $locations = [
            'Wtmd Pos Timur',  // Pastikan nama lokasi tepat
            'Wtmd PSCP Selatan',
            'Wtmd PSCP Utara'
        ];

        $pendingCounts = [];

        // Query dasar
        $baseQuery = wtmdsaved::where('status', 'pending_supervisor');

        if ($user->role == 'supervisor') {
            $baseQuery->where('supervisor_id', $user->id);
        }

        // Hitung pending untuk setiap lokasi
        foreach ($locations as $location) {
            $pendingCounts[$location] = (clone $baseQuery)
                ->where('location', $location)
                ->count() ?: 0;
        }

        // Query untuk semua form
        $allWtmdForms = wtmdsaved::when($user->role == 'supervisor', function ($query) use ($user) {
            return $query->where('supervisor_id', $user->id);
        })
            ->orderBy('testDateTime', 'desc')
            ->paginate(5);

        // Query untuk form yang sudah diputuskan
        $passorfailForms = wtmdsaved::whereIn('status', ['approved', 'rejected'])->get();
        return view('wtmdform', compact('pendingCounts', 'allWtmdForms', 'passorfailForms'));
    }

    public function kedatangan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'Pos Kedatangan');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.kedatangan', compact('allHhmdForms'));
    }

    public function filterKedatangan_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::where('location', 'Pos Kedatangan')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.kedatangan', [
                'allHhmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter Kedatangan Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function postimur_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'Pos Timur');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.postimur', compact('allHhmdForms'));
    }

    public function filterpostimur_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::where('location', 'Pos Timur')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.postimur', [
                'allHhmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter Pos Timur Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function posbarat_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'Pos Barat');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.posbarat', compact('allHhmdForms'));
    }

    public function filterposbarat_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::where('location', 'Pos Barat')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.posbarat', [
                'allHhmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter Posbarat Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function pscputara_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'PSCP Utara');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.pscputara', compact('allHhmdForms'));
    }

    public function filterpscputara_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::where('location', 'PSCP Utara')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.pscputara', [
                'allHhmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter PSCP Utara Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function pscpselatan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'PSCP Selatan');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.pscpselatan', compact('allHhmdForms'));
    }

    public function filterpscpselatan_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::where('location', 'PSCP Selatan')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.pscpselatan', [
                'allHhmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter HBSCP Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function hbscp_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = hhmdsaved::where('location', 'HBSCP');

        if ($user->role == 'supervisor') {
            $allHhmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allHhmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.hbscp', compact('allHhmdForms'));
    }

    public function filterhbscp_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = hhmdsaved::where('location', 'HBSCP')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.hbscp', [
                'allHhmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter HBSCP Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }        
    }

    public function wtmdpostimur_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = wtmdsaved::where('location', 'Wtmd Pos Timur');

        if ($user->role == 'supervisor') {
            $allWtmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allWtmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.wtmdpostimur', compact('allWtmdForms'));
    }

    public function filterwtmdpostimur_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = Wtmdsaved::where('location', 'Wtmd Pos Timur')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.wtmdpostimur', [
                'allWtmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter wtmdpostimur Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function wtmdpscputara_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = wtmdsaved::where('location', 'Wtmd Pscp Utara');

        if ($user->role == 'supervisor') {
            $allWtmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allWtmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.wtmdpscputara', compact('allWtmdForms'));
    }

    public function filterwtmdpscputara_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = Wtmdsaved::where('location', 'Wtmd Pscp Utara')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.wtmdpscputara', [
                'allWtmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter wtmdpscputara Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }

    public function wtmdpscpselatan_formCard()
    {
        $user = Auth::user();

        // Query dasar untuk lokasi Pos Kedatangan
        $baseQuery = wtmdsaved::where('location', 'Wtmd Pscp Selatan');

        if ($user->role == 'supervisor') {
            $allWtmdForms = $baseQuery->where('supervisor_id', $user->id)
                ->orderBy('testDateTime', 'desc')
                ->get();
        } else {
            $allWtmdForms = $baseQuery->orderBy('testDateTime', 'desc')
                ->get();
        }

        return view('partials.wtmdpscpselatan', compact('allWtmdForms'));
    }

    public function filterwtmdpscpselatan_FormCardByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        try {
            $filteredForms = Wtmdsaved::where('location', 'Wtmd Pscp Selatan')
                ->whereBetween('testDateTime', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay(),
                ])->get();

            if ($filteredForms->isEmpty()) {
                return back()->with('status', 'Tidak ada data yang ditemukan dalam rentang tanggal tersebut.');
            }

            return view('partials.wtmdpscpselatan', [
                'allWtmdForms' => $filteredForms,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            Log::error('Filter wtmdpscpselatan Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memfilter data: ' . $e->getMessage()]);
        }
    }
}
