<?php

namespace App\Models;

use CodeIgniter\Model;

class PodesModel extends Model
{
        protected $db;

        public function __construct()
        {
                $this->db = db_connect();
                $this->podes_kab = $this->db->table('podes_kab');
                $this->podes_kec = $this->db->table('podes_kec');
                $this->podes_desa_1 = $this->db->table('podes_desa_1');
                $this->podes_desa_2 = $this->db->table('podes_desa_2');
                $this->podes_desa_3 = $this->db->table('podes_desa_3');
                $this->podes_desa_4 = $this->db->table('podes_desa_4');
                $this->menus = $this->db->table('daftar_analisis');
                $this->detailMenus = $this->db->table('detail_analisis');
        }

        public function getMenus()
        {
                return $this->menus->where('sumber', 'podes')->get();
        }

        // GET DESCRIPTION ANALIISIS
        public function getDescById($id, $tahun)
        {
                return $this->detailMenus
                        ->where('id', $id)
                        ->where('tahun', $tahun)
                        ->get();
        }

        public function getTabel1($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'nama desa', 
        CASE WHEN r403a= 1 THEN COUNT(r403a) ELSE 0 END AS 'Pertanian, Kehutanan, dan Perikanan',
        CASE WHEN r403a= 2 THEN COUNT(r403a) ELSE 0 END AS 'Pertambangan dan penggalian',
        CASE WHEN r403a= 3 THEN COUNT(r403a) ELSE 0 END AS 'Industri pengolahan (pabrik, kerajinan, dll.)',
        CASE WHEN r403a= 4 THEN COUNT(r403a) ELSE 0 END AS 'Pengadaan Listrik, Gas',
        CASE WHEN r403a= 5 THEN COUNT(r403a) ELSE 0 END AS 'Pengadaan Air, Pengelolaan Sampah, limbah, dan daur ulang',
        CASE WHEN r403a= 6 THEN COUNT(r403a) ELSE 0 END AS 'Konstruksi',
        CASE WHEN r403a= 7 THEN COUNT(r403a) ELSE 0 END AS 'Perdagangan besar dan eceran, reparasi mobil dan sepeda motor',
        CASE WHEN r403a= 8 THEN COUNT(r403a) ELSE 0 END AS 'Transportasi dan pergudangan',
        CASE WHEN r403a= 9 THEN COUNT(r403a) ELSE 0 END AS 'Penyediaan akomodasi dan makan minum',
        CASE WHEN r403a= 10 THEN COUNT(r403a) ELSE 0 END AS 'Informasi dan komunikasi',
        CASE WHEN r403a= 11 THEN COUNT(r403a) ELSE 0 END AS 'Jasa keuangan dan asuransi',
        CASE WHEN r403a= 12 THEN COUNT(r403a) ELSE 0 END AS 'Real estat',
        CASE WHEN r403a= 13 THEN COUNT(r403a) ELSE 0 END AS 'Jasa Perusahaan',
        CASE WHEN r403a= 14 THEN COUNT(r403a) ELSE 0 END AS 'Administrasi pemerintahan, pertahanan, dan jaminan sosial wajib',
        CASE WHEN r403a= 15 THEN COUNT(r403a) ELSE 0 END AS 'Jasa pendidikan',
        CASE WHEN r403a= 16 THEN COUNT(r403a) ELSE 0 END AS 'Jasa kesehatan dan kegiatan sosial',
        CASE WHEN r403a= 17 THEN COUNT(r403a) ELSE 0 END AS 'Jasa lainnya'
        FROM podes_desa_1
        WHERE tahun = '$year'
        GROUP BY r104
        ORDER BY r103n";
                return $this->db->query($query);
        }


        public function getTabel2($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'nama desa', 
        CASE WHEN r403a= 1 THEN COUNT(r403b) ELSE 0 END AS 'Padi',
        CASE WHEN r403a= 2 THEN COUNT(r403b) ELSE 0 END AS 'Palawija',
        CASE WHEN r403a= 3 THEN COUNT(r403b) ELSE 0 END AS 'Hortikultura',
        CASE WHEN r403a= 4 THEN COUNT(r403b) ELSE 0 END AS 'Karet',
        CASE WHEN r403a= 5 THEN COUNT(r403b) ELSE 0 END AS 'Kelapa sawit',
        CASE WHEN r403a= 6 THEN COUNT(r403b) ELSE 0 END AS 'Kopi',
        CASE WHEN r403a= 7 THEN COUNT(r403b) ELSE 0 END AS 'Kakao',
        CASE WHEN r403a= 8 THEN COUNT(r403b) ELSE 0 END AS 'Kelapa',
        CASE WHEN r403a= 9 THEN COUNT(r403b) ELSE 0 END AS 'Lada',
        CASE WHEN r403a= 10 THEN COUNT(r403b) ELSE 0 END AS 'Cengkeh',
        CASE WHEN r403a= 11 THEN COUNT(r403b) ELSE 0 END AS 'Tembakau',
        CASE WHEN r403a= 12 THEN COUNT(r403b) ELSE 0 END AS 'Tebu',
        CASE WHEN r403a= 13 THEN COUNT(r403b) ELSE 0 END AS 'Peternakan',
        CASE WHEN r403a= 14 THEN COUNT(r403b) ELSE 0 END AS 'Perikanan tangkap',
        CASE WHEN r403a= 15 THEN COUNT(r403b) ELSE 0 END AS 'Perikanan budidaya',
        CASE WHEN r403a= 16 THEN COUNT(r403b) ELSE 0 END AS 'Budidaya tanaman kehutanan',
        CASE WHEN r403a= 17 THEN COUNT(r403b) ELSE 0 END AS 'Pemungutan hasil hutan',
        CASE WHEN r403a= 18 THEN COUNT(r403b) ELSE 0 END AS 'Penangkapan satwa liar',
        CASE WHEN r403a= 19 THEN COUNT(r403b) ELSE 0 END AS 'Penangkaran satwa/tumbuhan liar',
        CASE WHEN r403a= 20 THEN COUNT(r403b) ELSE 0 END AS 'Jasa pertanian'
        FROM podes_desa_1
        WHERE tahun = '$year'
        GROUP BY r104
        ORDER BY r103n";
                return $this->db->query($query);
        }

        public function getTabel3($year)
        {
                $query = "SELECT r104n as 'Nama Desa', COUNT(r501a1) as 'Jumlah Keluarga Pengguna Listrik'
        FROM podes_desa_1
        WHERE tahun = '$year'
        GROUP BY r104";
                return $this->db->query($query);
        }

        public function getTabel4($year)
        {
                $query = "SELECT r103n as 'Nama Kec' , r104n as 'Nama Desa', 
        CASE WHEN r503b = 1 THEN COUNT(r503b) ELSE 0 END AS 'Listrik',
        CASE WHEN r503b = 2 THEN COUNT(r503b) ELSE 0 END AS 'Elpiji 5,5 kg',
        CASE WHEN r503b = 3 THEN COUNT(r503b) ELSE 0 END AS 'Elpiji 12 kg',
        CASE WHEN r503b = 4 THEN COUNT(r503b) ELSE 0 END AS 'Elpiji 3 kg',
        CASE WHEN r503b = 5 THEN COUNT(r503b) ELSE 0 END AS 'Gas Kota',
        CASE WHEN r503b = 6 THEN COUNT(r503b) ELSE 0 END AS 'Biogas',
        CASE WHEN r503b = 7 THEN COUNT(r503b) ELSE 0 END AS 'Minyak Tanah',
        CASE WHEN r503b = 8 THEN COUNT(r503b) ELSE 0 END AS 'Briket',
        CASE WHEN r503b = 9 THEN COUNT(r503b) ELSE 0 END AS 'Arang',
        CASE WHEN r503b = 10 THEN COUNT(r503b) ELSE 0 END AS'Kayu bakar',
        CASE WHEN r503b = 11 THEN COUNT(r503b) ELSE 0 END AS 'Lainnya',
        CASE WHEN r503b = 12 THEN COUNT(r503b) ELSE 0 END AS 'Tidak memasak  di rumah'
        FROM podes_desa_1
        WHERE tahun = '$year'
        GROUP BY r104
        ORDER BY r103n";
                return $this->db->query($query);
        }

        public function getTabel5($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa' , 
        CASE WHEN r507a=1 THEN COUNT(r507a) ELSE 0 END AS 'Air Kemasan Bermerek',
        CASE WHEN r507a=2 THEN COUNT(r507a) ELSE 0 END AS 'Air Isi Ulang',
        CASE WHEN r507a=3 THEN COUNT(r507a) ELSE 0 END AS 'Air Ledeng dengan Meteran',
        CASE WHEN r507a=4 THEN COUNT(r507a) ELSE 0 END AS 'Ledeng tanpa meteran',
        CASE WHEN r507a=5 THEN COUNT(r507a) ELSE 0 END AS 'Sumur Bor/Pompa',
        CASE WHEN r507a=6 THEN COUNT(r507a) ELSE 0 END AS 'Sumur',
        CASE WHEN r507a=7 THEN COUNT(r507a) ELSE 0 END AS 'Mata Air',
        CASE WHEN r507a=8 THEN COUNT(r507a) ELSE 0 END AS 'Sungai/danau/kolam/waduk/situ/embung/bendungan',
        CASE WHEN r507a=9 THEN COUNT(r507a) ELSE 0 END AS 'Air hujan',
        CASE WHEN r507a=10 THEN COUNT(r507a) ELSE 0 END AS 'Lainnya'
        FROM podes_desa_1
        WHERE tahun = '$year'
        GROUP BY r104
        ORDER BY r103n";
                return $this->db->query($query);
        }

        public function getTabel6($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa' , 
                            CASE WHEN r505a=1 THEN COUNT(r505a) ELSE 0 END AS 'Jamban Sendiri',
                            CASE WHEN r505a=2 THEN COUNT(r505a) ELSE 0 END AS 'Jamban Bersama',
                            CASE WHEN r505a=3 THEN COUNT(r505a) ELSE 0 END AS 'Jamban Umum',
                            CASE WHEN r505a=4 THEN COUNT(r505a) ELSE 0 END AS 'Bukan Jamban'
                FROM podes_desa_1
                WHERE tahun = '$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }

        public function getTabel7($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa' , 
                            CASE WHEN r505b=1 THEN COUNT(r505a) ELSE 0 END AS 'Tangki septik',
                            CASE WHEN r505b=2 THEN COUNT(r505a) ELSE 0 END AS 'IPAL',
                            CASE WHEN r505b=3 THEN COUNT(r505a) ELSE 0 END AS 'Kolam/sawah/sungai/danau/laut',
                            CASE WHEN r505b=4 THEN COUNT(r505a) ELSE 0 END AS 'Lubang tanah',
                            CASE WHEN r505b=5 THEN COUNT(r505a) ELSE 0 END AS 'Dalam lubang atau tanah terbuka',
                            CASE WHEN r505b=6 THEN COUNT(r505a) ELSE 0 END AS 'Lainnya'
                FROM podes_desa_1
                WHERE tahun = '$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }

        public function getTabel8($year)
        {
                $query = "SELECT r103, r103n, (SUM(r701dk2+r701dk3)/SUM(r701ek2+r701ek3)) jml_sdmi ,
                        (r701fk2+r701fk3)/(r701gk2+r701gk3) jml_smp,
                (r701hk2+r701hk3)/(r701lk2+r701lk3) jml_sma,
                (r701jk2+r701jk3) jml_smk,
                (r701kk2+r701kk3) jml_akademi
        FROM podes_desa_2
        WHERE tahun = '$year'
        GROUP BY r103";
                return $this->db->query($query);
        }

        public function getTabel9($year)
        {
                $query = "SELECT r103, r103n, SUM(r701dk2+r701dk3+r701ek2+r701ek3) jml_sdmi
        FROM podes_desa_2
        WHERE tahun = '$year'
        GROUP BY r103";
                return $this->db->query($query);
        }

        public function getTabel10($year)
        {
                $query = "SELECT r103, r103n, 
                        SUM(r701fk2+r701fk3+r701gk2+r701gk3) jml_smp
        FROM podes_desa_2
        WHERE tahun = '$year'
        GROUP BY r103";
                return $this->db->query($query);
        }

        public function getTabel11($year)
        {
                $query = "SELECT r103, r103n,
                SUM(r701hk2+r701hk3+r701lk2+r701lk3) jml_sma
        FROM podes_desa_2
        WHERE tahun = '$year'
        GROUP BY r103";
                return $this->db->query($query);
        }

        public function getTabel12($year)
        {
                $query = "SELECT r103, r103n, 
                SUM(r701jk2+r701jk3) jml_smk
        FROM podes_desa_2
        WHERE tahun = '$year'
        GROUP BY r103";
                return $this->db->query($query);
        }

        public function getTabel13($year)
        {
                $query = "SELECT r104 as 'kode desa', r104n as 'nama desa', 
                SUM(r705a) as 'Kegiatan Posyandu',
               SUM(r705d) as 'Kegiatan Posbindu'
        FROM `podes_desa_2` 
        WHERE tahun='$year'
        GROUP BY r104";
                return $this->db->query($query);
        }

        public function getTabel14($year)
        {
                $query = "SELECT r103 as 'kode kecamatan'
                        , r103n as 'nama kecamatan',
                        SUM(r704ak2) as 'jumlah rumah sakit',
                        SUM(r704bk2) as 'jumlah rumah sakit bersalin',
                SUM(r704ck2) as 'jumlah puskesmas dengan rawat inap',
                SUM(r704fk2) as 'jumlah poliklinik',
                SUM(r704lk2) as 'jumlah apotek'
        FROM podes_desa_2
        WHERE tahun='$year'
        GROUP BY r103
                
                
         ";
                return $this->db->query($query);
        }

        public function getTabel15($year)
        {
                $query = "SELECT r103 as 'kode kecamatan'
                        , r103n as 'nama kecamatan',
                        SUM(r704ak2) as 'jumlah rumah sakit',
                        SUM(r704bk2) as 'jumlah rumah sakit bersalin'
        FROM podes_desa_2
        WHERE tahun='$year'
        GROUP BY r103
        ";
                return $this->db->query($query);
        }

        public function getTabel16($year)
        {
                $query = "SELECT r103 as 'kode kecamatan'
                        , r103n as 'nama kecamatan',        
                SUM(r704ck2) as 'jumlah puskesmas dengan rawat inap'
        FROM podes_desa_2
        WHERE tahun='$year'
        GROUP BY r103
                
                
         ";
                return $this->db->query($query);
        }

        public function getTabel17($year)
        {
                $query = "SELECT r103 as 'kode kecamatan'
                        , r103n as 'nama kecamatan',
                SUM(r704fk2) as 'jumlah poliklinik'
        FROM podes_desa_2
        WHERE tahun='$year'
        GROUP BY r103
                
                
         ";
                return $this->db->query($query);
        }

        public function getTabel18($year)
        {
                $query = "SELECT r104 as 'kode desa'
                        , r104n as 'nama desa',
                        SUM(r706a1+r706a2) as 'jumlah dokter umum/spesialis',
                SUM(r706b) as 'jumlah dokter spesialis gigi',
                SUM(r706c) as 'jumlah bidan',
                SUM(r706d) as 'jumlah tenaga kesehatan lainnya',
                SUM(r708) as 'dukun bayi'
        FROM podes_desa_2
        WHERE tahun='$year'
        GROUP BY r104
                
                
         ";
                return $this->db->query($query);
        }

        public function getTabel19($year)
        {
                $query = "SELECT r1001a as 'Jenis Prasarana Transportasi',
                        COUNT(r104) as 'jml desa'
        FROM `podes_desa_3` 
        WHERE tahun='$year'
        GROUP BY r1001a";
                return $this->db->query($query);
        }

        public function getTabel20($year)
        {
                $query = "SELECT r1001c1 as 'Jenis Ketersediaan Angkutan Umum',
                        COUNT(r104) as 'jml desa'
        FROM `podes_desa_3` 
        WHERE tahun='$year'
        GROUP BY r1001c1";
                return $this->db->query($query);
        }

        public function getTabel21($year)
        {
                $query = "SELECT r1001b1 as 'Jenis Permukaan Jalan Darat Terluas',
                        COUNT(r104) as 'jml desa'
        FROM `podes_desa_3` 
        WHERE tahun='$year'
        GROUP BY r1001b1";
                return $this->db->query($query);
        }

        //  --------- //
        // Podes Desa //
        // ---------- //

        public function getTabel22($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', SUM(r701ak2+r701ak3) as 'jumlah PAUD'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104 
                ORDER BY r103n";
                return $this->db->query($query);
        }

        public function getTabel23($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', SUM(r701bk2+r701bk3+r701ck2+r701ck3) as 'jumlah TK dan RA/BA'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel24($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', SUM(r701dk2+r701dk3+r701ek2+r701ek3) as 'jumlah SD dan MI'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel25($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', SUM(r701fk2+r701fk3+r701gk2+r701gk3) as 'jumlah SMP dan MTS'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel26($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', SUM(r701hk2+r701hk3+r701ik2+r701ik3+r701jk2+r701jk3) as 'jumlah SMA, MA, dan SMK'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel27($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', SUM(r701kk2+r701kk3) as 'jumlah Universitas'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel28($year)
        {
                $query = "SELECT r103n as 'Nama Kec', r104n as 'Nama Desa', COUNT(r702c) as 'jumlah TBM'
                FROM podes_desa_2
                WHERE tahun='$year'
                WHERE r702c = 5
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel29($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704ak2) as 'Jumlah rumah sakit'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel30($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704bk2) as 'Jumlah rumah sakit bersalin'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel31($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704ck2) as 'Jumlah puskesmas dengan rawat inap'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel32($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704dk2) as 'Jumlah puskesmas tanpa rawat inap'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel33($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704ek2) as 'Jumlah puskesmas pembantu'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel34($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704fk2) as 'Jumlah poliklinik/balai kesehatan'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel35($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704gk2) as 'Jumlah tempat praktik dokter'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel36($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704hk2) as 'Jumlah rumah bersalin'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel37($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704ik2) as 'Jumlah tempat praktik bidan'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel38($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704jk2) as 'Jumlah poskesdes'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel39($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704kk2) as 'Jumlah polindes'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel40($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r704lk2) as 'Jumlah apotek'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }
        public function getTabel41($year)
        {
                $query = "SELECT r103n as 'Nama kec', r104n as 'Nama desa', SUM(r705b) as 'Jumlah posyandu aktif setiap bulan'
                FROM podes_desa_2
                WHERE tahun='$year'
                GROUP BY r104
                ORDER BY r103n";
                return $this->db->query($query);
        }

        // INSERT NEW DATA 
        public function insertData($data) {
                if ($this->podes_desa_1->insert($data)) {
                        return true;
                } else {
                        return false;
                }
        }

        // ----------------------
        // DATA UNTUK MASTER MENU
        // ----------------------

        public function getPodesAll() {
                return $this->podes_kec->get(100);
        }

        public function getPodes0() {
                return $this->podes_kec->get();
        }

        public function getPodes1() {
                return $this->podes_desa_1->get();
        }

        public function getPodes2() {
                return $this->podes_desa_2->get();
        }

        public function getPodes3() {
                return $this->podes_desa_3->get();
        }

        public function getPodes4() {
                return $this->podes_desa_4->get();
        }
}
