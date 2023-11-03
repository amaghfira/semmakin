<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class Download extends Controller
{
    public function __construct()
    {
        $this->response = \Config\Services::response();
    }
    public function index()
    {
        return $this->response->download('template_monitoring6400.xlsx',null);
    }

    public function download_template_c2() {
        return $this->response->download('template_c2.xlsx',null);
    }
}
