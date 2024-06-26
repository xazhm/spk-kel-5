<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Comparisons;
use App\Models\Hasil;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilController extends Controller
{
    public function tampildetail($tipe)
    {
        // mengambil data dari table daftar rumah
        $data_rumah = Alternative::where('noStaff', $tipe)->get();

        // mengirim data rumah ke view daftar rumah
        return view('customer/package/rumah/detail', [
            'data_rumah' => $data_rumah
        ]);
    }

    public function hasil()
    {
        
        $datahasil = DB::table('hasils')
            ->orderBy('ahp', 'desc')
            ->get();

        $datamax = DB::table('hasils')
            ->orderBy('ahp', 'desc')
            ->limit(1)
            ->get();

        return view('admin/package/ahp/hasil', [
            'data_hasil' => $datahasil,
            'data_max' => $datamax
        ]);
    }

    public function tampilkesimpulan($tipe)
    {
        // mengambil data dari table daftar rumah
        $data_rumah = Hasil::where('noStaff', $tipe)->get();

        // mengirim data rumah ke view daftar rumah
        return view('customer/package/rumah/kesimpulan', [
            'data_rumah' => $data_rumah
        ]);
    }

    public function cetakpdf($tipe)
    {
        // set_time_limit(300);
        $data_rumah = Hasil::where('tipe', $tipe)->get();
        $pdf = \PDF::loadView('customer.package.rumah.cetak', compact('data_rumah'));
        $pdf->download('cetak.pdf');
        return view('customer/package/rumah/cetak', [
            'data_rumah' => $data_rumah
        ]);
    }
}
