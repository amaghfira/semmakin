<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisModel;

class Jenis extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->JenisModel = new JenisModel();
    }

    public function index()
    {
        $data['jenis'] = $this->JenisModel->getData()->getResultArray();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("jenis", $data);
        echo view("layout/footer");
    }

    public function add()
    {
        $jenisbaru = $this->request->getPost('jenis_baru');
        $data = [
            'jenis' => $jenisbaru
        ];
        
        if ($this->JenisModel->insertData($data) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('jenis');
    }

    public function edit() {
        $id = $this->request->getPost('id');
        $jenis = $this->request->getPost('jenis');

        $array = [
            'jenis' => $jenis
        ];

        if ($this->JenisModel->editData($id,$array) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Update Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Update Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('jenis');
        
    }

    public function delete() {
        $id = $this->request->getPost('id');

        if ($this->JenisModel->deleteData($id) == true) {
            $this->session->setFlashdata('pesan_delete','Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete','Gagal Hapus Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('jenis');
    }
}
