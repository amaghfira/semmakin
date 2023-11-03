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
        $db = \Config\Database::connect();
        // ambil data dari form 
        // $data = $this->request->getPost();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cocokkan username post dan db 
        $query = $db->query("SELECT *  FROM users WHERE username = '$username'");
        $user = $query->getRow();
        if (!empty($user->username)) {
            if ($user->password != sha1($user->salt.$password)) {
                session()->setFlashData('password','Password Salah');
                return redirect()->to('auth/login');
            } else {
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'instansi' => $user->instansi,
                    'userid'    => $user->userid
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