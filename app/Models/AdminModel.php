<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->menus = $this->db->table('daftar_analisis');
        $this->detailTabel = $this->db->table('detail_analisis');
    }

    public function insertData($array) {
        if ($this->detailTabel->insert($array)) {
            return true;
        } else {
            false;
        }
    }

    public function updateData($id,$array) {
        if ($this->detailTabel->where('id',$id)->update($array)) {
            return true;
        } else {
            false;
        }
    }

    public function cekDataById($id,$tahun) {
        $result = $this->detailTabel->where('id',$id)
                                    ->where('tahun',$tahun)
                                    ->get()
                                    ->getResult();

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }

    }

    
}
