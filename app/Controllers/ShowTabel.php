<?php

namespace App\Controllers;
use App\Models\UploadModel;

class ShowTabel extends BaseController {

    public function index() {
        $session = session();
        $db = \Config\Database::connect();
        $uploadModel = new UploadModel();
        
        // get table 
        // hanya tampilkan punya satker masing2 kecuali orang prov 
        if ($_SESSION['id_satker'] == '6400') {
            $query = $db->query("SELECT m.*,l.id_satker, d.nama_kec, d.nama_desa 
                                FROM monitoring m, upload_logs l, master_data d 
                                WHERE m.id = l.id_mon
                                AND m.kode_wil = d.kode_wil
                                AND m.nbs = d.nbs
                                AND m.nks = d.nks");
            $data['uploads'] = $query->getResultArray();    
        } else {
            $query = $db->query("SELECT m.*,l.id_satker, d.nama_kec, d.nama_desa 
            FROM monitoring m, upload_logs l, master_data d 
            WHERE l.id_satker = '$session->id_satker' 
            AND m.id = l.id_mon
            AND m.kode_wil = d.kode_wil
            AND m.nbs = d.nbs 
            AND m.nks = d.nks");
            $data['uploads'] = $query->getResultArray();
        }

        // get data untuk filter 
        $nama_kabkot = $db->query("SELECT DISTINCT nama_kabkot as nama FROM master_data");
        $nama_kec = $db->query("SELECT DISTINCT nama_kec as nama FROM master_data");
        
        $data['nama_kabkot'] = $nama_kabkot->getResultArray();
        $data['nama_kec'] = $nama_kec->getResultArray();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("show_tabel",$data);
        echo view("layout/footer");
    }

}

?>