<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Survey extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar_survey');
        echo view('survey');
        echo view('layout/footer');
    }
}
