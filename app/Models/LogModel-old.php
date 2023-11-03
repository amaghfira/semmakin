<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table                = 'upload_logs';
    protected $primaryKey           = 'id';
    protected $useTimeStamps        = true;
    protected $allowedFields        = ['id','username','id_satker','id_mon','created_at'];
}
