<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController {

    public function __construct()
    {
        // membuat user model utk koneksi ke db 
        $this->userModel = new UserModel();

        // load validation 
        $this->validation =  \Config\Services::validation();

        // load session 
        $this->session = \Config\Services::session();
    }

    public function login() {
        return view('auth/login');
    }

    public function valid_login() {
        $db = \Config\Database::connect('otherDb');
        // $builder = $db->table('autentifikasi');
        $db2 = db_connect("otherDb");
        // $session = session();
        // ambil data dari form 
        // $data = $this->request->getPost();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cocokkan username post dan db 
        // $builder->select('username,password,autentifikasi.niplama,p.id_org,p.id_satker');
        // $builder->from('master_pegawai p');
        // $builder->where('p.niplama','autentifikasi.niplama');
        // $builder->where('username',$username);
        // $query2 = $builder->get();
        $query = $db2->query("SELECT a.*, p.nama, p.id_org, p.id_satker  FROM autentifikasi a, master_pegawai p WHERE a.niplama = p.niplama AND a.username = '$username'");
        $user = $query->getRow();
        if (!empty($user->username)) {
            if ($user->password != md5($password)) {
                session()->setFlashData('password','Password Salah');
                return redirect()->to('auth/login');
            } else {
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'role' => $user->id_org,
                    'nama' => $user->nama,
                    'id_satker' => $user->id_satker
                ];
                $this->session->set($sessLogin);
                return redirect('/');
            }
        }

        return redirect()->back();
        
    }

    public function logout() {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}

?>