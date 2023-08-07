<?php

namespace App\Http\Controllers;

use App\Models\DataTesting;
use App\Models\DataTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class HasilController extends Controller
{
    //
    public function getHasil()
    {
        $testing = DataTesting::all();
        foreach ($testing as $data) {
            if ($data->Klasifikasi === '1') {
                $data->Klasifikasi = "Diterima";
            } else {
                $data->Klasifikasi = "Ditolak";
            }
        }
        return view('admin.hasilKlasifikasi')
            ->with('testing', $testing);
    }
    
    // generatePdf
    public function printPDF()
    {
        $testing = DataTesting::all();
        foreach ($testing as $data) {
            if ($data->rataRapor >= 50) {
                $data->nilai = "Diterima";
            } else {
                $data->nilai = "Ditolak";
            }
        }

        $pdf = PDF::loadView('admin.hasilKlasifikasiPDF', ['testing' => $testing]);

        // return $pdf->download('hasil_klasifikasi.pdf');
        return view('admin.hasilKlasifikasiPdf')
            ->with('testing', $testing);
    }
}   