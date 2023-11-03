<?php

namespace App\Controllers;

use App\Models\HomeModel;
use App\Models\UploadModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->HomeModel = new HomeModel();
        
    }

    public function index()
    {
        $jml_naskah_masuk = $this->HomeModel->getJmlNaskahMasuk();
        $jml_naskah_keluar = $this->HomeModel->getJmlNaskahKeluar();

        $data['jml_naskah_masuk'] = $jml_naskah_masuk;
        $data['jml_naskah_keluar'] = $jml_naskah_keluar;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("home",$data);
        echo view("layout/footer");
    }
}
