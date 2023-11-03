<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
    
    public function __construct()
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('klasifikasi') ;
    }

    public function getData() {
        return $this->builder->get();
    }

    public function insertData($array) {
        if ($this->builder->insert($array)) {
            return true;
        } else {
            false;
        }
    }

    public function editData($id,$array) {
        $this->builder->where('id',$id);
        if ($this->builder->update($array)) {
            return true;
        } else {
            false;
        }
    }

    public function deleteData($id) {
        $this->builder->where('id',$id);
        if ($this->builder->delete()) {
            return true;
        } else {
            false;
        }
    }
}
