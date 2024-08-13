<?php

namespace App\Models;

use CodeIgniter\Model;

class DtksModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->data_ruta = $this->db->table('dtks_ruta');
        $this->data_art = $this->db->table('dtks_art');
        $this->menus = $this->db->table('daftar_analisis');
        $this->detailMenus = $this->db->table('detail_analisis');
    }

    public function getMenus()
    {
        return $this->menus->where('sumber', 'dtks')->get();
    }

    // GET DESCRIPTION ANALIISIS
    public function getDescById($id, $tahun)
    {
        return $this->detailMenus
            ->where('id', $id)
            ->where('tahun', $tahun)
            ->get();
    }

    public function getDataRuta()
    {
        return $this->data_ruta->get();
    }

    public function getDataART()
    {
        return $this->data_art->get();
    }

    public function getTabel1($year)
    {
        $query = "SELECT
            kec,
            COUNT(CASE WHEN status_kesejahteraan = '1' THEN nama_krt END) AS '1',
            COUNT(CASE WHEN status_kesejahteraan = '2' THEN nama_krt END) AS '2',
            COUNT(CASE WHEN status_kesejahteraan = '3' THEN nama_krt END) AS '3',
            COUNT(CASE WHEN status_kesejahteraan = '4' THEN nama_krt END) AS '4',
            COUNT(CASE WHEN status_kesejahteraan = '5' THEN nama_krt END) AS '5'
        FROM
            dtks_ruta
        GROUP BY
            kec
        ";
        return $this->db->query($query);
    }

    public function getTabel2($year)
    {
        $query = "SELECT
            kec,
            COUNT(CASE WHEN sta_bangunan = '0' THEN nama_krt END) AS '0',
            COUNT(CASE WHEN sta_bangunan = '1' THEN nama_krt END) AS '1',
            COUNT(CASE WHEN sta_bangunan = '2' THEN nama_krt END) AS '2',
            COUNT(CASE WHEN sta_bangunan = '3' THEN nama_krt END) AS '3',
            COUNT(CASE WHEN sta_bangunan = '4' THEN nama_krt END) AS '4',
            COUNT(CASE WHEN sta_bangunan = '5' THEN nama_krt END) AS '5'
        FROM
            dtks_ruta
        GROUP BY
            kec
        ";
        return $this->db->query($query);
    }

    public function getTabel3($year)
    {
        $query = "SELECT
            kec,
            COUNT(CASE WHEN sta_lahan = '0' THEN nama_krt END) AS '0',
            COUNT(CASE WHEN sta_lahan = '1' THEN nama_krt END) AS '1',
            COUNT(CASE WHEN sta_lahan = '2' THEN nama_krt END) AS '2',
            COUNT(CASE WHEN sta_lahan = '3' THEN nama_krt END) AS '3',
            COUNT(CASE WHEN sta_lahan = '4' THEN nama_krt END) AS '4'
        FROM
            dtks_ruta
        GROUP BY
            kec
        ";
        return $this->db->query($query);
    }

    public function getTabel4($year)
    {
        $query = "SELECT kec,
            COUNT(CASE WHEN luas_lantai < 50 THEN nama_krt END) AS '<50',
            COUNT(CASE WHEN luas_lantai >= 50 AND luas_lantai <= 99 THEN nama_krt END) AS '50-99',
            COUNT(CASE WHEN luas_lantai >= 100 AND luas_lantai <=149 THEN nama_krt END) AS '100-149',
            COUNT(CASE WHEN luas_lantai >=150 THEN nama_krt END) AS '150+'
        FROM dtks_ruta
        GROUP BY kec
        ";
        return $this->db->query($query);
    }

    public function getTabel5($year)
    {
        $query = "SELECT
            kec,
            COUNT(CASE WHEN lantai = '0' THEN nama_krt END) AS '0',
            COUNT(CASE WHEN lantai = '1' THEN nama_krt END) AS '1',
            COUNT(CASE WHEN lantai = '2' THEN nama_krt END) AS '2',
            COUNT(CASE WHEN lantai = '3' THEN nama_krt END) AS '3',
            COUNT(CASE WHEN lantai = '4' THEN nama_krt END) AS '4',
            COUNT(CASE WHEN lantai = '5' THEN nama_krt END) AS '5',
            COUNT(CASE WHEN lantai = '6' THEN nama_krt END) AS '6',
            COUNT(CASE WHEN lantai = '7' THEN nama_krt END) AS '7',
            COUNT(CASE WHEN lantai = '8' THEN nama_krt END) AS '8',
            COUNT(CASE WHEN lantai = '9' THEN nama_krt END) AS '9',
            COUNT(CASE WHEN lantai = '10' THEN nama_krt END) AS '10'
        FROM
            dtks_ruta
        GROUP BY
            kec
        ";
        return $this->db->query($query);
    }

    public function getTabel6($year)
    {
        $query = "SELECT kec, dinding as 'Jenis dinding',
                COUNT(CASE WHEN kondisi_dinding='0' THEN nama_krt END) AS '0',
            COUNT(CASE WHEN kondisi_dinding='1' THEN nama_krt END) AS '1',
            COUNT(CASE WHEN kondisi_dinding='2' THEN nama_krt END) AS '2'
        FROM dtks_ruta
        GROUP BY kec, dinding";
        return $this->db->query($query);
    }

    public function getTabel7($year)
    {
        $query = "SELECT kec, atap as 'Jenis atap',
                COUNT(CASE WHEN kondisi_atap='0' THEN nama_krt END) AS '0',
            COUNT(CASE WHEN kondisi_atap='1' THEN nama_krt END) AS '1',
            COUNT(CASE WHEN kondisi_atap='2' THEN nama_krt END) AS '2'
        FROM dtks_ruta
        GROUP BY kec, atap";
        return $this->db->query($query);
    }

    public function getTabel8($year)
    {
        $query = "SELECT kec,
            COUNT(CASE WHEN jumlah_kamar = 0 THEN nama_krt END) AS '0',
            COUNT(CASE WHEN jumlah_kamar=1 THEN nama_krt END) AS '1',
            COUNT(CASE WHEN jumlah_kamar=2 THEN nama_krt END) AS '2',
            COUNT(CASE WHEN jumlah_kamar>=3 THEN nama_krt END) AS '3+'
        FROM dtks_ruta
        GROUP BY kec
        ";
        return $this->db->query($query);
    }

    public function getTabel9($year)
    {
        $query = "SELECT kec,
                COUNT(CASE WHEN sumber_airminum='1' THEN nama_krt END) AS 'Air kemasan bermerek',
            COUNT(CASE WHEN sumber_airminum='2' THEN nama_krt END) AS 'Air isi ulang',
            COUNT(CASE WHEN sumber_airminum='3' THEN nama_krt END) AS 'Leding meteran',
            COUNT(CASE WHEN sumber_airminum='4' THEN nama_krt END) AS 'Leding eceran',
            COUNT(CASE WHEN sumber_airminum='5' THEN nama_krt END) AS 'Sumur bor/pompa',
            COUNT(CASE WHEN sumber_airminum='6' THEN nama_krt END) AS 'Sumur terlindung',
            COUNT(CASE WHEN sumber_airminum='7' THEN nama_krt END) AS 'Sumur tak terlindung',
            COUNT(CASE WHEN sumber_airminum='8' THEN nama_krt END) AS 'Mata air terlindung',
            COUNT(CASE WHEN sumber_airminum='9' THEN nama_krt END) AS 'Mata air tak terlidung',
            COUNT(CASE WHEN sumber_airminum='10' THEN nama_krt END) AS 'Air sungai/danau/waduk',
            COUNT(CASE WHEN sumber_airminum='11' THEN nama_krt END) AS 'Air hujan',
            COUNT(CASE WHEN sumber_airminum='12' THEN nama_krt END) AS 'Lainnya'
        FROM dtks_ruta
        GROUP BY kec";
        return $this->db->query($query);
    }

    public function getTabel10($year)
    {
        $query = "SELECT kec,
                COUNT(CASE WHEN cara_peroleh_airminum='1' THEN nama_krt END) AS 'Membeli eceran',
            COUNT(CASE WHEN cara_peroleh_airminum='2' THEN nama_krt END) AS 'Langganan',
            COUNT(CASE WHEN cara_peroleh_airminum='3' THEN nama_krt END) AS 'Tidak membeli'
        FROM dtks_ruta
        GROUP BY kec";
        return $this->db->query($query);
    }

    public function getTabel11($year)
    {
        $query = "SELECT kec,
                COUNT(CASE WHEN sumber_penerangan='1' THEN nama_krt END) AS 'Listrik PLN',
            COUNT(CASE WHEN sumber_penerangan='2' THEN nama_krt END) AS 'Listrik non PLN',
            COUNT(CASE WHEN sumber_penerangan='3' THEN nama_krt END) AS 'Bukan listrik'
        FROM dtks_ruta
        GROUP BY kec";
        return $this->db->query($query);
    }

    public function getTabel12($year)
    {
        $query = "SELECT kec,
                COUNT(CASE WHEN bb_masak='1' THEN nama_krt END) AS 'Listrik',
            COUNT(CASE WHEN bb_masak='2' THEN nama_krt END) AS 'Gas >3kg',
            COUNT(CASE WHEN bb_masak='3' THEN nama_krt END) AS 'Gas 3kg',
            COUNT(CASE WHEN bb_masak='4' THEN nama_krt END) AS 'Gas kota/biogas',
            COUNT(CASE WHEN bb_masak='5' THEN nama_krt END) AS 'Minyak tanah',
            COUNT(CASE WHEN bb_masak='6' THEN nama_krt END) AS 'Briket',
            COUNT(CASE WHEN bb_masak='7' THEN nama_krt END) AS 'Arang',
            COUNT(CASE WHEN bb_masak='8' THEN nama_krt END) AS 'Kayu bakar',
            COUNT(CASE WHEN bb_masak='9' THEN nama_krt END) AS 'Tidak memasak di rumah'
        FROM dtks_ruta
        GROUP BY kec";
        return $this->db->query($query);
    }

    public function getTabel13($year)
    {
        $query = "SELECT kec,
                COUNT(CASE WHEN fasbab='1' THEN nama_krt END) AS 'Sendiri',
            COUNT(CASE WHEN fasbab='2' THEN nama_krt END) AS 'Bersama',
            COUNT(CASE WHEN fasbab='3' THEN nama_krt END) AS 'Umum',
            COUNT(CASE WHEN fasbab='4' THEN nama_krt END) AS 'Tidak ada'
        FROM dtks_ruta
        GROUP BY kec";
        return $this->db->query($query);
    }

    public function getTabel14($year)
    {
        $query = "SELECT kec,
                COUNT(CASE WHEN ada_tabung_gas='1' THEN nama_krt END) AS 'Tabung gas',
            COUNT(CASE WHEN ada_lemari_es='3' THEN nama_krt END) AS 'Lemari es/kulkas',
            COUNT(CASE WHEN ada_ac='1' THEN nama_krt END) AS 'AC',
            COUNT(CASE WHEN ada_pemanas='3' THEN nama_krt END) AS 'Pemanas air (water heater)',
            COUNT(CASE WHEN ada_telepon='1' THEN nama_krt END) AS 'Telepon',
            COUNT(CASE WHEN ada_tv='3' THEN nama_krt END) AS 'Televisi',
            COUNT(CASE WHEN ada_emas='1' THEN nama_krt END) AS 'Emas/perhiasan & tabungan (senilai 10 gram emas)',
            COUNT(CASE WHEN ada_laptop='3' THEN nama_krt END) AS 'Komputer/laptop',
            COUNT(CASE WHEN ada_sepeda='1' THEN nama_krt END) AS 'Sepeda',
            COUNT(CASE WHEN ada_motor='3' THEN nama_krt END) AS 'Sepeda motor',
            COUNT(CASE WHEN ada_mobil='1' THEN nama_krt END) AS 'Mobil',
            COUNT(CASE WHEN ada_perahu='3' THEN nama_krt END) AS 'Perahu',
            COUNT(CASE WHEN ada_motor_tempel='1' THEN nama_krt END) AS 'Motor tempel',
            COUNT(CASE WHEN ada_perahu_motor='3' THEN nama_krt END) AS 'Perahu motor',
            COUNT(CASE WHEN ada_kapal='1' THEN nama_krt END) AS 'Kapal'
        FROM dtks_ruta
        GROUP BY kec";
        return $this->db->query($query);
    }

    public function getTabel15($year)
    {
        $query = "SELECT SUM(sapi), SUM(kerbau), SUM(kuda), SUM(babi), SUM(kambing)
        FROM
            (
            SELECT kec,
                    CASE WHEN (jumlah_sapi > 0 OR jumlah_sapi IS NOT NULL) THEN 1 ELSE 0 END AS 'sapi',
                    CASE WHEN (jumlah_kerbau > 0 OR jumlah_kerbau IS NOT NULL) THEN 1 ELSE 0 END AS 'kerbau',
                    CASE WHEN (jumlah_kuda > 0 OR jumlah_kuda IS NOT NULL) THEN 1 ELSE 0 END AS 'kuda',
                    CASE WHEN (jumlah_babi > 0 OR jumlah_babi IS NOT NULL) THEN 1 ELSE 0 END AS 'babi',
                    CASE WHEN (jumlah_kambing > 0 OR jumlah_kambing IS NOT NULL) THEN 1 ELSE 0 END AS 'kambing'
            FROM dtks_ruta
            ) t
        GROUP BY t.kec
        ";
        return $this->db->query($query);
    }

    public function getTabel16($year)
    {
        $query = "SELECT kec,
            COUNT(CASE WHEN sta_art_usaha='1' THEN nama_krt END) AS 'Ya',
            COUNT(CASE WHEN sta_art_usaha='2' THEN nama_krt END) AS 'Tidak'
        FROM dtks_ruta
        GROUP BY kec
        ";
        return $this->db->query($query);
    }
}
