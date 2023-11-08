<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;

class FormController extends BaseController
{

    public function __construct()
    {
        $this->session = session();   
        $this->P3keModel = new P3keModel();
    }

    public function index()
    {
        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/entri");
        echo view("layout/footer");
    }

    public function getFormP3KE() {
        $desil = $this->P3keModel->getDesil()->getResultArray();
        $padan = $this->P3keModel->getPadanDukcapil()->getResultArray();

        $data['desil'] = $desil;
        $data['padan'] = $padan;

        $formView = view('kemiskinan/form_p3ke', $data);
        return $this->response->setJSON(['form' => $formView]);
    }
}
