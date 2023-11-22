<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\P3keModel;
use CodeIgniter\I18n\Time;

class FormController extends BaseController
{

    public function __construct()
    {
        $this->session = session();   
        $this->P3keModel = new P3keModel();
    }

    public function index()
    {
        // load views
        echo view("layout/header");
        echo view("layout/sidebar");
        echo view("layout/navbar");
        echo view("kemiskinan/entri");
        echo view("layout/footer");
    }

    public function getFormP3KE() {

        // get data from db and send to the form 
        $desil = $this->P3keModel->getDesil()->getResultArray();
        $padan = $this->P3keModel->getPadanDukcapil()->getResultArray();
        $jk = $this->P3keModel->getJK()->getResultArray();
        $pekerjaan = $this->P3keModel->getPekerjaan()->getResultArray();
        $pendidikan = $this->P3keModel->getPendidikan()->getResultArray();
        $rumah = $this->P3keModel->getKepemilikanRumah()->getResultArray();
        $simpanan = $this->P3keModel->getSimpanan()->getResultArray();
        $atap = $this->P3keModel->getJenisAtap()->getResultArray();
        $dinding = $this->P3keModel->getJenisDinding()->getResultArray();
        $lantai = $this->P3keModel->getJenisLantai()->getResultArray();
        $penerangan = $this->P3keModel->getSumberPenerangan()->getResultArray();
        $bahanbakar = $this->P3keModel->getBahanBakar()->getResultArray();
        $airminum = $this->P3keModel->getAirMinum()->getResultArray();
        $bab = $this->P3keModel->getFasilitasBab()->getResultArray();
        $bnpt = $this->P3keModel->getbnpt()->getResultArray();
        $bpum = $this->P3keModel->getbpum()->getResultArray();
        $bst = $this->P3keModel->getbst()->getResultArray();
        $pkh = $this->P3keModel->getpkh()->getResultArray();
        $sembako = $this->P3keModel->getsembako()->getResultArray();

        $data['desil'] = $desil;
        $data['padan'] = $padan;
        $data['jk'] = $jk;
        $data['pekerjaan'] = $pekerjaan;
        $data['pendidikan'] = $pendidikan;
        $data['rumah'] = $rumah;
        $data['simpanan'] = $simpanan;
        $data['atap'] = $atap;
        $data['dinding'] = $dinding;
        $data['lantai'] = $lantai;
        $data['penerangan'] = $penerangan;
        $data['bahanbakar'] = $bahanbakar;
        $data['airminum'] = $airminum;
        $data['bab'] = $bab;
        $data['bnpt'] = $bnpt;
        $data['bpum'] = $bpum;
        $data['bst'] = $bst;
        $data['pkh'] = $pkh;
        $data['sembako'] = $sembako;

        $formView = view('kemiskinan/form_p3ke', $data);
        return $this->response->setJSON(['form' => $formView]);
    }

    function insert() {
        // get from user input 
        $tahun    = $this->request->getPost('tahun');
        $prov    = $this->request->getPost('prov');
        $kab    = $this->request->getPost('kab');
        $kec    = $this->request->getPost('kec');
        $desa    = $this->request->getPost('desa');
        $desil    = $this->request->getPost('desil');
        $alamat    = $this->request->getPost('alamat');
        $kk    = $this->request->getPost('kk');
        $nik    = $this->request->getPost('nik');
        $padan_dukcapil    = $this->request->getPost('padan_dukcapil');
        $jk    = $this->request->getPost('jk');
        $tgl_lahir    = $this->request->getPost('tgl_lahir');
        $pekerjaan    = $this->request->getPost('pekerjaan');
        $pendidikan    = $this->request->getPost('pendidikan');
        $rumah    = $this->request->getPost('rumah');
        $simpanan    = $this->request->getPost('simpanan');
        $atap    = $this->request->getPost('atap');
        $dinding    = $this->request->getPost('dinding');
        $lantai    = $this->request->getPost('lantai');
        $penerangan    = $this->request->getPost('penerangan');
        $bahanbakar    = $this->request->getPost('bahanbakar');
        $airminum    = $this->request->getPost('airminum');
        $bab    = $this->request->getPost('bab');
        $bnpt    = $this->request->getPost('bnpt');
        $bpum    = $this->request->getPost('bpum');
        $bst    = $this->request->getPost('bst');
        $pkh    = $this->request->getPost('pkh');
        $sembako    = $this->request->getPost('sembako');

        $data = [
            'tahun' => $tahun,
            'prov'  => $prov,
            'kab'   => $kab,
            'kec'   => $kec,
            'desa'  => $desa,
            'desil' => $desil,
            'alamat' => $alamat,
            'kk'    => $kk,
            'nik'   => $nik,
            'padan_dukcapil'=> $padan_dukcapil,
            'jk'    => $jk,
            'tgl_lahir'     => $tgl_lahir,
            'pekerjaan'     => $pekerjaan,
            'pendidikan'    => $pendidikan,
            'kepemilikan_rumah' => $rumah,
            'simpanan'      => $simpanan,
            'jenis_atap'    => $atap,
            'jenis_dinding' => $dinding,
            'jenis_lantai'  => $lantai,
            'sumber_penerangan'     => $penerangan,
            'bahan_bakar_memasak'   => $bahanbakar,
            'sumber_air_minum'  => $airminum,
            'fasilitas_bab'     => $bab,
            'penerima_bnpt'     => $bnpt,
            'penerima_bpum'     => $bpum,
            'penerima_bst'      => $bst,
            'penerima_pkh'      => $pkh,
            'penerima_sembako'  => $sembako,
            'userid'    => $this->session->username,
            'created_at' => Time::now('Asia/Singapore', 'en_US')
        ];

        // set session data
        if ($this->P3keModel->insertData($data) == true) {
            $this->session->setFlashdata('insert_message', 'Berhasil Menambahkan Data');
            $this->session->setFlashdata('alert-class', 'alert-success');
        } else {
            $this->session->setFlashdata('insert_message', 'Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->to('/entri');
    }
}
