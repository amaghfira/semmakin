<?php

namespace App\Controllers;

use App\Models\UploadModel;

class Pemutakhiranlfsp2020 extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function index()
    {
        $session = session();
        $db = \Config\Database::connect();

        // ambil data untuk bar chart jml blok sensus yg sudah diupdate
        $query = $db->query("SELECT total_dsbs, jml_updated FROM `dsbs_agregat`");
        $datatotal = [];

        $i = 0;
        $limit = 10;

        while ($i < $limit) {

            $datatotal[] = (int)$query->getRow($i)->total_dsbs;
            $dataupload[] = (int)$query->getRow($i)->jml_updated;
            ++$i;
        }
        $data['total_bs'] = json_encode($datatotal);
        $data['update_bs'] = json_encode($dataupload);


        // ambil data untuk choropleth map 
        $query = $db->query("SELECT jml_updated * 100 / total_dsbs as persen FROM `dsbs_agregat`");

        $data['paser'] = $query->getRow()->persen;
        $data['kubar'] = $query->getRow(1)->persen;
        $data['kukar'] = $query->getRow(2)->persen;
        $data['kutim'] = $query->getRow(3)->persen;
        $data['berau'] = $query->getRow(4)->persen;
        $data['ppu'] = $query->getRow(5)->persen;
        $data['mahulu'] = $query->getRow(6)->persen;
        $data['bpp'] = $query->getRow(7)->persen;
        $data['smd'] = $query->getRow(8)->persen;
        $data['bontang'] = $query->getRow(9)->persen;


        // ambil data untuk kotak di kanan 
        $query = $db->query("SELECT SUM(jml_updated) AS selesai, SUM(total_dsbs) AS target, (SUM(total_dsbs) - SUM(jml_updated)) AS belum FROM dsbs_agregat");
        $data['target'] = $query->getRow()->target;
        $data['selesai'] = $query->getRow()->selesai;
        $data['belum'] = $query->getRow()->belum;


        // ambil data untuk bar chart jml blok sensus yg sudah diupdate koseka
        $kodekab = $this->request->getPost('kosekakabkot');

        $query2 = $this->db->query("SELECT kode_kabkot, nama_koseka, (bs_updated_new * 100 / bs_total) AS persen 
                                    FROM bs_koseka_agregat 
                                    WHERE kode_kabkot='$kodekab'");

        $persenkoseka = [];
        $namakoseka = [];

        foreach ($query2->getResult() as $row) {
            $persenkoseka[] = (int)$row->persen;
            $namakoseka[] = $row->nama_koseka;
        }
        
        $data['persenkoseka'] = json_encode($persenkoseka);
        $data['namakoseka'] = json_encode($namakoseka);

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar_pemutakhiran");
        echo view("pemutakhiran_home", $data);
        echo view("layout/footer");
    }

    public function dsbs()
    {

        // ambil dari database tampilkan utk masing2 kabkot kecuali akun prov tampilkan semuanya. 
        if ($this->session->id_satker == '6400') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran");
        }
        if ($this->session->id_satker == '6401') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6401'");
        }
        if ($this->session->id_satker == '6402') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6402'");
        }
        if ($this->session->id_satker == '6403') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6403'");
        }
        if ($this->session->id_satker == '6404') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6404'");
        }
        if ($this->session->id_satker == '6405') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6405'");
        }
        if ($this->session->id_satker == '6409') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6409'");
        }
        if ($this->session->id_satker == '6411') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6411'");
        }
        if ($this->session->id_satker == '6471') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6471'");
        }
        if ($this->session->id_satker == '6472') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6472'");
        }
        if ($this->session->id_satker == '6474') {
            $query = $this->db->query("SELECT * FROM dsbs_pemutakhiran WHERE kode_kabkot = '6474'");
        }

        $data['master'] = $query->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar_pemutakhiran');
        echo view('show_dsbs', $data);
        echo view('layout/footer');
    }

    public function checked()
    {
        $id = $this->request->getPost('checked');
        if (!$id) {
            // jika array kosong (atau tidak ada yg di checked)
            return redirect()->back();
        } else {
            // jika ada yg di checklist
            for ($i = 0; $i < count($id); $i++) {
                $idnew = $id[$i];
                print_r($idnew);

                $this->db->query("UPDATE dsbs_pemutakhiran 
                                    SET `status` = CASE 
                                        WHEN `status` = 1 THEN 0
                                        WHEN `status` = 0 THEN 1 
                                    END
                                    WHERE id = $idnew");
            }
        }
        return redirect()->back();
    }

    public function contact()
    {
        $builder = $this->db->table('contact');
        $query = $builder->get();
        $data['master'] = $query->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar_pemutakhiran');
        echo view('contact',$data);
        echo view('layout/footer');
    }
}
