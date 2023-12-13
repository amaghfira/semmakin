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
        // load views
        echo view("layout/header");
        echo view("layout/navbar_laporan");
        echo view("kemiskinan/laporan_p3ke");
        echo view("layout/footer");
    }

    // FUNCTION TO SHOW JUDUL DAN DATA TABLE 
    public function getData() {
        $selectedYear = $this->request->getPost('year');
        $selectedData = $this->request->getPost('data');

        $this->session->setFlashdata('year', $selectedYear);
        $this->session->setFlashdata('data', $selectedData);
        
        if ($selectedData == 2) {
            $tabel = $this->P3keModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
            $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Kecamatan dan Jenis Kelamin";
        }
        if ($selectedData == 3) {
            $tabel = $this->P3keModel->getTabel3($this->session->getFlashdata('year'))->getResultArray();
            $judul = "Jumlah Penduduk Miskin Ekstrem Menurut Kecamatan dan Pekerjaan";
        }
        $data['id'] = $selectedData;
        $data['judul'] = $judul;
        $data['tabel'] = $tabel;
        $formView = view('kemiskinan/analisis/tabel_p3ke', $data);

        return $this->response->setJSON(['form' => $formView]);
    }

    
    // JSON FOR CHARTS
    public function getGrafik() {
        if ($this->session->getFlashdata('data') == 2) {
            $data = $this->P3keModel->getTabel2($this->session->getFlashdata('year'))->getResultArray();
        }
        if ($this->session->getFlashdata('data') == 3) {
            $data = $this->P3keModel->getTabel3($this->session->getFlashdata('year'))->getResultArray();
        }
        return json_encode($data);
    }

}
