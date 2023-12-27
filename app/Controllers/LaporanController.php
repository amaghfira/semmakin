<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;

class LaporanController extends BaseController
{
    public $selectedYear;

    public function __construct()
    {
        $this->P3keModel = new P3keModel();
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

    // FUNCTION TO SHOW JUDUL DAN DATA TABLE 
    public function getData()
    {
        $selectedYear = $this->request->getPost('year');
        $selectedData = $this->request->getPost('data');

        $this->session->setFlashdata('year', $selectedYear);
        $this->session->setFlashdata('data', $selectedData);

        $desc = $this->P3keModel->getDescById($selectedData,$selectedYear)->getResult();

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
            if ($selectedData == 19) {
                $tabel = $this->P3keModel->getTabel19($this->session->getFlashdata('year'))->getResultArray();
                $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Desa dan Jenis Kelamin";
            }
            $data['id'] = $selectedData;
            $data['judul'] = $judul;
            $data['tabel'] = $tabel;
            $data['deskripsi'] = $desc;
            $formView = view('kemiskinan/analisis/p3ke_desa', $data); 
        }

        return $this->response->setJSON(['form' => $formView]);
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
        return json_encode($data);
    }

    // JSON FOR TREEMAP
    public function getTreemap()
    {
        $data = $this->P3keModel->getTabel19($this->session->getFlashdata('year'))->getResultArray();

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
}
