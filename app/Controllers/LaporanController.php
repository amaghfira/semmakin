<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DtksModel;
use App\Models\P3keModel;
use App\Models\PodesModel;

class LaporanController extends BaseController
{
    public $selectedYear;

    public function __construct()
    {
        $this->P3keModel = new P3keModel();
        $this->PodesModel = new PodesModel();
        $this->DtksModel = new DtksModel();
        $this->session = session();
    }

    public function index()
    {
        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/analisis");
        echo view("layout/footer");
    }

    public function indexP3ke()
    {
        $menus = $this->P3keModel->getMenus()->getResultArray();
        $data['menus'] = $menus;

        // load views
        echo view("layout/header");
        echo view("layout/navbar_laporan");
        echo view("kemiskinan/laporan_p3ke", $data);
        echo view("layout/footer");
    }

    public function indexRekapPodes() { // index utk menu rekap data podes   
        $menus = $this->PodesModel->getMenus()->getResultArray();
        $data['menus'] = $menus;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/laporan_podes", $data);
        echo view("layout/footer");
    }

    public function indexPodes()
    {
        $menus = $this->PodesModel->getMenus()->getResultArray();
        $data['menus'] = $menus;

        // load views
        echo view("layout/header");
        echo view("layout/navbar_laporan");
        echo view("kemiskinan/laporan_podes", $data);
        echo view("layout/footer");
    }

    public function indexDtks()
    {
        $menus = $this->DtksModel->getMenus()->getResultArray();
        $data['menus'] = $menus;

        // load views
        echo view("layout/header");
        echo view("layout/navbar_laporan");
        echo view("kemiskinan/laporan_dtks", $data);
        echo view("layout/footer");
    }


    // ================================================== //
    //                     P3KE                           //
    // ================================================== //

    // FUNCTION TO SHOW JUDUL DAN DATA TABLE 
    public function getData()
    {
        $selectedYear = $this->request->getPost('year');
        $selectedData = $this->request->getPost('data');

        $this->session->setFlashdata('year', $selectedYear);
        $this->session->setFlashdata('data', $selectedData);

        $desc = $this->P3keModel->getDescById($selectedData, $selectedYear)->getResult();

        if ($selectedData >= 1 && $selectedData <= 18) { // dATA BY KEC
            if ($selectedData == 1) {
                // $tabel = $this->P3keModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Kecamatan dan Desil";
            }
            if ($selectedData == 2) {
                $tabel = $this->P3keModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Kecamatan dan Jenis Kelamin";
            }
            if ($selectedData == 3) {
                $tabel = $this->P3keModel->getTabel3($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Kecamatan dan Pekerjaan";
            }
            if ($selectedData == 4) {
                $tabel = $this->P3keModel->getTabel4($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Pendidikan";
            }
            if ($selectedData == 5) {
                $tabel = $this->P3keModel->getTabel5($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Status Kepemilikan Rumah";
            }
            if ($selectedData == 6) {
                $tabel = $this->P3keModel->getTabel6($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Simpanan";
            }
            if ($selectedData == 7) {
                $tabel = $this->P3keModel->getTabel7($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Atap";
            }
            if ($selectedData == 8) {
                $tabel = $this->P3keModel->getTabel8($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Dinding";
            }
            if ($selectedData == 9) {
                $tabel = $this->P3keModel->getTabel9($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Lantai";
            }
            if ($selectedData == 10) {
                $tabel = $this->P3keModel->getTabel10($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Sumber Penerangan";
            }
            if ($selectedData == 11) {
                $tabel = $this->P3keModel->getTabel11($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Bahan Bakar Memasak";
            }
            if ($selectedData == 12) {
                $tabel = $this->P3keModel->getTabel12($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Sumber Air Minum";
            }
            if ($selectedData == 13) {
                $tabel = $this->P3keModel->getTabel13($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Fasilitas BAB";
            }
            if ($selectedData == 14) {
                $tabel = $this->P3keModel->getTabel14($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima BNP";
            }
            if ($selectedData == 15) {
                $tabel = $this->P3keModel->getTabel15($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima BPU";
            }
            if ($selectedData == 16) {
                $tabel = $this->P3keModel->getTabel16($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima BST";
            }
            if ($selectedData == 17) {
                $tabel = $this->P3keModel->getTabel17($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima PKH";
            }
            if ($selectedData == 18) {
                $tabel = $this->P3keModel->getTabel18($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima Sembako";
            }
            $data['id'] = $selectedData;
            $data['judul'] = $judul;
            $data['tabel'] = $tabel;
            $data['deskripsi'] = $desc;
            $formView = view('kemiskinan/analisis/p3ke_kec', $data);
        } else { // DATA BY DESA
            if ($selectedData == 20) {
                $tabel = $this->P3keModel->getTabel20($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Desa dan Jenis Kelamin";
            }
            if ($selectedData == 21) {
                $tabel = $this->P3keModel->getTabel21($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan pekerjaan";
            }
            if ($selectedData == 22) {
                $tabel = $this->P3keModel->getTabel22($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan pendidikan";
            }
            if ($selectedData == 23) {
                $tabel = $this->P3keModel->getTabel23($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan status kepemilikan rumah";
            }
            if ($selectedData == 24) {
                $tabel = $this->P3keModel->getTabel24($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan simpanan";
            }
            if ($selectedData == 25) {
                $tabel = $this->P3keModel->getTabel25($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan jenis atap";
            }
            if ($selectedData == 26) {
                $tabel = $this->P3keModel->getTabel26($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan jenis dinding";
            }
            if ($selectedData == 27) {
                $tabel = $this->P3keModel->getTabel27($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan jenis lantai";
            }
            if ($selectedData == 28) {
                $tabel = $this->P3keModel->getTabel28($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan sumber penerangan";
            }
            if ($selectedData == 29) {
                $tabel = $this->P3keModel->getTabel29($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan bahan bakar memasak";
            }
            if ($selectedData == 30) {
                $tabel = $this->P3keModel->getTabel30($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan sumber air minum";
            }
            if ($selectedData == 31) {
                $tabel = $this->P3keModel->getTabel31($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan fasilitas BAB";
            }
            if ($selectedData == 32) {
                $tabel = $this->P3keModel->getTabel32($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan penerima BNP";
            }
            if ($selectedData == 33) {
                $tabel = $this->P3keModel->getTabel33($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan penerima BPU";
            }
            if ($selectedData == 34) {
                $tabel = $this->P3keModel->getTabel34($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan penerima BST";
            }
            if ($selectedData == 35) {
                $tabel = $this->P3keModel->getTabel35($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan penerima PKH";
            }
            if ($selectedData == 36) {
                $tabel = $this->P3keModel->getTabel36($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah penduduk miskin ekstrem berdasarkan kecamatan dan penerima sembako";
            }
            $data['id'] = $selectedData;
            $data['judul'] = $judul;
            $data['tabel'] = $tabel;
            $data['deskripsi'] = $desc;
            $formView = view('kemiskinan/analisis/p3ke_desa', $data);
        }

        return $this->response->setJSON(['form' => $formView, 'newData' => $data]);
    }


    // JSON FOR CHARTS
    public function getGrafik()
    {
        if ($this->session->getFlashdata('data') == 2) {
            $data = $this->P3keModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 3) {
            $data = $this->P3keModel->getTabel3($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 4) {
            $data = $this->P3keModel->getTabel4($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 5) {
            $data = $this->P3keModel->getTabel5($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 6) {
            $data = $this->P3keModel->getTabel6($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 7) {
            $data = $this->P3keModel->getTabel7($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 8) {
            $data = $this->P3keModel->getTabel8($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 9) {
            $data = $this->P3keModel->getTabel9($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 10) {
            $data = $this->P3keModel->getTabel10($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 11) {
            $data = $this->P3keModel->getTabel11($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 12) {
            $data = $this->P3keModel->getTabel12($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 13) {
            $data = $this->P3keModel->getTabel13($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 14) {
            $data = $this->P3keModel->getTabel14($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 15) {
            $data = $this->P3keModel->getTabel15($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 16) {
            $data = $this->P3keModel->getTabel16($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 17) {
            $data = $this->P3keModel->getTabel17($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 18) {
            $data = $this->P3keModel->getTabel18($this->session->getFlashdata('year'))->getResultArray();
        }
        return $this->response->setJSON(['newData' => $data]);
    }

    // JSON FOR TREEMAP
    public function getTreemap()
    {
        // $data = $this->P3keModel->getTabel19($this->session->getFlashdata('year'))->getResultArray();
        if ($this->session->getFlashdata('data') == 20) {
            $data = $this->P3keModel->getTabel20($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 21) {
            $data = $this->P3keModel->getTabel21($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 22) {
            $data = $this->P3keModel->getTabel22($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 23) {
            $data = $this->P3keModel->getTabel23($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 24) {
            $data = $this->P3keModel->getTabel24($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 25) {
            $data = $this->P3keModel->getTabel25($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 26) {
            $data = $this->P3keModel->getTabel26($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 27) {
            $data = $this->P3keModel->getTabel27($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 28) {
            $data = $this->P3keModel->getTabel28($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 29) {
            $data = $this->P3keModel->getTabel29($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 30) {
            $data = $this->P3keModel->getTabel30($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 31) {
            $data = $this->P3keModel->getTabel31($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 32) {
            $data = $this->P3keModel->getTabel32($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 33) {
            $data = $this->P3keModel->getTabel33($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 34) {
            $data = $this->P3keModel->getTabel34($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 35) {
            $data = $this->P3keModel->getTabel35($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 36) {
            $data = $this->P3keModel->getTabel36($this->session->getFlashdata('year'))->getResultArray();
        }

        $newData = [];
        foreach ($data as $row) {
            $regency = $row['kec'];
            $desa = $row['desa'];

            // Check if the regency exists in the new structure
            if (!isset($newData[$regency])) {
                $newData[$regency] = [];
            }

            // Check if the subcategory exists for the regency
            if (!isset($newData[$regency][$desa])) {
                $newData[$regency][$desa] = [];
            }

            // Sum up all numeric values for each regency and desa
            foreach ($row as $key => $value) {
                // Exclude non-numeric or non-desired keys here if needed
                if (is_numeric($value)) {
                    if (!isset($newData[$regency][$desa][$key])) {
                        $newData[$regency][$desa][$key] = intval($value);
                    } else {
                        $newData[$regency][$desa][$key] += intval($value);
                    }
                }
            }
        }
        echo json_encode($newData);
    }

    // ========================================================================== //
    //                                  PODES                                     // 
    // ========================================================================== //

    public function getDataPodes()
    {
        $selectedYear = $this->request->getPost('year');
        $selectedData = $this->request->getPost('data');

        $this->session->setFlashdata('year', $selectedYear);
        $this->session->setFlashdata('data', $selectedData);

        $desc = $this->PodesModel->getDescById($selectedData, $selectedYear)->getResult();

        // Define an array to map selectedData to the corresponding getTabel function number
        $getTabelFunctions = [
            37 => 'getTabel1',
            38 => 'getTabel2',
            39 => 'getTabel3',
            40 => 'getTabel4',
            41 => 'getTabel5',
            42 => 'getTabel6',
            43 => 'getTabel7',
            44 => 'getTabel8',
            45 => 'getTabel9',
            46 => 'getTabel10',
            47 => 'getTabel11',
            48 => 'getTabel12',
            49 => 'getTabel13',
            50 => 'getTabel14',
            51 => 'getTabel15',
            52 => 'getTabel16',
            53 => 'getTabel17',
            54 => 'getTabel18',
            55 => 'getTabel19',
            56 => 'getTabel20',
            57 => 'getTabel21',
            58 => 'getTabel22',
            59 => 'getTabel23',
            60 => 'getTabel24',
            61 => 'getTabel25',
            62 => 'getTabel26',
            63 => 'getTabel27',
            64 => 'getTabel28',
            65 => 'getTabel29',
            66 => 'getTabel30',
            67 => 'getTabel31',
            68 => 'getTabel32',
            69 => 'getTabel33',
            70 => 'getTabel34',
            71 => 'getTabel35',
            72 => 'getTabel36',
            73 => 'getTabel37',
            74 => 'getTabel38',
            75 => 'getTabel39',
            76 => 'getTabel40',
            77 => 'getTabel41'
        ];

        if (isset($getTabelFunctions[$selectedData])) {
            $tabel = $this->PodesModel->{$getTabelFunctions[$selectedData]}($selectedYear)->getResultArray();

            // Define the $judul variable based on selectedData
            $judul = ($selectedData == 37) ? "Banyaknya Desa/Kelurahan Menurut Sumber Penghasilan Utama Sebagian Besar Penduduk" : 
            (($selectedData == 38) ? "Banyaknya Desa/Kelurahan Yang Sebagian Besar Penduduknya Bekerja Pada Sektor Pertanian Menurut Jenis Komoditi/Sub Sektor Utama" : 
            (($selectedData == 39) ? "Banyaknya Desa/Kelurahan Menurut Keberadaan Keluarga Pengguna Listrik dan Sumber Penerangan Jalan Utama Desa" : 
            (($selectedData == 40) ? "Banyaknya Desa/Kelurahan Menurut Jenis Bahan Bakar Untuk Memasak yang Digunakan Oleh Sebagian Besar Keluarga dan Keberadaan Agen/Penjual Bahan Bakar" : 
            (($selectedData == 41) ? "Banyaknya Desa/Kelurahan Menurut Sumber Air Minum Sebagian Besar Keluarga" : 
            (($selectedData == 42) ? "Banyaknya Desa/Kelurahan Menurut Penggunaan Fasilitas Tempat Buang Air Besar Sebagian Besar Keluarga" : 
            (($selectedData == 43) ? "Banyaknya Desa/Kelurahan Menurut Pembuangan Akhir Tinja sebagain besar keluarga" : (($selectedData == 44) ? "Banyaknya SD/MI, SMP/MTs, SMA/MA, SMK, dan Akademi/Perguruan Tinggi menurut kecamatan" : (($selectedData == 45) ? "Banyaknya SD/MI Negeri dan Swasta Menurut Kecamatan" : 
            (($selectedData == 46) ? "Banyaknya SMP/MTS Negeri dan Swasta Menurut Kecamatan" : 
            (($selectedData == 47) ? "Banyaknya SMA/MA Negeri dan Swasta Menurut Kecamatan" : 
            (($selectedData == 48) ? "Banyaknya SMK Negeri dan Swasta Menurut Kecamatan" : 
            (($selectedData == 49) ? "Banyaknya Desa/Kelurahan Menurut Kegiatan Posyandu dan Posbindu" : 
            (($selectedData == 50) ? "(REKAP) Banyaknya Rumah Sakit, Rumah Sakit bersalin, Puskesmas dengan rawat inap, poliklinik, apotek menurut kecamatan" : 
            (($selectedData == 51) ? "Banyaknya Rumah Sakit dan Rumah Sakit Bersalin Menurut Kecamatan" : 
            (($selectedData == 52) ? "Banyaknya Puskesmas Menurut Kecamatan" : 
            (($selectedData == 53) ? "Banyaknya Poliklinik/Balai Pengobatan Menurut Kecamatan" : 
            (($selectedData == 54) ? "Banyaknya Keberadaan Tenaga Kesehatan dan Dukun Bayi yang Tinggal di Desa menurut Desa/Kelurahan " : 
            (($selectedData == 55) ? "Banyaknya  Desa/Kelurahan menurut Jenis Prasarana Transportasi" : 
            (($selectedData == 56) ? "Banyaknya  Desa/Kelurahan  menurut Jenis Ketersediaan Angkutan Umum " : 
            (($selectedData == 57) ? "Banyaknya Desa/Kelurahan yang Menggunakan Prasarana Transportasi Darat atau Darat dan Air Menurut Jenis Permukaan Jalan Darat Terluas" : 
            (($selectedData == 58) ? "Jumlah PAUD" : 
            (($selectedData == 59) ? "jumlah TK dan RA/BA" :
            (($selectedData == 60) ? "Jumlah SD dan MI" : 
            (($selectedData == 61) ? "jumlah SMP dan MTS" : 
            (($selectedData == 62) ? "Jumlah SMA, MA, dan SMK" :
            (($selectedData ==63) ? "Jumlah Universitas" : 
            (($selectedData == 64) ? "Jumlah Keberadaan Taman Bacaan Masyarakat (TBM)" :
            (($selectedData == 65) ? "Jumlah Rumah sakit" :
            (($selectedData ==66 ) ? "Jumlah RS bersalin" : 
            (($selectedData == 67) ? "Jumlah Puskesmas dengan rawat inap" :
            (($selectedData == 68) ? "Jumlah Puskesmas tanpa rawat inap" :
            (($selectedData == 69) ? "Jumlah Puskesmas pembantu" :
            (($selectedData == 70) ? "Jumlah Poliklinik/balai pengobatan" :
            (($selectedData == 71) ? "Jumlah Tempat praktik dokter" :
            (($selectedData == 72) ? "Jumlah Rumah bersalin" : 
            (($selectedData ==73) ? "Jumlah Tempat praktik bidan" :
            (($selectedData == 74) ? "Jumlah Poskesdes" :
            (($selectedData == 75) ? "Jumlah Polindes" :
            (($selectedData == 76) ? "Jumlah Apotek" :
            (($selectedData == 77) ? "Jumlah Posyandu aktif setiap bulan aktif" : "Untitled")))))))))))))))))))))))))))))))))))))))); // Replace "Default Title" with the desired default title if needed

        }

        $data['id'] = $selectedData;
        $data['judul'] = $judul;
        $data['tabel'] = $tabel;
        $data['deskripsi'] = $desc;
        $formView = view('kemiskinan/analisis/podes', $data);

        return $this->response->setJSON(['form' => $formView]);
    }

    // JSON FOR CHARTS
    public function getGrafikPodes()
    {
        if ($this->session->getFlashdata('data') == 37) {
            $data = $this->P3keModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 38) {
            $data = $this->P3keModel->getTabel3($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 39) {
            $data = $this->P3keModel->getTabel4($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 40) {
            $data = $this->P3keModel->getTabel5($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 41) {
            $data = $this->P3keModel->getTabel6($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 42) {
            $data = $this->P3keModel->getTabel7($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 43) {
            $data = $this->P3keModel->getTabel8($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 44) {
            $data = $this->P3keModel->getTabel9($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 45) {
            $data = $this->P3keModel->getTabel10($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 46) {
            $data = $this->P3keModel->getTabel11($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 47) {
            $data = $this->P3keModel->getTabel12($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 48) {
            $data = $this->P3keModel->getTabel13($this->session->getFlashdata('year'))->getResultArray();
        }
        return json_encode($data);
    }

    // ============================================================== //
    // VISUALISASI CHOROPLETH MAP KEMISKINAN EKSTREM DATA P3KE       //
    // ============================================================ //
    public function miskinEkstremByDesa()
    {
        $data = $this->P3keModel->getMiskinEkstremByDesa()->getResultArray();

        return json_encode($data);
    }

    public function petaDesa()
    {
        $path = WRITEPATH . 'uploads/final_desa_202216404.geojson';

        if (file_exists($path)) {
            // Read the file contents
            $geojsonData = file_get_contents($path);

            // Set the content type to JSON
            return $this->response->setJSON($geojsonData);
        }
    }

    // ========================================================================== //
    //                                  DTKS                                      // 
    // ========================================================================== //

    public function getDataDtks()
    {
        $selectedYear = $this->request->getPost('year');
        $selectedData = $this->request->getPost('data');

        $this->session->setFlashdata('year', $selectedYear);
        $this->session->setFlashdata('data', $selectedData);

        $desc = $this->DtksModel->getDescById($selectedData, $selectedYear)->getResult();

        // Define an array to map selectedData to the corresponding getTabel function number
        $getTabelFunctions = [
            78 => 'getTabel1',
            79 => 'getTabel2',
            80 => 'getTabel3',
            81 => 'getTabel4',
            82 => 'getTabel5',
            83 => 'getTabel6',
            84 => 'getTabel7',
            85 => 'getTabel8',
            86 => 'getTabel9',
            87 => 'getTabel10',
            88 => 'getTabel11',
            89 => 'getTabel12',
            90 => 'getTabel13',
            91 => 'getTabel14',
            92 => 'getTabel15',
            93 => 'getTabel16'
        ];

        if (isset($getTabelFunctions[$selectedData])) {
            $tabel = $this->DtksModel->{$getTabelFunctions[$selectedData]}($selectedYear)->getResultArray();

            // Define the $judul variable based on selectedData
            $judul = ($selectedData == 78) ? "Banyaknya rumah tangga menurut kecamatan dan status kesejahteraan" : 
            (($selectedData == 79) ? "Banyaknya rumah tangga menurut kecamatan dan status bangunan" : 
            (($selectedData == 80) ? "Banyaknya rumah tangga menurut kecamatan dan status lahan" : 
            (($selectedData == 81) ? "Banyaknya rumah tangga menurut kecamatan dan rata-rata luas lantai" : 
            (($selectedData == 82) ? "Banyaknya rumah tangga menurut kecamatan dan jenis lantai" : 
            (($selectedData == 83) ? "Banyaknya rumah tangga menurut kecamatan dan jenis dinding dan kondisi dinding" : 
            (($selectedData == 84) ? "Banyaknya rumah tangga menurut kecamatan dan atap dan kondisi atap":
            (($selectedData == 85) ? "Banyaknya rumah tangga menurut kecamatan dan rata-rata jumlah kamar" : 
            (($selectedData == 86) ? "Banyaknya rumah tangga menurut kecamatan dan sumber air minum" : 
            (($selectedData == 87) ? "Banyaknya rumah tangga menurut kecamatan dan cara memperoleh air minum" : 
            (($selectedData == 88) ? "Banyaknya rumah tangga menurut kecamatan dan sumber penerangan" : 
            (($selectedData == 89) ? "Banyaknya rumah tangga menurut kecamatan dan bahan bakar memasak" : 
            (($selectedData == 90) ? "Banyaknya rumah tangga menurut kecamatan dan fasilitas buang air besar" : 
            (($selectedData == 91) ? "Banyaknya rumah tangga menurut kecamatan dan kepemilikan aset (tabung gas, lemari es, ac, pemanas, telpon, tv, emas, laptop, sepeda, motor, mobil, perahu, motor tempel, perahu motor, kapal)" : 
            (($selectedData == 92) ? "Banyaknya rumah tangga menurut kecamatan dan kepemilikan ternak ( sapi, kerbau, kuda, babi, kambing)" : 
            (($selectedData == 93) ? "Banyaknya rumah tangga menurut kecamatan dan status ART yang berusaha" : "untitled"
            ))))))))))))))); // Replace "Default Title" with the desired default title if needed

        }

        $data['id'] = $selectedData;
        $data['judul'] = $judul;
        $data['tabel'] = $tabel;
        $data['deskripsi'] = $desc;
        $formView = view('kemiskinan/analisis/dtks_ruta', $data);

        return $this->response->setJSON(['form' => $formView]);
    }

    // JSON FOR CHARTS
    public function getGrafikDtks()
    {
        if ($this->session->getFlashdata('data') == 78) {
            $data = $this->DtksModel->getTabel1($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 79) {
            $data = $this->DtksModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 80) {
            $data = $this->DtksModel->getTabel3($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 81) {
            $data = $this->DtksModel->getTabel4($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 82) {
            $data = $this->DtksModel->getTabel5($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 83) {
            $data = $this->DtksModel->getTabel6($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 84) {
            $data = $this->DtksModel->getTabel7($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 85) {
            $data = $this->DtksModel->getTabel8($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 86) {
            $data = $this->DtksModel->getTabel9($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 87) {
            $data = $this->DtksModel->getTabel10($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 88) {
            $data = $this->DtksModel->getTabel11($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 89) {
            $data = $this->DtksModel->getTabel12($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 90) {
            $data = $this->DtksModel->getTabel13($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 91) {
            $data = $this->DtksModel->getTabel14($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 92) {
            $data = $this->DtksModel->getTabel15($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 93) {
            $data = $this->DtksModel->getTabel16($this->session->getFlashdata('year'))->getResultArray();
        }
        return $this->response->setJSON(['newData' => $data]);
    }
}
