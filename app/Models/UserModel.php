<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->user = $this->db->table('users');
    }

    public function login($username,$password) {
        $user = $this->user->where('username',$username)->get()->getRow();

        if (!empty($user->username)) {
            if ($user->password != sha1($user->salt.$password)) {
                // jika password tidak sesuai
                return null;
            } else {
                // jika password sesuai
                return $user;
            }
        } else {
            // jika username not found 
            return null;
        }
    }
}

?>