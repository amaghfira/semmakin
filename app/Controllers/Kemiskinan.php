<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KemiskinanModel;

class Kemiskinan extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->KemiskinanModel = new KemiskinanModel();
    }
    
    public function index()
    {
        //
    }

    public function rekap() {
        $rekap = $this->KemiskinanModel->getP3ke()->getResultArray();
        
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
        echo view("kemiskinan/entri_p3ke");
        echo view("layout/footer");
    }
}
