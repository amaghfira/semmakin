<?php

namespace App\Models;

use CodeIgniter\Model;

class NaskahKeluarModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'naskah_keluar';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['unit_kerja', 'tgl_naskah', 'jenis', 'sifat', 'urgensi', 'klasifikasi', 'nomor_naskah', 'nomor_referensi', 'hal',
                                    'ringkasan', 'path_naskah', 'path_lampiran', 'tujuan_internal', 'tujuan_eksternal', 'tembusan_internal',
                                    'tembusan_eksternal', 'ttd'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    public function insertData($array) {
        if ($this->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    public function getData() {
        return $this->findAll();
    }
}
