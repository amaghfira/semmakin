<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    // protected $DBGroup              = 'otherDb';
    // protected $table                = 'master_pegawai';
    // protected $primaryKey           = 'id';
    // protected $useAutoIncrement     = true;
    // protected $insertID             = 0;
    // protected $returnType           = 'array';
    // protected $useSoftDeletes       = false;
    // protected $protectFields        = true;
    // protected $allowedFields        = ['gelar_depan','nama','gelar_belakang'];

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

    protected $db2;

    public function __construct()
    {
        $this->db = db_connect('otherDb');
    }

    function getNama() {
        $builder = $this->db->table('master_pegawai');
        return $builder->select()
                        ->where('id_satker','6400')
                        ->orderBy('nama','ASC')
                        ->get();
    }

    function getNamaByEmail($array) {
        $builder = $this->db->table('master_pegawai');
        return $builder->select()
                        ->whereIn('email',$array)
                        ->get();
    }
}
