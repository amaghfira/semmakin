<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;
use PharIo\Manifest\Url;

class Kemiskinan extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->P3keModel = new P3keModel();
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

    public function laporan() {
        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/laporan");
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
}
