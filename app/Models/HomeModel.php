<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    // protected $DBGroup              = 'default';
    // protected $table                = 'homes';
    // protected $primaryKey           = 'id';
    // protected $useAutoIncrement     = true;
    // protected $insertID             = 0;
    // protected $returnType           = 'array';
    // protected $useSoftDeletes       = false;
    // protected $protectFields        = true;
    // protected $allowedFields        = [];

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

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->dataP3ke = $this->db->table('p3ke');
        // $this->dataDtks = $this->db->table('dtks');
    }

    public function getMiskinEkstremByPekerjaan() {
        return $this->dataP3ke
                    ->select('pekerjaan, COUNT(*) jml')
                    ->where('desil',1)
                    ->groupBy('pekerjaan')
                    ->get();
    }

    public function getMiskinEkstremByPendidikan() {
        return $this->dataP3ke
                    ->select('pendidikan, COUNT(*) jml')
                    ->where('desil',1)
                    ->groupBy('pendidikan')
                    ->get();
    }

    public function getMiskinEkstremByJk() {
        $query = "
                    SELECT 
                        jk as name,
                        COUNT(jk) / (SELECT COUNT(*) FROM p3ke WHERE desil = 1) * 100 AS y
                    FROM 
                        p3ke
                    WHERE 
                        desil = 1
                    GROUP BY 
                        jk
                ";
        return $this->db->query($query);        
    }

    public function getJmlMiskinEkstrim() {
        $query = "
            SELECT COUNT(*) as jmltotal
            FROM p3ke
            WHERE desil=1
            GROUP BY kab
        ";

        return $this->db->query($query);
    }

    public function getMiskinEkstremByRumah() {
        return $this->dataP3ke
                    ->select('kepemilikan_rumah as name, COUNT(*) as y')
                    ->where('desil',1)
                    ->groupBy('kepemilikan_rumah')
                    ->get();
    }
}
