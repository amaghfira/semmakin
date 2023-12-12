<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController
{

    public function __construct()
    {
        // membuat user model utk koneksi ke db 
        $this->userModel = new UserModel();

        // load validation 
        $this->validation =  \Config\Services::validation();

        // load session 
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function valid_login()
    {
        // ambil data dari form 
        // $data = $this->request->getPost();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cocokkan username post dan db 
        $user = $this->userModel->login($username, $password);
        if ($user == null) {
            // password umatch, jangan process login 
            session()->setFlashData('password','Username/Password Salah');
            return redirect()->to('auth/login');
        } else {
            // password match, user ditemukan, prosess login
            $sessLogin = [
                'isLogin' => true,
                'username' => $user->username,
                'instansi' => $user->instansi,
                'userid'    => $user->userid,
                'role'      => $user->role
            ];
            $this->session->set($sessLogin);
            return redirect('/');
        }
        return redirect()->back();
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}
