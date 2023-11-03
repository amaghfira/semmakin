<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = "autentifikasi";
    protected $primaryKey = "username";
    protected $useTimeStamps = false;
    protected $allowedFields = ["username","password","niplama"];
}

?>