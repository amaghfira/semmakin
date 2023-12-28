<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\P3keModel;
use App\Models\UserModel;

class AdminController extends BaseController
{

    public function __construct()
    {
        $this->session = session();   
        $this->P3keModel = new P3keModel();   
        $this->AdminModel = new AdminModel(); 
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        
    }

    public function kelolaUser() {
        $users = $this->UserModel->getUsers()->getResultArray();
        $data['users'] = $users;

        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("admin/kelola_user", $data);
        echo view("layout/footer");
    }

    public function addUser() {
        $username_baru = $this->request->getPost('username_baru');
        $role_baru = $this->request->getPost('role_baru');
        $password_baru = $this->request->getPost('password_baru');
        $password_verif = $this->request->getPost('password_verif');
        $instansi_baru = $this->request->getPost('instansi_baru');
        $alamat_baru = $this->request->getPost('alamat_baru');
        $telp_baru = $this->request->getPost('telp_baru');
        $email_baru = $this->request->getPost('email_baru');
        $faksimile_baru = $this->request->getPost('faksimile_baru');     
        
        $data = [
            'username'  => $username_baru,
            'role'      => $role_baru,
            'password'  => $password_baru,
            'instansi'  => $instansi_baru,
            'alamat'    => $alamat_baru,
            'no_telepon' => $telp_baru,
            'faksimile' => $faksimile_baru,
            'email'     => $email_baru
        ];

        if ($this->UserModel->addUser($data) == true) {
            $this->session->setFlashdata('pesan_add','Berhasil Tambah Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_add','Gagal Tambah Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect()->to('/kelola');
    }

    public function editUser() {
        $id = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $role = $this->request->getPost('role');
        $password_lama = $this->request->getPost('password_lama');
        $password_baru = $this->request->getPost('password_baru');

        $data = [
            'username'  => $username,
            'role'      => $role,
            'password'  => $password_baru
        ];

        if ($this->UserModel->updateUser($id, $data) == true) {
            $this->session->setFlashdata('pesan_update','Berhasil Update Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_update','Gagal Update Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect()->to('/kelola');
    }

    public function deleteUser() {
        $id = $this->request->getPost('id');

        if ($this->UserModel->deleteUser($id) == true) {
            $this->session->setFlashdata('pesan_delete','Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class','alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete','Gagal Hapus Data');
            $this->session->setFlashdata('alert-class','alert-danger');
        }

        return redirect()->to('/kelola');
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
