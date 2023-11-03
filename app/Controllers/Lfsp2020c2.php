<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Lfsp2020c2 extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function index()
    {
        // ambil data untuk bar chart jml blok sensus selesai, on progress, total 
        $query = $this->db->query("SELECT * FROM `c2_agregat`");
        $datatotal = [];

        $i = 0;
        $limit = 10;

        while ($i < $limit) {

            $datatotal[] = (int)$query->getRow($i)->total_dsbs;
            $dataupload[] = (int)$query->getRow($i)->updated;
            $databelum[] = (int)$query->getRow($i)->belum;
            $dataprogress[] = (int)$query->getRow($i)->progress;
            $dataselesai[] = (int)$query->getRow($i)->selesai;
            ++$i;
        }
        $data['total_bs'] = json_encode($datatotal);
        $data['update_bs'] = json_encode($dataupload);
        $data['belum_bs'] = json_encode($databelum);
        $data['progress_bs'] = json_encode($dataprogress);
        $data['selesai_bs'] = json_encode($dataselesai);


        // ambil data untuk choropleth map 
        $query = $this->db->query("SELECT selesai * 100 / total_dsbs as persen FROM `c2_agregat`");

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
        $query = $this->db->query("SELECT SUM(updated) AS selesai, SUM(total_dsbs) AS `target`, (SUM(total_dsbs) - SUM(updated)) AS belum FROM c2_agregat");
        $data['target'] = $query->getRow()->target;
        $data['selesai'] = $query->getRow()->selesai;
        $data['belum'] = $query->getRow()->belum;


        // ambil data untuk bar chart jml blok sensus yg sudah diupdate per koseka
        $kodekab = $this->request->getPost('kosekakabkot');

        $query2 = $this->db->query("SELECT kode_kabkot, nama_koseka, (bs_updated_new * 100 / bs_total) AS persen 
                                    FROM bs_koseka_agregat_c2 
                                    WHERE kode_kabkot='$kodekab'");

        $persenkoseka = [];
        $namakoseka = [];

        foreach ($query2->getResult() as $row) {
            $persenkoseka[] = (int)$row->persen;
            $namakoseka[] = $row->nama_koseka;
        }

        $data['persenkoseka'] = json_encode($persenkoseka);
        $data['namakoseka'] = json_encode($namakoseka);

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar_c2');
        echo view('c2_home', $data);
        echo view('layout/footer');
    }

    public function entry()
    {
        // Show Form Entry
        // get username
        $nama = $this->session->nama;

        // ambil nama dari tabel petugas
        $builder = $this->db->table('dsbs_pemutakhiran');
        $builder->where('nama_ppl', $nama);
        $builder->orWhere('nama_kortim', $nama);
        $builder->orWhere('nama_koseka', $nama);
        $data['dsbs_ppl'] = $builder->get()->getResultArray();


        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar_c2', $data);
        echo view('show_entry');
        echo view('layout/footer');
    }

    public function update()
    {
        $nama = $this->session->nama;
        $bs = $this->request->getPost('bs');
        $kodekab = $this->request->getPost('kodekabkot');
        $kodekec = $this->request->getPost('kodekec');
        $kodedesa = $this->request->getPost('kodedesa');
        $rtselesai = $this->request->getPost('rtselesai');
        $jmlkematian = $this->request->getPost('jmlkematian');
        $jmlkematianibu = $this->request->getPost('jmlkematianibu');
        $now = Time::now('Asia/Singapore', 'en_US');
        
        if ($rtselesai == 16) {
            $status = 1; //selesai
        } else if ($rtselesai == 0) {
            $status = 0; //belum
        } else {
            $status = 2; //on progress
        }

        $buildercek = $this->db->table('dsbs_pemutakhiran');
        $buildercek->where('kode_kabkot', $kodekab);
        $buildercek->where('kode_kec', $kodekec);
        $buildercek->where('kode_desa', $kodedesa);
        $buildercek->where('bs', $bs);

        // cek jml kematian ibu > jml kematian 
        if ($jmlkematianibu > $jmlkematian) {
            $this->session->setFlashdata('pesan_edit', 'Jumlah kematian ibu tidak boleh > jml kematian');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            if ($buildercek->countAllResults() == 0) {
                $this->session->setFlashdata('pesan_edit', 'Gagal Simpan Data. Data BS yang dimasukkan tidak sesuai');
                $this->session->setFlashdata('alert-class', 'alert-danger');
            } else {
                // get nama kabkot, nama kec, nama desa ada di tabel dsbs pemutakhiran 
                $builder = $this->db->table('dsbs_pemutakhiran');
                $builder->where('kode_kabkot', $kodekab);
                $builder->where('kode_kec', $kodekec);
                $builder->where('kode_desa', $kodedesa);
                $builder->where('bs', $bs);
                $nama = $builder->get()->getRow();

                // cek jika sudah ada di monitoring c2
                $buildercekc2 = $this->db->table('monitoring_c2');
                $buildercekc2->where('kode_kabkot', $kodekab);
                $buildercekc2->where('kode_kec', $kodekec);
                $buildercekc2->where('kode_desa', $kodedesa);
                $buildercekc2->where('bs', $bs);

                // jk tidak ditemukan, insert   
                if ($buildercekc2->countAllResults() == 0) {
                    // insert to monitoring c2
                    $data = [
                        'kode_kabkot'      => $kodekab,
                        'nama_kabkot'   => $nama->nama_kabkot,
                        'kode_kec'      => $kodekec,
                        'nama_kec'      => $nama->nama_kec,
                        'kode_desa'     => $kodedesa,
                        'nama_desa'     => $nama->nama_desa,
                        'bs'            => $bs,
                        'nama_ppl'      => $nama->nama_ppl,
                        'nama_kortim'   => $nama->nama_kortim,
                        'nama_koseka'   => $nama->nama_koseka,
                        'rt_selesai'    => $rtselesai,
                        'jml_kematian'  => $jmlkematian,
                        'jml_kematian_ibu' => $jmlkematianibu,
                        'status'        => $status,
                        'created_at'    => $now,
                        'created_by'    => $this->session->nama,
                        'role'          => $this->session->role
                    ];
                    $builder2 = $this->db->table('monitoring_c2');
                    $query = $builder2->insert($data);

                    if (!$query) {
                        $this->session->setFlashdata('pesan_edit', 'Gagal Menyimpan Data');
                        $this->session->setFlashdata('alert-class', 'alert-danger');
                    } else {
                        $this->session->setFlashdata('pesan_edit', 'Berhasil Menyimpan Data');
                        $this->session->setFlashdata('alert-class', 'alert-success');
                    }
                } else { //jk ditemukan, update  
                    $data = [
                        'rt_selesai'    => $rtselesai,
                        'jml_kematian'  => $jmlkematian,
                        'jml_kematian_ibu' => $jmlkematianibu,
                        'status'        => $status,
                        'updated_at'    => $now,
                        'updated_by'    => $this->session->nama,
                        'role'          => $this->session->role
                    ];
                    $builder3 = $this->db->table('monitoring_c2');
                    $builder3->where('kode_kabkot', $kodekab);
                    $builder3->where('kode_kec', $kodekec);
                    $builder3->where('kode_desa', $kodedesa);
                    $builder3->where('bs', $bs);
                    $query = $builder3->update($data);

                    if (!$query) {
                        $this->session->setFlashdata('pesan_edit', 'Gagal Update Data');
                        $this->session->setFlashdata('alert-class', 'alert-danger');
                    } else {
                        $this->session->setFlashdata('pesan_edit', 'Berhasil Update Data');
                        $this->session->setFlashdata('alert-class', 'alert-success');
                    }
                }
            }
        }


        return redirect()->back();
    }

    public function tabel()
    {
        $nama = $this->session->nama;
        $builder = $this->db->table('monitoring_c2');
        $builder->where('nama_kortim', $nama);
        $builder->orWhere('nama_koseka', $nama);
        $builder->orWhere('nama_ppl', $nama);
        $query = $builder->get();

        $builder2 = $this->db->table('monitoring_c2');
        $query2 = $builder2->get();

        $data['monitoring'] = $query->getResultArray();
        $data['monitoring_organik'] = $query2->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar_c2');
        echo view('show_tabel_c2', $data);
        echo view('layout/footer');
    }
}
