<?php

namespace App\Models;

use CodeIgniter\Model;

class P3keModel extends Model
{
    // protected $DBGroup              = 'default';
    // protected $table                = 'p3kes';
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
        $this->mastertabel = $this->db->table('master_p3ke');
        $this->data = $this->db->table('p3ke');
    }

    public function getP3ke() {
        return $this->data->get();
    }

    public function getDesil() {
        return $this->mastertabel->where('alias','desil')
                                ->get();
    }

    public function getPadanDukcapil() {
        return $this->mastertabel->where('alias','padan_dukcapil')
                                ->get();
    }

    public function getJK() {
        return $this->mastertabel->where('alias','jk')
                                ->get();
    }

    public function getPekerjaan() {
        return $this->mastertabel->where('alias','pekerjaan')
                                ->get();
    }

    public function getPendidikan() {
        return $this->mastertabel->where('alias','pendidikan')
                                ->get();
    }

    public function getKepemilikanRumah() {
        return $this->mastertabel->where('alias','kepemilikan_rumah')
                                ->get();
    }

    public function getSimpanan() {
        return $this->mastertabel->where('alias','simpanan')
                                ->get();
    }

    public function getJenisAtap() {
        return $this->mastertabel->where('alias','jenis_atap')
                                ->get();
    }

    public function getJenisDinding() {
        return $this->mastertabel->where('alias','jenis_dinding')
                                ->get();
    }

    public function getJenisLantai() {
        return $this->mastertabel->where('alias','jenis_lantai')
                                ->get();
    }

    public function getSumberPenerangan() {
        return $this->mastertabel->where('alias','sumber_penerangan')
                                ->get();
    }

    public function getBahanBakar() {
        return $this->mastertabel->where('alias','bahan_bakar')
                                ->get();
    }

    public function getAirMinum() {
        return $this->mastertabel->where('alias','air_minum')
                                ->get();
    }

    public function getFasilitasBab() {
        return $this->mastertabel->where('alias','fasilitas_bab')
                                ->get();
    }

    public function getbnpt() {
        return $this->mastertabel->where('alias','bnpt')
                                ->get();
    }

    public function getbpum() {
        return $this->mastertabel->where('alias','bpum')
                                ->get();
    }

    public function getbst() {
        return $this->mastertabel->where('alias','bst')
                                ->get();
    }

    public function getpkh() {
        return $this->mastertabel->where('alias','pkh')
                                ->get();
    }

    public function getsembako() {
        return $this->mastertabel->where('alias','sembako')
                                ->get();
    }

    public function insertData($array) {
        if ($this->data->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMiskinEkstremByDesa() {
        $query = "SELECT desa, COUNT(*) as value FROM p3ke WHERE desil=1 GROUP BY desa";
        return $this->db->query($query);
    }

}
