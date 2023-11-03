<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UrgensiModel;

class Urgensi extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->UrgensiModel = new UrgensiModel();
    }

    public function index()
    {
        $data['urgensi'] = $this->UrgensiModel->getData()->getResultArray();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("urgensi", $data);
        echo view("layout/footer");
    }

    public function add()
    {
        $urgensibaru = $this->request->getPost('urgensi_baru');
        $data = [
            'urgensi' => $urgensibaru
        ];
        
        if ($this->UrgensiModel->insertData($data) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('urgensi');
    }

    public function edit() {
        $id = $this->request->getPost('id');
        $urgensi = $this->request->getPost('urgensi');

        $array = [
            'urgensi' => $urgensi
        ];

        if ($this->UrgensiModel->editData($id,$array) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Update Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Update Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('urgensi');
        
    }

    public function delete() {
        $id = $this->request->getPost('id');

        if ($this->UrgensiModel->deleteData($id) == true) {
            $this->session->setFlashdata('pesan_delete','Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete','Gagal Hapus Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('urgensi');
    }
}
