<?php

namespace App\Http\Controllers;

use App\Models\DataTesting;
use App\Models\DataTraining;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DataTrainingController extends Controller
{
    //
    public function tambahDataTraining(Request $request)
    {

        try {
            $dataTraining = DataTraining::create([
                'nama' => $request->input('nama'),
                'asalSekolah' => $request->input('asalSekolah'),
                'rataRapor' => $request->input('rataRapor'),
                'penghasilanOrtu' => $request->input('penghasilanOrtu'),
                'tanggunganOrtu' => $request->input('tanggunganOrtu'),
                'riwayatOrganisasi' => $request->input('riwayatOrganisasi'),
                'riwayatPrestasi' => $request->input('riwayatPrestasi'),
                'KIP' => $request->input('KIP'),
                'Klasifikasi' => $request->input('Klasifikasi'),
            ]);

            $dataTraining->save();

            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getDataTraining()
    {
        $training = DataTraining::all();
        return view('admin.dataTraining')->with('training', $training);
    }

    public function deleteDataTraining($id)
    {
        $training = DataTraining::find($id);

        if (!$training) {
            return redirect('Data-Training')->with('error', 'Data tidak ditemukan');
        }

        $deleteData = $training->delete();

        if ($deleteData) {
            return redirect('Data-Training')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect('Data-Training')->with('error', 'Data gagal dihapus');
        }
    }

    public function updateDataTraining(Request $request, $id)
    {
        try {
            $dataTraining = DataTraining::findOrFail($id);

            $dataTraining->update([
                'nama' => $request->input('nama'),
                'asalSekolah' => $request->input('asalSekolah'),
                'rataRapor' => $request->input('rataRapor'),
                'penghasilanOrtu' => $request->input('penghasilanOrtu'),
                'tanggunganOrtu' => $request->input('tanggunganOrtu'),
                'riwayatOrganisasi' => $request->input('riwayatOrganisasi'),
                'riwayatPrestasi' => $request->input('riwayatPrestasi'),
                'KIP' => $request->input('KIP'),
                'Klasifikasi' => $request->input('Klasifikasi'),
            ]);

            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function normalisasiData()
    {
        // Ambil data dari database
        $training = DataTraining::all();
        $testing = DataTesting::all();

        // Lakukan normalisasi dan perhitungan jarak pada data
        $normalizedData1 = [];
        $normalizedData2 = [];

        $normalizedData = [
            'normalizedData1' => [],
            'normalizedData2' => [],
        ];
        foreach ($training as $data) {
            // Lakukan normalisasi sesuai dengan formula normalisasi yang sesuai dengan kebutuhan Anda
            // Contoh normalisasi sederhana (misalnya untuk atribut rataRapor dan penghasilanOrtu):
            $normalizedRataRapor = ($data->rataRapor - 1) / (100 - 1); // Contoh normalisasi ke rentang [0, 1]
            $normalizedPenghasilanOrtu = ($data->penghasilanOrtu - 2000000) / (10000000 - 2000000); // Contoh normalisasi ke rentang [0, 1]

            //$nilai = $data->rataRapor;
            // if ($data['rataRapor'] >= 45) {
            //     $nilai = "Diterima";
            // } else {
            //     $nilai = "Ditolak";
            // }

            if ($data['Klasifikasi'] === '1') {
                $nilai = "Diterima";
            } else {
                $nilai = "Ditolak";
            }

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
            // $normalizedData1[] = [
            $normalizedData['normalizedData1'][] = [
                'nama' => $data->nama,
                'asalSekolah' => $data->asalSekolah,
                'rataRapor' => $data->rataRapor,
                // 'penghasilanOrtu' => $data->penghasilanOrtu,
                'penghasilanOrtu' => $penghasilan,
                'tanggunganOrtu' => $data->tanggunganOrtu,
                'riwayatOrganisasi' => $data->riwayatOrganisasi,
                'riwayatPrestasi' => $data->riwayatPrestasi,
                'KIP' => $data->KIP,
                'Klasifikasi' => $nilai,
                'jarak' => $jarak,
                // Tambahkan kolom lainnya sesuai kebutuhan
            ];            
        }
        foreach ($testing as $data) {
            foreach ($training as $data2)
            // Lakukan normalisasi sesuai dengan formula normalisasi yang sesuai dengan kebutuhan Anda
            // Contoh normalisasi sederhana (misalnya untuk atribut rataRapor dan penghasilanOrtu):
            $normalizedRataRapor = ($data->rataRapor - 1) / (100 - 1); // Contoh normalisasi ke rentang [0, 1]
            $normalizedPenghasilanOrtu = ($data->penghasilanOrtu - 2000000) / (10000000 - 2000000); // Contoh normalisasi ke rentang [0, 1]

            // Lakukan perhitungan jarak (misalnya menggunakan Euclidean distance)
            // Ganti dengan formula jarak yang sesuai dengan kebutuhan Anda
            // $jarak = sqrt(pow($normalizedRataRapor - 0.5, 2) + pow($normalizedPenghasilanOrtu - 0.7, 2));
            $jarak = sqrt(pow($data2['rataRapor'] - $data['rataRapor'],2) + pow($data2['penghasilanOrtu'] - $data['penghasilanOrtu'],2) + pow($data2['tanggunganOrtu'] - $data['tanggunganOrtu'],2) + pow($data2['riwayatPrestasi'] - $data['riwayatPrestasi'],2) + pow($data2['riwayatOrganisasi'] - $data['riwayatOrganisasi'],2) + pow($data2['KIP'] - $data['KIP'],2));

            // Tambahkan data hasil normalisasi dan jarak ke dalam array
            // $normalizedData2[] = [
            $normalizedData['normalizedData2'][] = [
                'nama2' => $data->nama,
                // Tambahkan kolom lainnya sesuai kebutuhan
            ];
        }
        // $normalizedData = array_merge($normalizedData1, $normalizedData2);

        // Kirim data hasil normalisasi sebagai response JSON

        // dd($normalizedData);
        // Kirim data hasil normalisasi sebagai response JSON
        return response()->json($normalizedData);
        // return response()->json($normalizedData2);

        // Kirim data hasil normalisasi sebagai response JSON
        // $response1 = response()->json($normalizedData1);
        // $response2 = response()->json($normalizedData2);

        // return [$response1, $response2];
    }
}