<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KlasifikasiModel;

class Klasifikasi extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->KlasifikasiModel = new KlasifikasiModel();
    }

    public function index()
    {
        $data['klasifikasi'] = $this->KlasifikasiModel->getData()->getResultArray();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("klasifikasi", $data);
        echo view("layout/footer");
    }

    public function add()
    {
        $klasifikasi1 = $this->request->getPost('klasifikasi1');
        $klasifikasi2 = $this->request->getPost('klasifikasi2');
        $klasifikasi3 = $this->request->getPost('klasifikasi3');
        $kodebaru = $this->request->getPost('kode_baru');
        $data = [
            'klasifikasi1' => $klasifikasi1,
            'klasifikasi2' => $klasifikasi2,
            'klasifikasi3' => $klasifikasi3,
            'kode' => $kodebaru
        ];
        
        if ($this->KlasifikasiModel->insertData($data) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('klasifikasi');
    }

    public function edit() {
        $id = $this->request->getPost('id');
        $kode = $this->request->getPost('kode');
        $klasifikasi1 = $this->request->getPost('klasifikasi1');
        $klasifikasi2 = $this->request->getPost('klasifikasi2');
        $klasifikasi3 = $this->request->getPost('klasifikasi3');

        $array = [
            'kode' => $kode,
            'klasifikasi1' => $klasifikasi1,
            'klasifikasi2' => $klasifikasi2,
            'klasifikasi3' => $klasifikasi3
        ];

        if ($this->KlasifikasiModel->editData($id,$array) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Update Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Update Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('klasifikasi');
        
    }

    public function delete() {
        $id = $this->request->getPost('id');

        if ($this->KlasifikasiModel->deleteData($id) == true) {
            $this->session->setFlashdata('pesan_delete','Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete','Gagal Hapus Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect('klasifikasi');
    }
}
