<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadModel extends Model
{
    protected $table                = 'monitoring';
    protected $primaryKey           = 'id';
    protected $useTimeStamps        = false;
    protected $allowedFields        = ['id','kode_wil','nama_kabkot','nbs','nks','kategori_bs','jml_kk_sp','hasil_pemutakhiran','jml_kk_hasil_pemutakhiran','jml_rt_hasil_pemutakhiran','jml_art','jml_rt_kematian'];
}
