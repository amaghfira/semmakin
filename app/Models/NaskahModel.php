<?php

namespace App\Models;

use CodeIgniter\Model;

class NaskahModel extends Model
{
    // protected $DBGroup              = 'default';
    // protected $table                = 'naskahs';
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
    }

    function insertNaskahMasuk($array) {
        $builder = $this->db->table('naskah_masuk');
        if ($builder->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    function insertNaskahKeluar($array) {
        $builder = $this->db->table('naskah_keluar');
        if ($builder->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    function insertLog($array) {
        $builder = $this->db->table('log_naskah');
        if ($builder->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    function insertNomor($array) {
        $builder = $this->db->table('nomor_surat');
        if ($builder->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    function getDataMasuk() {
        $builder = $this->db->table('naskah_masuk');
        return $builder->get();
    }

    function getDataKeluar() {
        $builder = $this->db->table('naskah_keluar');
        return $builder->get();
    }

    function getDataMasukId($id) {
        $builder = $this->db->table('naskah_masuk');
        return $builder->select()
                        ->where('id',$id)
                        ->get();
    }

    function getDataKeluarId($id) {
        $builder = $this->db->table('naskah_keluar');
        return $builder->select()
                        ->where('id',$id)
                        ->get();
    }

    function getLogMasuk() {
        $builder = $this->db->table('log_naskah');
        return $builder->select()
                        ->where('aksi','Menambah Surat Masuk')
                        ->get();
    }

    function getLogKeluar() {
        $builder = $this->db->table('log_naskah');
        return $builder->select()
                        ->where('aksi','Menambah Surat Keluar')
                        ->get();
    }

    function downloadNaskahMasuk($id) {
        $builder = $this->db->table('naskah_masuk');
        return $builder->select(['path_naskah','path_lampiran'])
                        ->where('id',$id)
                        ->get();
    }

    function downloadNaskahKeluar($id) {
        $builder = $this->db->table('naskah_keluar');
        return $builder->select(['path_naskah','path_lampiran'])
                        ->where('id',$id)
                        ->get();
    }

    function getTemplates() {
        $builder = $this->db->table('templates');
        return $builder->get();
    }

    function downloadTemplates($id) {
        $builder = $this->db->table('templates');
        return $builder->where('id',$id)
                        ->get();
    }

    function getIndeksBidang($no) {
        $builder = $this->db->table('nomor_surat');
        return $builder->select('indeks_bid')
                        ->where('indeks_org',$no)
                        ->get();
    }

    function getNo($ind) {
        $builder = $this->db->table('nomor_surat');
        return $builder->selectMax('nomor')
                        ->where('indeks_bid',$ind)
                        ->get();
    }

    function editData($id,$array) {
        $builder = $this->db->table('naskah_masuk');
        $builder->where('id',$id);
        if ($builder->update($array)) {
            return true;
        } else {
            false;
        }
    }

    function editDataKeluar($id,$array) {
        $builder = $this->db->table('naskah_keluar');
        $builder->where('id',$id);
        if ($builder->update($array)) {
            return true;
        } else {
            false;
        }
    }

    function deleteData($id) {
        $builder = $this->db->table('naskah_masuk');
        if ($builder->delete(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    function deleteDataKeluar($id) {
        $builder = $this->db->table('naskah_keluar');
        if ($builder->delete(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    
}
