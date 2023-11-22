<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;

class AdminController extends BaseController
{

    public function __construct()
    {
        $this->session = session();   
        $this->P3keModel = new P3keModel();    
    }

    public function index()
    {
        
    }

    public function master() {
        $masterP3ke = $this->P3keModel->getP3ke()->getResultArray();

        $data['master'] = $masterP3ke;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("admin/master", $data);
        echo view("layout/footer");
    }
}
