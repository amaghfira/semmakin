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
        $this->menus = $this->db->table('daftar_analisis');
        $this->detailMenus = $this->db->table('detail_analisis');
    }

    public function getP3ke()
    {
        return $this->data->get();
    }

    public function getDesil()
    {
        return $this->mastertabel->where('alias', 'desil')
            ->get();
    }

    public function getPadanDukcapil()
    {
        return $this->mastertabel->where('alias', 'padan_dukcapil')
            ->get();
    }

    public function getJK()
    {
        return $this->mastertabel->where('alias', 'jk')
            ->get();
    }

    public function getPekerjaan()
    {
        return $this->mastertabel->where('alias', 'pekerjaan')
            ->get();
    }

    public function getPendidikan()
    {
        return $this->mastertabel->where('alias', 'pendidikan')
            ->get();
    }

    public function getKepemilikanRumah()
    {
        return $this->mastertabel->where('alias', 'kepemilikan_rumah')
            ->get();
    }

    public function getSimpanan()
    {
        return $this->mastertabel->where('alias', 'simpanan')
            ->get();
    }

    public function getJenisAtap()
    {
        return $this->mastertabel->where('alias', 'jenis_atap')
            ->get();
    }

    public function getJenisDinding()
    {
        return $this->mastertabel->where('alias', 'jenis_dinding')
            ->get();
    }

    public function getJenisLantai()
    {
        return $this->mastertabel->where('alias', 'jenis_lantai')
            ->get();
    }

    public function getSumberPenerangan()
    {
        return $this->mastertabel->where('alias', 'sumber_penerangan')
            ->get();
    }

    public function getBahanBakar()
    {
        return $this->mastertabel->where('alias', 'bahan_bakar')
            ->get();
    }

    public function getAirMinum()
    {
        return $this->mastertabel->where('alias', 'air_minum')
            ->get();
    }

    public function getFasilitasBab()
    {
        return $this->mastertabel->where('alias', 'fasilitas_bab')
            ->get();
    }

    public function getbnpt()
    {
        return $this->mastertabel->where('alias', 'bnpt')
            ->get();
    }

    public function getbpum()
    {
        return $this->mastertabel->where('alias', 'bpum')
            ->get();
    }

    public function getbst()
    {
        return $this->mastertabel->where('alias', 'bst')
            ->get();
    }

    public function getpkh()
    {
        return $this->mastertabel->where('alias', 'pkh')
            ->get();
    }

    public function getsembako()
    {
        return $this->mastertabel->where('alias', 'sembako')
            ->get();
    }

    public function insertData($array)
    {
        if ($this->data->insert($array)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMiskinEkstremByDesa()
    {
        $query = "SELECT desa, COUNT(*) as value FROM p3ke WHERE desil=1 GROUP BY desa";
        return $this->db->query($query);
    }

    public function getMiskinEkstremByDesaByYear($year)
    {
        $query = "SELECT kec, desa, COUNT(*) as value FROM p3ke WHERE desil=1 and tahun='$year' GROUP BY desa";
        return $this->db->query($query);
    }

    // ------------------------------------ //
    // GET DATA FOR TABLE AND VISUALIZATION //
    // ------------------------------------ //

    
    // GET DROPDWOWN MENU 
    public function getMenus() {
        return $this->menus->get(); 
    }

    // GET DESCRIPTION ANALIISIS
    public function getDescById($id,$tahun) {
        return $this->detailMenus
                    ->where('id', $id)
                    ->where('tahun', $tahun)
                    ->get();
    }

    // GET DATA BY KEC AND YEAR 

    public function getTabel2($year)
    {
        $query = "SELECT kec, 
                    Sum(CASE WHEN jk = 'Laki-laki' THEN 1 ELSE 0 END)AS 'Laki laki', 
                    Sum(CASE WHEN jk = 'Perempuan' THEN 1 ELSE 0 END)AS 'Perempuan' 
                FROM p3ke where desil = '1' and tahun='$year' GROUP BY kec ORDER BY kec;";
        return $this->db->query($query);
    }

    public function getTabel3($year)
    {
        $query = "SELECT kec,
                    Sum(CASE WHEN pekerjaan = 'Tidak/belum bekerja' THEN 1 ELSE 0 END)AS 'Tidak/belum bekerja',
                    Sum(CASE WHEN pekerjaan = 'Petani' THEN 1 ELSE 0 END)AS 'Petani',
                    Sum(CASE WHEN pekerjaan = 'Nelayan' THEN 1 ELSE 0 END)AS 'Nelayan',
                    Sum(CASE WHEN pekerjaan = 'Pedagang' THEN 1 ELSE 0 END)AS 'Pedagang',
                    Sum(CASE WHEN pekerjaan = 'Wiraswasta' THEN 1 ELSE 0 END)AS 'Wiraswasta',
                    Sum(CASE WHEN pekerjaan = 'Pegawai Swasta' THEN 1 ELSE 0 END)AS 'Pegawai Swasta',
                    Sum(CASE WHEN pekerjaan = 'Pekerja Lepas' THEN 1 ELSE 0 END)AS 'Pekerja Lepas',
                    Sum(CASE WHEN pekerjaan = 'Pensiunan' THEN 1 ELSE 0 END)AS 'Pensiunan',
                    Sum(CASE WHEN pekerjaan = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'
                    
                FROM p3ke where desil = '1' and tahun='$year'
                GROUP BY kec
                ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel4($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN pendidikan = 'Tidak/belum sekolah' THEN 1 ELSE 0 END)AS 'Tidak/belum sekolah',
    Sum(CASE WHEN pendidikan = 'Tidak tamat SD/sederajat' THEN 1 ELSE 0 END)AS 'Tidak tamat SD/sederajat',
    Sum(CASE WHEN pendidikan = 'Tamat SD/sederajat' THEN 1 ELSE 0 END)AS 'Tamat SD/sederajat',
    Sum(CASE WHEN pendidikan = 'Tamat SMP/sederajat' THEN 1 ELSE 0 END)AS 'Tamat SMP/sederajat',
    Sum(CASE WHEN pendidikan = 'Tamat SMA/sederajat' THEN 1 ELSE 0 END)AS 'Tamat SMA/sederajat',
    Sum(CASE WHEN pendidikan = 'Tamat Perguruan Tinggi' THEN 1 ELSE 0 END)AS 'Tamat Perguruan Tinggi',
    Sum(CASE WHEN pendidikan = 'Siswa SD/sederajat' THEN 1 ELSE 0 END)AS 'Siswa SD/sederajat',
    Sum(CASE WHEN pendidikan = 'Siswa SMP/sederajat' THEN 1 ELSE 0 END)AS 'Siswa SMP/sederajat',
    Sum(CASE WHEN pendidikan = 'Siswa SMA/sederajat' THEN 1 ELSE 0 END)AS 'Siswa SMA/sederajat',
    Sum(CASE WHEN pendidikan = 'Mahasiswa Perguruan Tinggi' THEN 1 ELSE 0 END)AS 'Mahasiswa Perguruan Tinggi'
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel5($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN Kepemilikan_Rumah = 'Bebas Sewa' THEN 1 ELSE 0 END)AS 'Bebas Sewa',
    Sum(CASE WHEN Kepemilikan_Rumah = 'Dinas' THEN 1 ELSE 0 END)AS 'Dinas',
    Sum(CASE WHEN Kepemilikan_Rumah = 'Kontrak/Sewa' THEN 1 ELSE 0 END)AS 'Kontrak/Sewa',
    Sum(CASE WHEN Kepemilikan_Rumah = 'Menumpang' THEN 1 ELSE 0 END)AS 'Menumpang',
    Sum(CASE WHEN Kepemilikan_Rumah = 'Milik Sendiri' THEN 1 ELSE 0 END)AS 'Milik Sendiri',
    Sum(CASE WHEN Kepemilikan_Rumah = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel6($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN simpanan = 'ya' THEN 1 ELSE 0 END)AS 'Memiliki Simpanan',
    Sum(CASE WHEN simpanan = 'Tidak' THEN 1 ELSE 0 END)AS 'Tidak Memiliki Simpanan'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel7($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN jenis_atap = 'Asbes/Seng' THEN 1 ELSE 0 END)AS 'Asbes/Seng',
    Sum(CASE WHEN jenis_atap = 'Bambu' THEN 1 ELSE 0 END)AS 'Bambu',
    Sum(CASE WHEN jenis_atap = 'Beton' THEN 1 ELSE 0 END)AS 'Beton',
    Sum(CASE WHEN jenis_atap = 'Genteng' THEN 1 ELSE 0 END)AS 'Genteng',
    Sum(CASE WHEN jenis_atap = 'Jerami/Ijuk/Rumbia/Daun-daunan' THEN 1 ELSE 0 END)AS 'Jerami/Ijuk/Rumbia/Daun-daunan',
    Sum(CASE WHEN jenis_atap = 'Kayu/Sirap' THEN 1 ELSE 0 END)AS 'Kayu/Sirap',
    Sum(CASE WHEN jenis_atap = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel8($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN jenis_dinding = 'Bambu' THEN 1 ELSE 0 END)AS 'Bambu',
    Sum(CASE WHEN jenis_dinding = 'Kayu/Papan' THEN 1 ELSE 0 END)AS 'Kayu/Papan',
    Sum(CASE WHEN jenis_dinding = 'Seng' THEN 1 ELSE 0 END)AS 'Seng',
    Sum(CASE WHEN jenis_dinding = 'Tembok' THEN 1 ELSE 0 END)AS 'Tembok',
    Sum(CASE WHEN jenis_dinding = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel9($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN jenis_lantai = 'Bambu' THEN 1 ELSE 0 END)AS 'Bambu',
    Sum(CASE WHEN jenis_lantai = 'Kayu/Papan' THEN 1 ELSE 0 END)AS 'Kayu/Papan',
    Sum(CASE WHEN jenis_lantai = 'Keramik/Granit/Marmer/Ubin/Tegel/Teraso' THEN 1 ELSE 0 END)AS 'Keramik/Granit/Marmer/Ubin/Tegel/Teraso',
    Sum(CASE WHEN jenis_lantai = 'Semen' THEN 1 ELSE 0 END)AS 'Semen',
    Sum(CASE WHEN jenis_lantai = 'Tanah' THEN 1 ELSE 0 END)AS 'Tanah',
    Sum(CASE WHEN jenis_lantai = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec 
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel10($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN sumber_penerangan = 'Listrik Pribadi s/d 900 Watt' THEN 1 ELSE 0 END)AS 'Listrik Pribadi s/d 900 Watt',
    Sum(CASE WHEN sumber_penerangan = 'Keramik/Granit/Marmer/Ubin/Tegel/Teraso' THEN 1 ELSE 0 END)AS 'Keramik/Granit/Marmer/Ubin/Tegel/Teraso',
    Sum(CASE WHEN sumber_penerangan = 'Listrik Pribadi > 900 Watt' THEN 1 ELSE 0 END)AS 'Listrik Pribadi > 900 Watt',
    Sum(CASE WHEN sumber_penerangan = 'Genset/solar cell' THEN 1 ELSE 0 END)AS 'Genset/solar cell',
    Sum(CASE WHEN sumber_penerangan = 'Non-Listrik' THEN 1 ELSE 0 END)AS 'Non-Listrik'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel11($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN bahan_bakar_memasak = 'Listrik/Gas' THEN 1 ELSE 0 END)AS 'Listrik/Gas',
    Sum(CASE WHEN bahan_bakar_memasak = 'Minyak Tanah' THEN 1 ELSE 0 END)AS 'Minyak Tanah',
    Sum(CASE WHEN bahan_bakar_memasak = 'Arang/Kayu' THEN 1 ELSE 0 END)AS 'Arang/Kayu',
    Sum(CASE WHEN bahan_bakar_memasak = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel12($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN sumber_air_minum = 'Air Kemasan/Isi Ulang' THEN 1 ELSE 0 END)AS 'Air Kemasan/Isi Ulang',
    Sum(CASE WHEN sumber_air_minum = 'Ledeng/PAM' THEN 1 ELSE 0 END)AS 'Ledeng/PAM',
    Sum(CASE WHEN sumber_air_minum = 'Sumur Bor' THEN 1 ELSE 0 END)AS 'Sumur Bor',
    Sum(CASE WHEN sumber_air_minum = 'Sumur Terlindung' THEN 1 ELSE 0 END)AS 'Sumur Terlindung',
    Sum(CASE WHEN sumber_air_minum = 'Sumur Tidak Terlindung' THEN 1 ELSE 0 END)AS 'Sumur Tidak Terlindung',
    Sum(CASE WHEN sumber_air_minum = 'Air Permukaan (Sungai, Danau, dll)' THEN 1 ELSE 0 END)AS 'Air Permukaan (Sungai, Danau, dll)',
    Sum(CASE WHEN sumber_air_minum = 'Air Hujan' THEN 1 ELSE 0 END)AS 'Air Hujan',
    Sum(CASE WHEN sumber_air_minum = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel13($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN fasilitas_bab = 'Ya, dengan Septic Tank' THEN 1 ELSE 0 END)AS 'Ya, dengan Septic Tank',
    Sum(CASE WHEN fasilitas_bab = 'Ya, tanpa Septic Tank' THEN 1 ELSE 0 END)AS 'Ya, tanpa Septic Tank',
    Sum(CASE WHEN fasilitas_bab = 'Tidak, Jamban Umum/Bersama' THEN 1 ELSE 0 END)AS 'Tidak, Jamban Umum/Bersama',
    Sum(CASE WHEN fasilitas_bab = 'Lainnya' THEN 1 ELSE 0 END)AS 'Lainnya'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel14($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN penerima_bnpt = 'Ya' THEN 1 ELSE 0 END)AS 'Ya',
    Sum(CASE WHEN penerima_bnpt = 'Tidak' THEN 1 ELSE 0 END)AS 'Tidak'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec 
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel15($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN penerima_bpum = 'Ya' THEN 1 ELSE 0 END)AS 'Ya',
    Sum(CASE WHEN penerima_bpum = 'Tidak' THEN 1 ELSE 0 END)AS 'Tidak'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel16($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN penerima_bst = 'Ya' THEN 1 ELSE 0 END)AS 'Ya',
    Sum(CASE WHEN penerima_bst = 'Tidak' THEN 1 ELSE 0 END)AS 'Tidak'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel17($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN penerima_pkh = 'Ya' THEN 1 ELSE 0 END)AS 'Ya',
    Sum(CASE WHEN penerima_pkh = 'Tidak' THEN 1 ELSE 0 END)AS 'Tidak'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec 
ORDER BY kec";
        return $this->db->query($query);
    }

    public function getTabel18($year)
    {
        $query = "SELECT kec,
    Sum(CASE WHEN penerima_sembako = 'Ya' THEN 1 ELSE 0 END)AS 'Ya',
    Sum(CASE WHEN penerima_sembako = 'Tidak' THEN 1 ELSE 0 END)AS 'Tidak'   
FROM p3ke where desil = '1' and tahun='$year' 
GROUP BY kec
ORDER BY kec";
        return $this->db->query($query);
    }

    // GET DATA BY DESA AND YEAR
    // DESA: tabel19-36

    public function getTabel19($year)
    {
        $query = "SELECT kec,desa,
                    Sum(CASE WHEN jk = 'Laki-laki' THEN 1 ELSE 0 END)AS 'Laki laki',
                    Sum(CASE WHEN jk = 'Perempuan' THEN 1 ELSE 0 END)AS 'Perempuan'
                FROM p3ke where desil = '1' and tahun='$year' 
                GROUP BY kec, desa 
                ORDER BY kec";

        return $this->db->query($query);
    }
}
