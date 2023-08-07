<?php

namespace App\Http\Controllers;

use App\Models\DataTesting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class DataTestingController extends Controller
{
    public function tambahDataTesting(Request $request)
    {

        try {
            $dataTesting = DataTesting::create([
                'nama' => $request->input('nama'),
                'asalSekolah' => $request->input('asalSekolah'),
                'rataRapor' => $request->input('rataRapor'),
                'penghasilanOrtu' => $request->input('penghasilanOrtu'),
                'tanggunganOrtu' => $request->input('tanggunganOrtu'),
                'riwayatOrganisasi' => $request->input('riwayatOrganisasi'),
                'riwayatPrestasi' => $request->input('riwayatPrestasi'),
                'KIP' => $request->input('KIP'),
            ]);

            $dataTesting->save();

            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getDataTesting()
    {
        $testing = DataTesting::all();
        return view('admin.dataTesting')->with('testing', $testing);
    }

    public function deleteDataTesting($id)
    {
        $testing = DataTesting::find($id);

        if (!$testing) {
            return redirect('Data-Testing')->with('error', 'Data tidak ditemukan');
        }

        $deleteData = $testing->delete();

        if ($deleteData) {
            return redirect('Data-Testing')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect('Data-Testing')->with('error', 'Data gagal dihapus');
        }
    }

    public function updateDataTesting(Request $request, $id)
    {
        try {
            $dataTesting = DataTesting::findOrFail($id);

            $dataTesting->update([
                'nama' => $request->input('nama'),
                'asalSekolah' => $request->input('asalSekolah'),
                'rataRapor' => $request->input('rataRapor'),
                'penghasilanOrtu' => $request->input('penghasilanOrtu'),
                'tanggunganOrtu' => $request->input('tanggunganOrtu'),
                'riwayatOrganisasi' => $request->input('riwayatOrganisasi'),
                'riwayatPrestasi' => $request->input('riwayatPrestasi'),
                'KIP' => $request->input('KIP'),
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function normalisasiData()
    {
        // Ambil data dari database
        $testing = DataTesting::all();

        // Lakukan normalisasi dan perhitungan jarak pada data
        $normalizedData = [];
        foreach ($testing as $data) {
            // Lakukan normalisasi sesuai dengan formula normalisasi yang sesuai dengan kebutuhan Anda
            // Contoh normalisasi sederhana (misalnya untuk atribut rataRapor dan penghasilanOrtu):
            $normalizedRataRapor = ($data->rataRapor - 1) / (100 - 1); // Contoh normalisasi ke rentang [0, 1]
            $normalizedPenghasilanOrtu = ($data->penghasilanOrtu - 2000000) / (10000000 - 2000000); // Contoh normalisasi ke rentang [0, 1]


            $test = $data->rataRapor;
            if ($data['rataRapor'] == 5 ) {
                # code...
                $test = 5;
            } else if ($data['rataRapor'] == 4) {
                $test = 4;
            } else if ($data['rataRapor'] == 3) {
                $test = 3;
            } else if ($data['rataRapor'] == 2) {
                $test = 2;
            } else {
                $test = 1;
            }
            $penghasilan = $data->penghasilanOrtu;
            if ($data['penghasilanOrtu'] == 1) {
                # code...
                $penghasilan = 1;
            } else if ($data['penghasilanOrtu'] == 2) {
                $penghasilan = 2;
            } else if ($data['penghasilanOrtu'] == 3) {
                $penghasilan = 3;
            }  else if ($data['penghasilanOrtu'] == 4) {
                $penghasilan = 4;
            } else {
                $penghasilan = 5;
            }
            $tanggungan = $data->tanggunganOrtu;
            if ($data['tanggunganOrtu'] >= 4) {
                # code...
                $tanggungan = 1;
            } else if ($data['tanggunganOrtu'] = 3) {
                $tanggungan = 2;
            } else if ($data['tanggunganOrtu'] = 2) {
                $tanggungan = 3;
            } else  if ($data['tanggunganOrtu'] <= 1){
                $tanggungan = 4;
            }
            $organisasi = $data->riwayatOrganisasi;
            if ($data['riwayatOrganisasi'] >= 4) {
                # code...
                $organisasi = 5;
            } else if ($data['riwayatOrganisasi'] >= 3) {
                $organisasi = 4;
            } else if ($data['riwayatOrganisasi'] >= 2) {
                $organisasi = 3;
            } else if ($data['riwayatOrganisasi'] >= 1) {
                $organisasi = 2;
            } else {
                $organisasi = 1;
            }
            $prestasi = $data->riwayatPrestasi;
            if ($data['riwayatPrestasi'] >= 4) {
                # code...
                $prestasi = 5;
            } else if ($data['riwayatPrestasi'] >= 3) {
                $prestasi = 4;
            } else if ($data['riwayatPrestasi'] >= 2) {
                $prestasi = 3;
            } else if ($data['riwayatPrestasi'] >= 1) {
                    $prestasi = 2;
            } else {
                $prestasi = 1; //0 
            }
            $kip = $data->KIP;
            if ($data['KIP'] == 1) {
                $kip = 2;
            } else {
                $kip = 1;
            }
            
            // Lakukan perhitungan jarak (misalnya menggunakan Euclidean distance)
            // Ganti dengan formula jarak yang sesuai dengan kebutuhan Anda
            $jarak = sqrt(pow($normalizedRataRapor - 0.5, 2) + pow($normalizedPenghasilanOrtu - 0.7, 2));

            // Tambahkan data hasil normalisasi dan jarak ke dalam array
            $normalizedData[] = [
                'nama' => $data->nama,
                'asalSekolah' => $data->asalSekolah,
                'rataRapor' => $test,
                'penghasilanOrtu' => $penghasilan,
                'tanggunganOrtu' => $penghasilan,
                'riwayatOrganisasi' => $organisasi,
                'riwayatPrestasi' => $prestasi,
                'KIP' => $kip,
                'jarak' => $jarak,
                // Tambahkan kolom lainnya sesuai kebutuhan
            ];
        }

        // Kirim data hasil normalisasi sebagai response JSON
        return response()->json($normalizedData);
    }
}
