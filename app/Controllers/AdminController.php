<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\P3keModel;

class AdminController extends BaseController
{

    public function __construct()
    {
        $this->session = session();   
        $this->P3keModel = new P3keModel();   
        $this->AdminModel = new AdminModel(); 
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

    public function edit() { //edit deskripsi analisis 
        // get daftar data
        $menus = $this->P3keModel->getMenus()->getResultArray(); 
        $data['menus'] = $menus;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("admin/edit", $data);
        echo view("layout/footer");
    }

    public function update() {
        $tahun = $this->request->getPost('tahun');
        $id = $this->request->getPost('tabel');
        $deskripsi = $this->request->getPost('deskripsi');

        $data = [
            'tahun' => $tahun,
            'deskripsi' => $deskripsi
        ];

        if ($this->AdminModel->cekDataById($id,$tahun) == true) { // cek if data already exists, then update 
            if ($this->AdminModel->updateData($id,$data) == true) {
                $this->session->setFlashdata('pesan','Berhasil Update Data');
                $this->session->setFlashdata('alert-class','alert-success');
            } else {
                $this->session->setFlashdata('pesan','Gagal Update Data');
                $this->session->setFlashdata('alert-class','alert-danger');
            }
        } else { // if not exists then insert
            if ($this->AdminModel->insertData($data) == true) {
                $this->session->setFlashdata('pesan','Berhasil Update Data');
                $this->session->setFlashdata('alert-class','alert-success');
            } else {
                $this->session->setFlashdata('pesan','Gagal Update Data');
                $this->session->setFlashdata('alert-class','alert-danger');
            }
        }
        return redirect('edit');
    }
 }
