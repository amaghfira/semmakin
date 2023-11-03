<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SifatModel;

class Sifat extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->SifatModel = new SifatModel();
    }

    public function index()
    {
        $data['sifat'] = $this->SifatModel->getData()->getResultArray();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("sifat", $data);
        echo view("layout/footer");
    }

    public function add()
    {
        $sifatbaru = $this->request->getPost('sifat_baru');
        $kodebaru = $this->request->getPost('kode_baru');
        $data = [
            'sifat' => $sifatbaru,
            'kode' => $kodebaru
        ];
        
        if ($this->SifatModel->insertData($data) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('sifat');
    }

    public function edit() {
        $id = $this->request->getPost('id');
        $sifat = $this->request->getPost('sifat');
        $kode = $this->request->getPost('kode');

        $array = [
            'sifat' => $sifat,
            'kode' => $kode
        ];

        if ($this->SifatModel->editData($id,$array) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Update Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Update Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('sifat');
        
    }

    public function delete() {
        $id = $this->request->getPost('id');

        if ($this->SifatModel->deleteData($id) == true) {
            $this->session->setFlashdata('pesan_delete','Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete','Gagal Hapus Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('sifat');
    }
}
