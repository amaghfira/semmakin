<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\P3keModel;
use App\Models\UploadModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->HomeModel = new HomeModel();
        $this->P3keModel = new P3keModel();
        
    }

    public function index()
    {

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("home");
        echo view("layout/footer");
    }

    public function pendudukByDesilByKec() {
        $penduduk = $this->P3keModel->getByDesilByKec()->getResultArray();

        return json_encode($penduduk);
    }
}
