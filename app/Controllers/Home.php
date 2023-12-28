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
        $jmltot = $this->HomeModel->getJmlMiskinEkstrim()->getRow();
        $data['jmltot'] = $jmltot;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("home", $data);
        echo view("layout/footer");
    }

    public function getP3keHome() {
        $formView = view('home_p3ke');
        return $this->response->setJSON(['form' => $formView]);
    }

    public function getDtksHome() {
        $formView = view('home_dtks');
        return $this->response->setJSON(['form' => $formView]);
    }

    public function getPodesHome() {
        $formView = view('home_podes');
        return $this->response->setJSON(['form' => $formView]);
    }

    public function pendudukByDesilByKec() {
        $penduduk = $this->P3keModel->getByDesilByKec()->getResultArray();

        return json_encode($penduduk);
    }

    public function miskinEkstremByPekerjaan() {
        $data = $this->HomeModel->getMiskinEkstremByPekerjaan()->getResultArray();

        // var_dump($data);
        return json_encode($data);
    }

    public function miskinEkstremByPendidikan() {
        $data = $this->HomeModel->getMiskinEkstremByPendidikan()->getResultArray();

        // var_dump($data);
        return json_encode($data);
    }

    public function miskinEkstremByJk() {
        $data = $this->HomeModel->getMiskinEkstremByJk()->getResultArray();

        return json_encode($data);
    }

    public function miskinEkstremByRumah() {
        $data = $this->HomeModel->getMiskinEkstremByRumah()->getResultArray();

        return json_encode($data);
    }

}
