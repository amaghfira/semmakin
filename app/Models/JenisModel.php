<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    // protected $DBGroup              = 'default';
    // protected $table                = 'jenis';
    // protected $primaryKey           = 'id';
    // protected $useAutoIncrement     = true;
    // protected $insertID             = 0;
    // protected $returnType           = 'array';
    // protected $useSoftDeletes       = false;
    // protected $protectFields        = true;
    // protected $allowedFields        = ['id','jenis'];

    // // Dates
    // protected $useTimestamps        = false;
    // protected $dateFormat           = 'datetime';
    // protected $createdField         = 'created_at';
    // protected $updatedField         = 'updated_at';
    // protected $deletedField         = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks       = true;
    // protected $beforeInsert         = [];
    // protected $afterInsert          = [];
    // protected $beforeUpdate         = [];
    // protected $afterUpdate          = [];
    // protected $beforeFind           = [];
    // protected $afterFind            = [];
    // protected $beforeDelete         = [];
    // protected $afterDelete          = [];

    public function __construct()
    {
        $db      = \Config\Database::connect();
        $this->builder = $db->table('jenis') ;
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
