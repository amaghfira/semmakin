<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterModel extends Model
{
    protected $table                = 'master_data';
    protected $primaryKey           = 'id';
    protected $useTimeStamps        = false;
    protected $allowedFields        = ['id','kode_wil','nama_kabkot','nbs','nks','jml_kk_sp'];
}
