<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;

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
}
