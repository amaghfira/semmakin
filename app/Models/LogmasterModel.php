<?php

namespace App\Models;

use CodeIgniter\Model;

class LogmasterModel extends Model
{
    protected $table                = 'master_logs';
    protected $primaryKey           = 'id';
    protected $useTimeStamps        = true;
    protected $allowedFields        = ['id','username','id_satker','id_master','ket','created_at'];
}
