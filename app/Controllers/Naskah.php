<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IndeksModel;
use App\Models\JenisModel;
use App\Models\KlasifikasiModel;
use App\Models\NaskahKeluarModel;
use App\Models\NaskahMasukModel;
use App\Models\NaskahModel;
use App\Models\PegawaiModel;
use App\Models\SifatModel;
use App\Models\UrgensiModel;
use CodeIgniter\I18n\Time;

class Naskah extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->NaskahModel = new NaskahModel();
        $this->NaskahMasukModel = new NaskahMasukModel();
        $this->NaskahKeluarModel = new NaskahKeluarModel();
        $this->PegawaiModel = new PegawaiModel();
        $this->JenisModel = new JenisModel();
        $this->SifatModel = new SifatModel();
        $this->UrgensiModel = new UrgensiModel();
        $this->KlasifikasiModel = new KlasifikasiModel();
        $this->IndeksModel = new IndeksModel();
    }

    public function index()
    {
        //
    }

    // show form registrasi naskah masuk 
    public function reg_masuk()
    {
        $jenis      = $this->JenisModel->getData()->getResultArray();
        $sifat      = $this->SifatModel->getData()->getResultArray();
        $urgensi      = $this->UrgensiModel->getData()->getResultArray();
        $pegawai = $this->PegawaiModel->getNama()->getResultArray();

        $data['pegawai'] = $pegawai;
        $data['jenis'] = $jenis;
        $data['sifat'] = $sifat;
        $data['urgensi'] = $urgensi;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("req_naskah_masuk", $data);
        echo view("layout/footer");
    }

    // show form registrasi naskah keluar
    public function reg_keluar()
    {

        $pegawai    = $this->PegawaiModel->getNama()->getResultArray();
        $jenis      = $this->JenisModel->getData()->getResultArray();
        $sifat      = $this->SifatModel->getData()->getResultArray();
        $urgensi      = $this->UrgensiModel->getData()->getResultArray();
        $klasifikasi = $this->KlasifikasiModel->getData()->getResultArray();
        $indeks = $this->IndeksModel->getData()->getResultArray();

        $data['pegawai'] = $pegawai;
        $data['jenis'] = $jenis;
        $data['sifat'] = $sifat;
        $data['urgensi'] = $urgensi;
        $data['klasifikasi'] = $klasifikasi;
        $data['indeks'] = $indeks;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("req_naskah_keluar", $data);
        echo view("layout/footer");
    }

    // submit naskah masuk 
    public function submit_masuk()
    {
        // get dari input user 
        $pengirim    = $this->request->getPost('nama_pengirim');
        $jabatan     = $this->request->getPost('jabatan_pengirim');
        $instansi    = $this->request->getPost('instansi_pengirim');
        $jenis       = $this->request->getPost('jenis_naskah_id');
        $sifat       = $this->request->getPost('sifat_naskah_id');
        $urgensi       = $this->request->getPost('urgensi_naskah_id');
        $nomor       = $this->request->getPost('nomor');
        $referensi  = $this->request->getPost('reply_id');
        $tgl_naskah = $this->request->getPost('date');
        $tgl_diterima = $this->request->getPost('received_at');
        $hal = $this->request->getPost('hal');
        $ringkasan = $this->request->getPost('ringkasan');
        $tujuan = $this->request->getPost('tujuan_id');
        $tembusan = $this->request->getPost('tembusan_id');
        $file_naskah = $this->request->getFile('file_naskah');
        $lampiran = $this->request->getFile('lampiran');
        $disposisi = $this->request->getPost('disposisi');

        if ($disposisi != null) {
            // get nama pegawai from db 
            $pegawai = $this->PegawaiModel->getNamaByEmail($disposisi)->getResultArray();
            $array_nama = array();
            foreach ($pegawai as $p) {
                array_push($array_nama, $p['nama']);
            }
            $disposisi2 = implode(", ", $array_nama);    
        } else {
            $disposisi2 = $disposisi;
        }

        // validation     
        if ($lampiran == "") {
            $file_naskah_name = $file_naskah->getName();
            $file_naskah->move(WRITEPATH . 'uploads/naskah_masuk');
            $lampiran_name = "";
            $status_berkas = "Tidak ada lampiran";
        } else {
            $status_berkas = "Naskah dan Lampiran Lengkap";
            // pindahkan berkas ke directory lain 
            $file_naskah_name = $file_naskah->getName();
            $lampiran_name = $lampiran->getName();
            $file_naskah->move(WRITEPATH . 'uploads/naskah_masuk');
            $lampiran->move(WRITEPATH . 'uploads/lampiran_masuk');
        }

        $data = [
            'pengirim'  => $pengirim,
            'jabatan'   => $jabatan,
            'instansi'  => $instansi,
            'jenis'     => $jenis,
            'sifat'     => $sifat,
            'urgensi'   => $urgensi,
            'nomor_naskah'      => $nomor,
            'nomor_referensi'   => $referensi,
            'tgl_naskah'        => $tgl_naskah,
            'tgl_diterima'      => $tgl_diterima,
            'hal'       => $hal,
            'ringkasan' => $ringkasan,
            'tujuan'    => $tujuan,
            'tembusan'  => $tembusan,
            'path_naskah'       => $file_naskah_name,
            'path_lampiran'     => $lampiran_name,
            'status_berkas'     => $status_berkas,
            'disposisi'         => $disposisi2
        ];

        if ($this->NaskahModel->insertNaskahMasuk($data) == true) { //jika berhasil menambahkan data
            $datalog = [
                'username'      => $this->session->username,
                'nama'          => $this->session->nama,
                'created_at'    => Time::now('Asia/Singapore', 'en_US'),
                'nomor_naskah'  => $nomor,
                'aksi'          => 'Menambah Surat Masuk'
            ];

            $this->NaskahModel->insertLog($datalog);

            // send email ke disposisi
            
            $subject = 'Notifikasi Disposisi Surat';
            $message = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8' />
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                <title>Document</title>
                <style>
                    .macbookair-1
                    {
                    position:absolute;
                    background-color:#f6f6f6;
                    height:832px;
                    width:708px;
                    padding:0px;
                    }
                    .rectangle1
                    {
                    background-color:#ffffff;
                    height:791px;
                    width:578px;
                    left:62px;
                    top:21px;
                    position:absolute;
                    }
                    .logo
                    {
                    height:89px;
                    width:294px;
                    left:71px;
                    top:21px;
                    position:absolute;
                    }
                    .isiemail
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:12px;
                    left:105px;
                    top:160px;
                    width:483px;
                    height:105px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .rectangle2
                    {
                    background-color:#00a2e9;
                    height:57px;
                    width:463px;
                    top:280px;
                    left:109px;
                    position:absolute;
                    }
                    .rectangle3
                    {
                    background-color:#f6f6f6;
                    height:39px;
                    width:463px;
                    top:337px;
                    left:109px;
                    position:absolute;
                    }
                    .rectangle4
                    {
                    background-color:#ffffff;
                    height:165px;
                    width:463px;
                    top:376px;
                    left:109px;
                    position:absolute;
                    }
                    .nomor
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    left:121px;
                    top:402px;
                    width:163px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .hal
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    left:121px;
                    top:469px;
                    width:122px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .ringkasan
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    left:121px;
                    top:536px;
                    width:184px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .teks-judul
                    {
                    color:#ffffff;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    font-family:Inter;
                    left:275px;
                    top:300px;
                    width:152px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .line1
                    {
                    width:463px;
                    transform:rotate(0deg);
                    border:1px solid #dadada;
                    top:444px;
                    left:109px;
                    position:absolute;
                    }
                    .line2
                    {
                    width:463px;
                    transform:rotate(0deg);
                    border:1px solid #dadada;
                    top:511px;
                    left:109px;
                    position:absolute;
                    }
                    .line3
                    {
                    width:463px;
                    transform:rotate(0deg);
                    border:1px solid #dadada;
                    top:581px;
                    left:109px;
                    position:absolute;
                    }
                    .copyright1
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:11px;
                    font-family:Inter;
                    left:105px;
                    top:743px;
                    width:229px;
                    height:26px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .copyright2
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:10px;
                    font-family:Inter;
                    left:105px;
                    top:780px;
                    width:100px;
                    height:12px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                </style>
            </head>
            <body>
                <div id='macbookair-1' class='macbookair-1'>
                    <div id='rectangle1' class='rectangle1'>
                    </div>
                    <img id='logo' class='logo' src='data:image/png;base64,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'/>
                    </img>
                    <div id='isiemail' class='isiemail'>
                    Bapak/Ibu yang kami hormati, 
                    <br>
                    Email ini ada pemberitahuan bahwa anda telah menerima disposisi surat. Informasi
                    selengkapnya dapat diakses melalui https://bpskaltim.com/sipadu.
                    
                    Terima kasih.
                    </div>
                    <div id='rectangle2' class='rectangle2'>
                    </div>
                    <div id='rectangle3' class='rectangle3'>
                    </div>
                    <div id='rectangle4' class='rectangle4'>
                    </div>
                    <div id='nomor' class='nomor'>
                    Nomor Surat: " . $nomor . "</div>
                    <div id='hal' class='hal'>
                    Perihal: " . $hal . "</div>
                    <div id='ringkasan' class='ringkasan'>
                    Ringkasan Surat: " . $ringkasan . "</div>
                    <div id='teks-judul' class='teks-judul'>
                    INFORMASI DISPOSISI</div>
                    <div id='line1' class='line1'>
                    </div>
                    <div id='line2' class='line2'>
                    </div>
                    <div id='line3' class='line3'>
                    </div>
                    <div id='copyright1' class='copyright1'>
                    Sistem Informasi Pengelolaan Arsip Terpadu
                    BPS Provinsi Kalimantan Timur</div>
                    <div id='copyright2' class='copyright2'>
                    Copyright IPDS 2022</div>
                    

                </div>
                    
            </body>
            </html>

            ";

            $email = \Config\Services::email();

            $email->setTo($disposisi);
            $email->setFrom('sipadu6400@gmail.com', 'Sistem Pelayanan Arsip Terpadu BPS Kaltim');

            $email->setSubject($subject);
            $email->setMessage($message);
            $email->attach(WRITEPATH . 'uploads/naskah_masuk/' . $file_naskah_name, null);

            if ($email->send()) {
                $this->session->setFlashdata('pesan_add', 'Berhasil Menambahkan Data');
                $this->session->setFlashdata('pesan_email', 'Email Disposisi Terkirim');
                $this->session->setFlashdata('alert-class', 'alert-success');
            } else {
                $this->session->setFlashdata('pesan_add', 'Berhasil Menambahkan Data');
                $this->session->setFlashdata('pesan_email', 'Email Disposisi Gagal');
                $this->session->setFlashdata('alert-class', 'alert-success');
            }
        } else {
            $this->session->setFlashdata('pesan_add', 'Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->to('/naskah-masuk');
    }

    public function submit_keluar()
    {
        // get from user input 
        $pengirim = $this->request->getPost('sender_user_id');
        $tanggal = $this->request->getPost('date');
        $jenis       = $this->request->getPost('jenis_naskah_id');
        $sifat       = $this->request->getPost('sifat_naskah_id');
        $urgensi     = $this->request->getPost('urgensi_naskah_id');
        $nomor       = $this->request->getPost('nomor');
        $referensi  = $this->request->getPost('reply_id');
        $hal = $this->request->getPost('hal');
        $ringkasan = $this->request->getPost('ringkasan');
        $file_naskah = $this->request->getFile('file_naskah');
        $lampiran = $this->request->getFile('lampiran');
        $tujuan_internal = $this->request->getPost('tujuan_internal_id');
        $tembusan_internal = $this->request->getPost('tembusan_internal_id');
        $tujuan_eksternal = $this->request->getPost('tujuan_eksternal_id');
        $tembusan_eksternal = $this->request->getPost('tembusan_eksternal_id');
        $verifikator = $this->request->getPost('verifikator');
        $penandatangan = $this->request->getPost('penandatangan');
        $ttd = $this->request->getPost('ttd');


        if ($lampiran == "") {
            $file_naskah_name = $file_naskah->getName();
            $file_naskah->move(WRITEPATH . 'uploads/naskah_keluar');
            $lampiran_name = "";
        } else {
            $file_naskah_name = $file_naskah->getName();
            $lampiran_name = $lampiran->getName();
            $file_naskah->move(WRITEPATH . 'uploads/naskah_keluar');
            $lampiran->move(WRITEPATH . 'uploads/lampiran_keluar');
            // pindahkan berkas ke directory lain 
            // $file_naskah->move('uploads/surat_keluar/naskah', $file_naskah_name);
            // $lampiran->move('uploads/surat_keluar/lampiran', $lampiran_name);
        }


        $data = [
            'unit_kerja'  => $pengirim,
            'tgl_naskah'   => $tanggal,
            'jenis'     => $jenis,
            'sifat'     => $sifat,
            'urgensi'   => $urgensi,
            'nomor_naskah'      => $nomor,
            'nomor_referensi'   => $referensi,
            'hal'       => $hal,
            'ringkasan' => $ringkasan,
            'tujuan_internal'    => $tujuan_internal,
            'tujuan_eksternal'    => $tujuan_eksternal,
            'tembusan_internal'  => $tembusan_internal,
            'tembusan_eksternal'  => $tembusan_eksternal,
            'path_naskah'       => $file_naskah_name,
            'path_lampiran'     => $lampiran_name,
            'verifikator'       => $verifikator,
            'penandatangan'     => $penandatangan,
            'ttd'               => $ttd
        ];

        if ($this->NaskahModel->insertNaskahKeluar($data) == true) {
            $datalog = [
                'username'      => $this->session->username,
                'nama'          => $this->session->nama,
                'created_at'    => Time::now('Asia/Singapore', 'en_US'),
                'nomor_naskah'  => $nomor,
                'aksi'          => 'Menambah Surat Keluar'
            ];

            $this->NaskahModel->insertLog($datalog);

            $nomor2 = (int)substr($nomor, 3, 5);
            $indeks_org = substr($nomor, 7, 5);
            print_r($indeks_org);
            // print_r($nomor2);
            $indeks_bid = $this->NaskahModel->getIndeksBidang($indeks_org)->getRow();

            $datanomor = [
                'indeks_bid' => $indeks_bid->indeks_bid,
                'indeks_org' => $indeks_org,
                'nomor' => $nomor2,
                'nomor_naskah' => $nomor
            ];

            $this->NaskahModel->insertNomor($datanomor);

            $this->session->setFlashdata('pesan_add', 'Berhasil Menambahkan Data');
            $this->session->setFlashdata('alert-class', 'alert-success');
        } else {
            $this->session->setFlashdata('pesan_add', 'Gagal Menambahkan Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect()->to('/naskah-keluar');
    }

    // show tabel daftar naskah masuk 
    public function naskah_masuk()
    {

        $naskah = $this->NaskahModel->getDataMasuk();
        $naskah = $naskah->getResultArray();
        $jenis      = $this->JenisModel->getData()->getResultArray();
        $sifat      = $this->SifatModel->getData()->getResultArray();
        $urgensi      = $this->UrgensiModel->getData()->getResultArray();
        $data['naskah'] = $naskah;
        $data['jenis'] = $jenis;
        $data['sifat'] = $sifat;
        $data['urgensi'] = $urgensi;


        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("daftar_naskah_masuk", $data);
        echo view("layout/footer");
    }

    // show tabel daftar naskah keluar
    public function naskah_keluar()
    {
        $naskah = $this->NaskahModel->getDataKeluar();
        $naskah = $naskah->getResultArray();
        $data['naskah'] = $naskah;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("daftar_naskah_keluar", $data);
        echo view("layout/footer");
    }

    // show daftar log input naskah masuk 
    public function log_naskah_masuk()
    {
        $logmasuk = $this->NaskahModel->getLogMasuk();
        $logmasuk = $logmasuk->getResultArray();
        $data['logmasuk'] = $logmasuk;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("daftar_log_masuk", $data);
        echo view("layout/footer");
    }

    // show daftar log input naskah keluar
    public function log_naskah_keluar()
    {
        $logkeluar = $this->NaskahModel->getLogKeluar();
        $logkeluar = $logkeluar->getResultArray();
        $data['logkeluar'] = $logkeluar;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("daftar_log_keluar", $data);
        echo view("layout/footer");
    }

    // // function lihat berkas naskah masuk 
    // public function lihat_naskah() {

    // }

    // function download berkas naskah masuk 
    public function download_naskah_masuk()
    {
        $idget = $this->request->getGet();
        $naskah = $this->NaskahModel->downloadNaskahMasuk($idget);
        $naskah = $naskah->getRowArray();
        if (isset($naskah)) {
            if ($naskah['path_naskah'] == "") { //jika path naskah surat tidk ditemukan 
                $this->session->setFlashdata('pesan_find', 'Naskah tidak ditemukan!');
                $this->session->setFlashdata('alert-class', 'alert-danger');
                return redirect()->to('/naskah-masuk');
            } else {
                // $data = file_get_contents(WRITEPATH.'uploads/'.$naskah['path_naskah']);
                return $this->response->download(WRITEPATH . 'uploads/naskah_masuk/' . $naskah['path_naskah'], null);
            }
        } else {
            return redirect()->to('/naskah-masuk');
        }
    }

    // function download berkas lampiran masuk
    public function download_lampiran_masuk()
    {
        $idget = $this->request->getGet();
        $naskah = $this->NaskahModel->downloadNaskahMasuk($idget);
        $naskah = $naskah->getRowArray();
        if (isset($naskah)) {
            if ($naskah['path_lampiran'] == "") { //jika path naskah surat tidk ditemukan 
                $this->session->setFlashdata('pesan_find', 'Lampiran tidak ditemukan!');
                $this->session->setFlashdata('alert-class', 'alert-danger');
                return redirect()->to('/naskah-masuk');
            } else {
                return $this->response->download(WRITEPATH . 'uploads/lampiran_masuk/' . $naskah['path_lampiran'], null);
            }
        } else {
            return redirect()->to('/naskah-masuk');
        }
    }

    // function download berkas naskah keluar
    public function download_naskah_keluar()
    {
        $idget = $this->request->getGet();
        $naskah = $this->NaskahModel->downloadNaskahKeluar($idget);
        $naskah = $naskah->getRowArray();
        if (isset($naskah)) {
            if ($naskah['path_naskah'] == "") { //jika path naskah surat tidk ditemukan 
                $this->session->setFlashdata('pesan_find', 'Naskah tidak ditemukan!');
                $this->session->setFlashdata('alert-class', 'alert-danger');
                return redirect()->to('/naskah-keluar');
            } else {
                return $this->response->download(WRITEPATH . 'uploads/naskah_keluar/' . $naskah['path_naskah'], null);
            }
        } else {
            return redirect()->to('/naskah-keluar');
        }
    }

    // function download lampiran naskah keluar
    public function download_lampiran_keluar()
    {
        $idget = $this->request->getGet();
        $naskah = $this->NaskahModel->downloadNaskahKeluar($idget);
        $naskah = $naskah->getRowArray();
        if (isset($naskah)) {
            if ($naskah['path_lampiran'] == "") { //jika path naskah surat tidk ditemukan 
                $this->session->setFlashdata('pesan_find', 'Lampiran tidak ditemukan!');
                $this->session->setFlashdata('alert-class', 'alert-danger');
                return redirect()->to('/naskah-keluar');
            } else {
                return $this->response->download(WRITEPATH . 'uploads/lampiran_keluar/' . $naskah['path_lampiran'], null);
            }
        } else {
            return redirect()->to('/naskah-keluar');
        }
    }

    // show daftar template
    public function template()
    {
        $templates = $this->NaskahModel->getTemplates();
        $templates = $templates->getResultArray();
        $data['templates'] = $templates;

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("daftar_templates", $data);
        echo view("layout/footer");
    }

    // function download template
    public function download_templates()
    {
        $idget = $this->request->getGet();
        $template = $this->NaskahModel->downloadTemplates($idget);
        $template = $template->getRowArray();

        if (isset($template)) {
            if ($template['nama'] == "") {
                $this->session->setFlashdata('pesan_find', 'Dokumen tidak ditemukan!');
                $this->session->setFlashdata('alert-class', 'alert-danger');
                return redirect()->to('/template');
            } else {
                return $this->response->download('templates/' . $template['nama'], null);
            }
        } else {
            return redirect()->to('/template');
        }
    }

    // get nomor automatic
    public function getNomor($str)
    {
        $indeks_org = $str;
        $indeks_bid = $this->NaskahModel->getIndeksBidang($indeks_org)->getRow();

        $nomor = $this->NaskahModel->getNo($indeks_bid->indeks_bid)->getRow();

        $nomor_new = $nomor->nomor + 1;

        if (strlen($nomor_new) == 1) {
            $nomor_new = sprintf("%03d", $nomor_new);
        } else if (strlen($nomor_new) == 2) {
            $nomor_new = sprintf("%02d", $nomor_new); //sprintf utk nambah 0 di depan
        } else {
            $nomor_new = $nomor_new;
        }

        echo ($nomor_new);
    }

    // form edit naskah masuk 
    public function edit_naskah_masuk_form()
    {
        $id = $this->request->getGet();
        $data['pegawai'] = $this->PegawaiModel->getNama()->getResultArray();
        $data['naskah'] = $this->NaskahModel->getDataMasukId($id)->getRow();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("edit_naskah_masuk", $data);
        echo view("layout/footer");
    }

    // form edit naskah keluar 
    public function edit_naskah_keluar_form()
    {
        $id = $this->request->getGet();

        $data['naskah'] = $this->NaskahModel->getDataKeluarId($id)->getRow();

        // load views
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("edit_naskah_keluar", $data);
        echo view("layout/footer");
    }

    // edit naskah masuk 
    public function edit_naskah_masuk()
    {
        $id = $this->request->getPost('id');

        // get dari input user 
        $pengirim    = $this->request->getPost('nama_pengirim');
        $jabatan     = $this->request->getPost('jabatan_pengirim');
        $instansi    = $this->request->getPost('instansi_pengirim');
        $jenis       = $this->request->getPost('jenis_naskah_id');
        $sifat       = $this->request->getPost('sifat_naskah_id');
        $urgensi       = $this->request->getPost('urgensi_naskah_id');
        $nomor       = $this->request->getPost('nomor');
        $referensi  = $this->request->getPost('reply_id');
        $tgl_naskah = $this->request->getPost('date');
        $tgl_diterima = $this->request->getPost('received_at');
        $hal = $this->request->getPost('hal');
        $ringkasan = $this->request->getPost('ringkasan');
        $tujuan = $this->request->getPost('tujuan_id');
        $tembusan = $this->request->getPost('tembusan_id');
        $file_naskah = $this->request->getFile('file_naskah');
        $lampiran = $this->request->getFile('lampiran');
        $disposisi = $this->request->getPost('disposisi');
        if ($disposisi != null) {
            $disposisi2 = implode(", ", $disposisi);   
        } else {
            $disposisi2 = $disposisi;
        }
        
        if ($file_naskah == "") {
            $array = [
                'pengirim' => $pengirim,
                'jabatan' => $jabatan,
                'instansi' => $instansi,
                'jenis' => $jenis,
                'sifat' => $sifat,
                'urgensi' => $urgensi,
                'nomor_naskah' => $nomor,
                'tgl_naskah' => $tgl_naskah,
                'tgl_diterima' => $tgl_diterima,
                'tujuan' => $tujuan,
                'tembusan' => $tembusan,
                'disposisi' => $disposisi2,
                'hal' => $hal,
                'ringkasan' => $ringkasan
            ];
        } else {
            $file_naskah_name = $file_naskah->getName();
            $file_naskah->move(WRITEPATH . 'uploads/naskah_masuk');
            $array = [
                'pengirim' => $pengirim,
                'jabatan' => $jabatan,
                'instansi' => $instansi,
                'jenis' => $jenis,
                'sifat' => $sifat,
                'urgensi' => $urgensi,
                'nomor_naskah' => $nomor,
                'tgl_naskah' => $tgl_naskah,
                'tgl_diterima' => $tgl_diterima,
                'tujuan' => $tujuan,
                'tembusan' => $tembusan,
                'disposisi' => $disposisi2,
                'path_naskah' => $file_naskah_name,
                'hal' => $hal,
                'ringkasan' => $ringkasan
            ];
        }

        if ($this->NaskahModel->editData($id, $array) == true) {
            $this->session->setFlashdata('pesan_add', 'Berhasil Update Data');
            $this->session->setFlashdata('alert-class', 'alert-success');

            // send email ke disposisi
            
            $subject = 'Notifikasi Disposisi Surat';
            $message = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8' />
                <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                <title>Document</title>
                <style>
                .macbookair-1
                    {
                    position:absolute;
                    background-color:#f6f6f6;
                    height:832px;
                    width:708px;
                    padding:0px;
                    }
                    .rectangle1
                    {
                    background-color:#ffffff;
                    height:791px;
                    width:578px;
                    left:62px;
                    top:21px;
                    position:absolute;
                    }
                    .logo
                    {
                    height:89px;
                    width:294px;
                    left:71px;
                    top:21px;
                    position:absolute;
                    }
                    .isiemail
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:12px;
                    left:105px;
                    top:160px;
                    width:483px;
                    height:105px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .rectangle2
                    {
                    background-color:#00a2e9;
                    height:57px;
                    width:463px;
                    top:280px;
                    left:109px;
                    position:absolute;
                    }
                    .rectangle3
                    {
                    background-color:#f6f6f6;
                    height:39px;
                    width:463px;
                    top:337px;
                    left:109px;
                    position:absolute;
                    }
                    .rectangle4
                    {
                    background-color:#ffffff;
                    height:165px;
                    width:463px;
                    top:376px;
                    left:109px;
                    position:absolute;
                    }
                    .nomor
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    left:121px;
                    top:402px;
                    width:163px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .hal
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    left:121px;
                    top:469px;
                    width:122px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .ringkasan
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    left:121px;
                    top:536px;
                    width:184px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .teks-judul
                    {
                    color:#ffffff;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:14px;
                    font-family:Inter;
                    left:275px;
                    top:300px;
                    width:152px;
                    height:17px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .line1
                    {
                    width:463px;
                    transform:rotate(0deg);
                    border:1px solid #dadada;
                    top:444px;
                    left:109px;
                    position:absolute;
                    }
                    .line2
                    {
                    width:463px;
                    transform:rotate(0deg);
                    border:1px solid #dadada;
                    top:511px;
                    left:109px;
                    position:absolute;
                    }
                    .line3
                    {
                    width:463px;
                    transform:rotate(0deg);
                    border:1px solid #dadada;
                    top:581px;
                    left:109px;
                    position:absolute;
                    }
                    .copyright1
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:11px;
                    font-family:Inter;
                    left:105px;
                    top:743px;
                    width:229px;
                    height:26px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                    .copyright2
                    {
                    color:#000000;
                    text-align:left;
                    vertical-align:text-top;
                    font-size:10px;
                    font-family:Inter;
                    left:105px;
                    top:780px;
                    width:100px;
                    height:12px;
                    position:absolute;
                    line-height:auto;
                    border-style:hidden;
                    outline:none;
                    }
                </style>
            </head>
            <body>
                <div id='macbookair-1' class='macbookair-1'>
                    <div id='rectangle1' class='rectangle1'>
                    </div>
                    <img id='logo' class='logo' src='data:image/png;base64,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'/>
                    </img>
                    <div id='isiemail' class='isiemail'>
                    Bapak/Ibu yang kami hormati, 
                    <br>
                    Email ini ada pemberitahuan bahwa anda telah menerima disposisi surat. Informasi
                    selengkapnya dapat diakses melalui https://bpskaltim.com/sipadu.
                    
                    Terima kasih.
                    </div>
                    <div id='rectangle2' class='rectangle2'>
                    </div>
                    <div id='rectangle3' class='rectangle3'>
                    </div>
                    <div id='rectangle4' class='rectangle4'>
                    </div>
                    <div id='nomor' class='nomor'>
                    Nomor Surat: " . $nomor . "</div>
                    <div id='hal' class='hal'>
                    Perihal: " . $hal . "</div>
                    <div id='ringkasan' class='ringkasan'>
                    Ringkasan Surat: " . $ringkasan . "</div>
                    <div id='teks-judul' class='teks-judul'>
                    INFORMASI DISPOSISI</div>
                    <div id='line1' class='line1'>
                    </div>
                    <div id='line2' class='line2'>
                    </div>
                    <div id='line3' class='line2'>
                    </div>
                    <div id='copyright1' class='copyright1'>
                    Sistem Informasi Pengelolaan Arsip Terpadu
                    BPS Provinsi Kalimantan Timur</div>
                    <div id='copyright2' class='copyright2'>
                    Copyright IPDS 2022</div>
                    

                </div>
                    
            </body>
            </html>

            ";

            $email = \Config\Services::email();

            if ($file_naskah != "") {
                $email->setTo($disposisi);
                $email->setFrom('sipadu6400@gmail.com', 'Sistem Pelayanan Arsip Terpadu BPS Kaltim');
                $email->setSubject($subject);
                $email->setMessage($message);
                $email->attach(WRITEPATH . 'uploads/naskah_masuk/' . $file_naskah_name, null);
            } else {
                $email->clear();
                $email->setTo($disposisi);
                $email->setFrom('sipadu6400@gmail.com', 'Sistem Pelayanan Arsip Terpadu BPS Kaltim');
                $email->setSubject($subject);
                $email->setMessage($message);
            }
            
            if ($email->send()) {
                $this->session->setFlashdata('pesan_email', 'Email Disposisi Terkirim');
                $this->session->setFlashdata('alert-class', 'alert-success');
            } else {
                $this->session->setFlashdata('pesan_email', 'Email Disposisi Gagal');
                $this->session->setFlashdata('alert-class', 'alert-success');
            }
        } else {
            $this->session->setFlashdata('pesan_add', 'Gagal Update Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect('naskah-masuk');
    }

    // edit naskah keluar
    public function edit_naskah_keluar()
    {
        $id = $this->request->getPost('id');
        // $unitkerja = $this->request->getPost('unitkerja');
        // $klasifikasi = $this->request->getPost('klasifikasi');
        // $jenis = $this->request->getPost('jenis');
        // $sifat = $this->request->getPost('sifat');
        // $urgensi = $this->request->getPost('instansi');
        // $nomor = $this->request->getPost('nomor');
        // $hal = $this->request->getPost('tglnaskah');
        // $ringkasan = $this->request->getPost('ringkasan');
        // $tujuaninternal = $this->request->getPost('tujuaninternal');
        // $tujuaneksternal = $this->request->getPost('tujuaneksternal');
        // $tembusaninternal = $this->request->getPost('tembusaninternal');
        // $tembusaneksternal = $this->request->getPost('tembusaneksternal');
        // $tglnaskah = $this->request->getPost('tglnaskah');
        // $file_naskah = $this->request->getFile('file_naskah');
        $pengirim = $this->request->getPost('sender_user_id');
        $tanggal = $this->request->getPost('date');
        $jenis       = $this->request->getPost('jenis_naskah_id');
        $sifat       = $this->request->getPost('sifat_naskah_id');
        $urgensi     = $this->request->getPost('urgensi_naskah_id');
        $nomor       = $this->request->getPost('nomor');
        $referensi  = $this->request->getPost('reply_id');
        $hal = $this->request->getPost('hal');
        $ringkasan = $this->request->getPost('ringkasan');
        $file_naskah = $this->request->getFile('file_naskah');
        $lampiran = $this->request->getFile('lampiran');
        $tujuan_internal = $this->request->getPost('tujuan_internal_id');
        $tembusan_internal = $this->request->getPost('tembusan_internal_id');
        $tujuan_eksternal = $this->request->getPost('tujuan_eksternal_id');
        $tembusan_eksternal = $this->request->getPost('tembusan_eksternal_id');
        $verifikator = $this->request->getPost('verifikator');
        $penandatangan = $this->request->getPost('penandatangan');
        $ttd = $this->request->getPost('ttd');

        if ($file_naskah == "") {
            $array = [
                'unit_kerja' => $pengirim,
                'jenis' => $jenis,
                'sifat' => $sifat,
                'urgensi' => $urgensi,
                'nomor_naskah' => $nomor,
                'tgl_naskah' => $tanggal,
                'hal' => $hal,
                'ringkasan' => $ringkasan,
                'tujuan_internal' => $tujuan_internal,
                'tujuan_eksternal' => $tujuan_eksternal,
                'tembusan_internal' => $tembusan_internal,
                'tembusan_eksternal' => $tembusan_eksternal,
                'verifikator' => $verifikator,
                'penandatangan' => $penandatangan,
                'ttd' => $ttd
            ];
        } else {
            $file_naskah_name = $file_naskah->getName();
            $file_naskah->move(WRITEPATH . 'uploads/naskah_keluar');
            $array = [
                'unit_kerja' => $pengirim,
                'jenis' => $jenis,
                'sifat' => $sifat,
                'urgensi' => $urgensi,
                'nomor_naskah' => $nomor,
                'tgl_naskah' => $tanggal,
                'hal' => $hal,
                'ringkasan' => $ringkasan,
                'tujuan_internal' => $tujuan_internal,
                'tujuan_eksternal' => $tujuan_eksternal,
                'tembusan_internal' => $tembusan_internal,
                'tembusan_eksternal' => $tembusan_eksternal,
                'path_naskah' => $file_naskah_name,
                'verifikator' => $verifikator,
                'penandatangan' => $penandatangan,
                'ttd' => $ttd
            ];
        }

        if ($this->NaskahModel->editDataKeluar($id, $array) == true) {
            $this->session->setFlashdata('pesan_add', 'Berhasil Update Data');
            $this->session->setFlashdata('alert-class', 'alert-success');
        } else {
            $this->session->setFlashdata('pesan_add', 'Gagal Update Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect('naskah-keluar');
    }

    // delete naskah masuk
    public function delete_naskah_masuk()
    {
        $id = $this->request->getPost('id');

        if ($this->NaskahModel->deleteData($id) == true) {
            $this->session->setFlashdata('pesan_delete', 'Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class', 'alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete', 'Gagal Hapus Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect('naskah-masuk');
    }
    // delete naskah keluar
    public function delete_naskah_keluar()
    {
        $id = $this->request->getPost('id');

        if ($this->NaskahModel->deleteDataKeluar($id) == true) {
            $this->session->setFlashdata('pesan_delete', 'Berhasil Hapus Data');
            $this->session->setFlashdata('alert-class', 'alert-success');
        } else {
            $this->session->setFlashdata('pesan_delete', 'Gagal Hapus Data');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect('naskah-keluar');
    }
}
