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

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("home");
        echo view("layout/footer");
    }
}
