<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    // protected $table = "autentifikasi";
    // protected $primaryKey = "username";
    // protected $useTimeStamps = false;
    // protected $allowedFields = ["username","password","niplama"];

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->user = $this->db->table('users');
    }

    public function login($username) {
        return $this->user->where('username',$username)
                                ->get();
    }
}

?>