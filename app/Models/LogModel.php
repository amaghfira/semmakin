<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table                = 'upload_logs';
    protected $primaryKey           = 'id';
    protected $useTimeStamps        = true;
    protected $allowedFields        = ['id','username','nama','created_at','aksi'];
}
