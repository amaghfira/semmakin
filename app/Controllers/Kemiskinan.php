<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;
use App\Models\TkpkdModel;
use PharIo\Manifest\Url;

class Kemiskinan extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->P3keModel = new P3keModel();
        $this->TkpkdModel = new TkpkdModel();
    }
    
    public function index()
    {
        //
    }

    public function rekap() {
        $rekap = $this->P3keModel->getP3ke()->getResultArray();
        
        $data['rekap'] = $rekap;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/rekap", $data);
        echo view("layout/footer");
    }

    public function entri() {
        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/entri");
        echo view("layout/footer");
    }

    public function visualisasi() {
        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/visualisasi");
        echo view("layout/footer");
    }

    // VISUALISASI CHOROPLETH MAP KEMISKINAN EKSTREM DATA P3KE 
    public function miskinEkstremByDesa() {
        $data = $this->P3keModel->getMiskinEkstremByDesa()->getResultArray();

        return json_encode($data);
    }

    public function petaDesa() {
        $path = WRITEPATH . 'uploads/final_desa_202216404.geojson';

        if (file_exists($path)) {
            // Read the file contents
            $geojsonData = file_get_contents($path);

            // Set the content type to JSON
            return $this->response->setJSON($geojsonData);
        }
    }

    public function show_TKPKD_page() {
        $laporan = $this->TkpkdModel->getAll();
        $laporan = $laporan->getResultArray();
        $data['laporan'] = $laporan;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/laporan_tkpkd", $data);
        echo view("layout/footer");
    }

    // function download laporan tkpkd 
    public function download_TKPKD()
    {
        $idget = $this->request->getGet();
        $laporan = $this->TkpkdModel->download($idget);
        $laporan = $laporan->getRowArray();
        if (isset($laporan)) {
            if ($laporan['path'] == "") { //jika path naskah tidk ditemukan 
                $this->session->setFlashdata('pesan_find', 'Naskah tidak ditemukan!');
                $this->session->setFlashdata('alert-class', 'alert-danger');
                return redirect()->to('/laporan');
            } else {
                // $data = file_get_contents(WRITEPATH.'uploads/'.$naskah['path_naskah']);
                return $this->response->download(WRITEPATH . 'uploads/laporan_tkpkd/' . $laporan['path'], null);
            }
        } else {
            return redirect()->to('/laporan');
        }
    }
}
