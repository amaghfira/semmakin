<?php
//  $omae = $_SERVER['DOCUMENT_ROOT'].'/omae';
    $omae = 'https://webapps.bps.go.id/jateng/omae';
    
  foreach(array('i','ii','iii','iv','v','vi','vii','viii') as $blok)
    ${$blok} = $this->mskegiatan_model->get_blok($data->id_ms_keg, $blok);

  $variabel = $this->mskegiatan_model->get_variabel($data->id_ms_keg);
  $wilayah = $this->mskegiatan_model->get_iv_wilayah($data->id_ms_keg);

  $error = $this->mskegiatan_model->get_validasi($data->id_ms_keg);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OMAE</title>
  <meta name="description" content="Optimalisasi Metadata Statistik Sektoral secara Elektronik">
  <meta name="author" content="BPS Prov. Jawa Tengah">
  <style>
/*    body, td {font-family: arial; font-size: 13px; }
*/    body{margin: 0 20px;}
    h1 {text-align: center;}
    table {width:100%; border:none;}
    table, tr, td {border-collapse: collapse;}
    td {line-height: 18px; vertical-align: middle;}
    label {font-weight: bold;}
    .pull-right {float: right }
    .align-right {text-align: right;}
    .box {float: right; border: 1px solid black; text-align: center; width: 30px; min-height: 30px;}
    .question td {padding-top: 8px; padding-bottom: 8px; border-top: 1px solid #666}
    .section-header td {background: #eee; font-weight: bold; font-size: large; text-align: center; padding: 8px; border-top: 1px solid #666; border-bottom: 1px solid #666;}
    .end-question {margin-top: 0px; margin-bottom: 4px;}
    .end-question td {line-height: 4px;}

    .bps {font-family:"Arial"; font-weight:bold; font-style:italic;}
  </style>
</head>

<body>
  <div class="container">

    <!-- HALAMAN 1 -->

    <table style="margin-bottom: 50px;">
      <tr>
        <td style="width:30%; text-align:center;">
          <!--img src="<?=$omae;?>/assets/bps.png" style="width:70px;"><br-->
          <span class="bps">BADAN PUSAT STATISTIK</span>
        </td>
        <td style="width:50%;">&nbsp;</td>
        <td style="width:20%; vertical-align:bottom;">
          <div style="border:1px solid #000; font-weight:bold; text-align:center; padding:5px 0">MS-Keg</div>
        </td>
      </tr>  
    </table>

    <!--img style="width:150px; transform:rotate(-25)" src="<?=FCPATH.'/assets/'.($error?'error':'clean').'.png';?>"-->

    <h1>METADATA STATISTIK<br>KEGIATAN</h1>
      
    <table>
      <tr style="display:none;">
        <?php 
            $width = array(5, 8.33, 8.33, 8.33, 3, 3, 8.33, 8.33, 8.33, 3, 3);
            foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>';
        ?>
      </tr>

      <tr class="question">
        <td colspan="9" style="height:100px; vertical-align:top">
            <label>Judul Kegiatan</label><br><br>
            <?=$data->judul_kegiatan;?>
        </td>
        <td colspan="2" class="align-right" style="vertical-align:top">
            <label>Tahun</label><br>
            <?=$data->tahun;?>
        </td>
      </tr>

      <tr class="question">
        <td colspan="11" style="height:50px; vertical-align:top">
            <label>Kode Kegiatan (diisi oleh petugas)</label> <br>
            <br>
            <?=$data->kode_keg;?>
        </td>
      </tr>

      <tr class="question">
        <td colspan="10"><label>Cara Pengumpulan Data</label></td>
        <td><div class="box"><?=$data->cara_pengumpulan_data;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Pencacahan Lengkap</td>
        <td class="align-right">- 1</td>
        <td></td>
        <td colspan="3">Kompilasi Produk Administrasi</td>
        <td class="align-right">- 3</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Survei</td>
        <td class="align-right">- 2</td>
        <td></td>
        <td colspan="3">Cara Lain Sesuai Perkembangan TI</td>
        <td class="align-right">- 4</td>
        <td></td>
      </tr>

      <tr class="end-question"><td colspan="11">&nbsp;</td></tr>
 
      <tr class="question">
        <td colspan="10"><label>Sektor Kegiatan</label></td>
        <td><div class="box"><?=$data->sektor_kegiatan;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Pertanian dan Perikanan</td>
        <td class="align-right">- 1</td>
        <td></td>
        <td colspan="3">Perdagangan Internasional dan Neraca Perdagangan</td>
        <td class="align-right">- 12</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Demografi dan Kependudukan</td>
        <td class="align-right">- 2</td>
        <td></td>
        <td colspan="3">Ketenagakerjaan</td>
        <td class="align-right">- 13</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Pembangunan</td>
        <td class="align-right">- 3</td>
        <td></td>
        <td colspan="3">Neraca Nasional</td>
        <td class="align-right">- 14</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Proyeksi Ekonomi</td>
        <td class="align-right">- 4</td>
        <td></td>
        <td colspan="3">Indikator Ekonomi Bulanan</td>
        <td class="align-right">- 15</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Pendidikan dan Pelatihan</td>
        <td class="align-right">- 5</td>
        <td></td>
        <td colspan="3">Produktivitas</td>
        <td class="align-right">- 16</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Lingkungan</td>
        <td class="align-right">- 6</td>
        <td></td>
        <td colspan="3">Harga dan Paritas Daya Beli</td>
        <td class="align-right">- 17</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Keuangan</td>
        <td class="align-right">- 7</td>
        <td></td>
        <td colspan="3">Sektor Publik, Perpajakan, dan Regulasi Pasar</td>
        <td class="align-right">- 18</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Globalisasi</td>
        <td class="align-right">- 8</td>
        <td></td>
        <td colspan="3">Perwilayahan dan Perkotaan</td>
        <td class="align-right">- 19</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Kesehatan</td>
        <td class="align-right">- 9</td>
        <td></td>
        <td colspan="3">Ilmu Pengetahuan dan Hak Paten</td>
        <td class="align-right">- 20</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Industri dan Jasa</td>
        <td class="align-right">- 10</td>
        <td></td>
        <td colspan="3">Perlindungan Sosial dan Kesejahteraan</td>
        <td class="align-right">- 21</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Teknologi Informasi dan Komunikasi</td>
        <td class="align-right">- 11</td>
        <td></td>
        <td colspan="3">Transportasi</td>
        <td class="align-right">- 22</td>
        <td></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10"><label>Jika survei statistik sektoral, apakah mendapatkan rekomendasi kegiatan statistik dari BPS?</label></td>
        <td><div class="box"><?=$data->apakah_mendapat_rekomendasi;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">Ya</td>
        <td class="align-right">- 1</td>
        <td colspan="6"></td>
     </tr>
      <tr>
        <td></td>
        <td colspan="3">Tidak</td>
        <td class="align-right">- 2</td>
        <td colspan="6"></td>
     </tr>
      <tr>
        <td></td>
        <td colspan="5">Jika Ya, Identitas Rekomendasi</td>
        <td colspan="4"><?=$data->identitas_rekomendasi;?></td>
        <td></td>
      </tr>

    </table>

    <div style="page-break-after: always;"></div>

    <!-- HALAMAN 2 -->

    <table>
      <tr style="display:none;">
        <?php foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>'; ?>
      </tr>

      <tr class="section-header">
        <td colspan="11">I. PENYELENGGARA</td>
      </tr>

      <tr class="question">
        <td colspan="11">
            <label>1.1. Instansi Penyelenggara</label><br>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10" style="height:50px; vertical-align:top"><?=$i->instansi_penyelenggara;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>1.2. Alamat Lengkap Instansi Penyelenggara</label><br>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10" style="height:50px; vertical-align:top"><?=$i->alamat_lengkap_instansi_penyelenggara;?></td>
      </tr>
      <tr>
        <td></td>
        <td>Telepon</td>
        <td colspan="2">: <?=$i->telepon;?></td>
        <td></td>
        <td colspan="6">Faksimile : <?=$i->faksimile;?></td>
      </tr>
      <tr>
        <td></td>
        <td>Email</td>
        <td colspan="9">: <?=$i->email;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="section-header">
        <td colspan="11">II. PENANGGUNG JAWAB</td>
      </tr>

      <tr class="question">
        <td colspan="11">
            <label>2.1. Unit Eselon Penanggung Jawab</label><br>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>Eselon 1</td>
        <td colspan="9">: <?=$ii->unit_penanggung_jawab_eselon1;?></td>
      </tr>
      <tr>
        <td></td>
        <td>Eselon 2</td>
        <td colspan="9">: <?=$ii->unit_penanggung_jawab_eselon2;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>2.2. Penanggung Jawab Teknis (setingkat Eselon 3)</label><br>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>Jabatan</td>
        <td colspan="9">: <?=$ii->jabatan_penanggung_jawab_teknis;?></td>
      </tr>
      <tr>
        <td></td>
        <td>Alamat</td>
        <td colspan="9">: <?=$ii->alamat_penanggung_jawab_teknis;?></td>
      </tr>
      <tr>
        <td></td>
        <td>Telepon</td>
        <td colspan="2">: <?=$ii->telepon_penanggung_jawab_teknis;?></td>
        <td></td>
        <td colspan="6">
            Faksimile : <?=$ii->faksimile_penanggung_jawab_teknis;?>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>Email</td>
        <td colspan="9">: <?=$ii->email_penanggung_jawab_teknis;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="section-header">
        <td colspan="11">III. PERENCANAAN DAN PERSIAPAN</td>
      </tr>

      <tr class="question">
        <td colspan="11">
            <label>3.1. Latar Belakang Kegiatan</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10" style="height:150px; vertical-align: top;">
          <?=nl2br($iii->latar_belakang_kegiatan);?>
        </td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>3.2. Tujuan Kegiatan</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10" style="height: 150px; vertical-align: top;">
          <?=nl2br($iii->tujuan_kegiatan);?>
        </td>
      </tr>
    </table> 

    <div style="page-break-after: always;"></div>

    <!-- HALAMAN 3 -->

    <table>
      <tr style="display:none;">
        <?php foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>'; ?>
      </tr>

      <tr class="question">
        <td colspan="11">
            <label>3.3. Rencana Jadwal Kegiatan:</label>
        </td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td colspan="3"><label>AWAL</label></td>
        <td colspan="5"><label>AKHIR</label></td>
      </tr>

      <tr>
        <td></td>
        <td colspan="10"><b>A. Perencanaan</b></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">1. Perencanaan Kegiatan</td>
        <td colspan="2">: <?=format_tanggal($iii->perencanaan_kegiatan_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->perencanaan_kegiatan_akhir);?></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">2. Desain</td>
        <td colspan="2">: <?=format_tanggal($iii->desain_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->desain_akhir);?></td>
      </tr>

      <tr>
        <td></td>
        <td colspan="10"><b>B. Pengumpulan</b></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">3. Pengumpulan Data</td>
        <td colspan="2">: <?=format_tanggal($iii->pengumpulan_data_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->pengumpulan_data_akhir);?></td>
      </tr>

      <tr>
        <td></td>
        <td colspan="10"><b>C. Pemeriksaan</b></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">4. Pengolahan Data</td>
        <td colspan="2">: <?=format_tanggal($iii->pengolahan_data_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->pengolahan_data_akhir);?></td>
      </tr>

      <tr>
        <td></td>
        <td colspan="10"><b>D. Penyebarluasan</b></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">5. Analisis</td>
        <td colspan="2">: <?=format_tanggal($iii->analisis_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->analisis_akhir);?></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">6. Diseminasi Hasil</td>
        <td colspan="2">: <?=format_tanggal($iii->diseminasi_hasil_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->diseminasi_hasil_akhir);?></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2" style="padding-left:15px;">7. Evaluasi</td>
        <td colspan="2">: <?=format_tanggal($iii->evaluasi_awal);?></td>
        <td>s.d</td>
        <td colspan="5"><?=format_tanggal($iii->evaluasi_akhir);?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>3.4. Variabel (Karakteristik) yang Dikumpulkan:</label>
        </td>
      </tr>

      <tr>
        <td></td>
        <td colspan="10">
          <table style="width: 100%;">
            <tr>
              <th style="width:20px">No</th>
              <th width="20%">Nama Variabel<br>(Karakteristik)</th>
              <th width="20%">Konsep</th>
              <th>Definisi</th>
              <th>Referensi Waktu<br>(Periode Enumerasi)</th>
            </tr>
  <?php if($variabel) {
    $nomor = 1;
    foreach($variabel as $row) {
  ?>
            <tr>
              <td><?=$nomor++;?>.</td>
              <td><?=$row->nama_variabel;?></td>
              <td><?=$row->konsep;?></td>
              <td><?=$row->definisi;?></td>
              <td><?=$row->referensi_waktu;?></td>
            </tr>
  <?php    
    }
  }  
  ?>
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr><td colspan="5">&nbsp;</td></tr>            
          </table>
        </td>
      </tr>

      <tr class="section-header">
        <td colspan="11">IV. DESAIN KEGIATAN</td>
      </tr>

      <tr class="question">
        <td colspan="10">
            <label>4.1. Kegiatan Ini Dilakukan</label>
        </td>
        <td>
            <div class="box"><?=$iv->kegiatan_ini_dilakukan;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Hanya Sekali<br>&rarr; langsung ke R.4.3</td>
        <td class="align-right">- 1</td>
        <td></td>
        <td colspan="4">Berulang</td>
        <td class="align-right">- 2</td>
        <td></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>4.2. Jika “berulang” (R.4.1. berkode 2), Frekuensi Penyelenggaraan:</label>
        </td>
        <td>
            <div class="box"><?=$iv->frekuensi_penyelenggaraan;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Harian</td>
        <td class="align-right">- 1</td>
        <td></td>
        <td colspan="4">Empat Bulanan</td>
        <td class="align-right">- 5</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Mingguan</td>
        <td class="align-right">- 2</td>
        <td></td>
        <td colspan="4">Semesteran</td>
        <td class="align-right">- 6</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Bulanan</td>
        <td class="align-right">- 3</td>
        <td></td>
        <td colspan="4">Tahunan</td>
        <td class="align-right">- 7</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Triwulanan</td>
        <td class="align-right">- 4</td>
        <td></td>
        <td colspan="4">> Dua Tahunan</td>
        <td class="align-right">- 8</td>
        <td></td>
      </tr>

    </table>

    <div style="page-break-after: always;"></div>

    <!-- HALAMAN 4 -->

    <table>
      <tr style="display:none;">
        <?php foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>'; ?>
      </tr>
      <tr class="question">
        <td colspan="10">
            <label>4.3. Tipe Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box"><?=$iv->tipe_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Longitudinal Panel</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Longitudinal Cross Sectiona</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Cross Sectiona</td>
        <td class="align-right">- 3</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>4.4. Cakupan Wilayah Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box"><?=$iv->cakupan_wilayah_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Seluruh Wilayah Indonesia</td>
        <td class="align-right">- 1</td>
        <td colspan="7">&rarr; langsung ke R.4.6</td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Sebagian Wilayah Indonesia</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>4.5. Jika “sebagian wilayah Indonesia” (R.4.4. berkode 2), Wilayah Kegiatan:</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3"><b>No &nbsp; Provinsi</b></td>
        <td colspan="7"><b>Kabupaten/Kota</b></td>
      </tr>
  <?php if($wilayah) {
    $nomor=1; 
    foreach($wilayah as $row) { ?>
      <tr>
        <td></td>
        <td colspan="3"><?=($nomor++).'. &nbsp; &nbsp; '.$row->provinsi;?></td>
        <td colspan="7"><?=$row->kabupaten;?></td>
      </tr>
  <?php } } ?>
      <tr>
        <td></td>
        <td colspan="3">&nbsp; &nbsp; </td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">&nbsp; &nbsp; </td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>4.6. Metode Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box"><?=$iv->metode_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Wawancara</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Mengisi kuesioner sendiri (swacacah)</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Pengamatan (observasi)</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Pengumpulan data sekunder</td>
        <td class="align-right">- 8</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Lainnya (sebutkan)</td>
        <td class="align-right">- 16</td>
        <td colspan="6"><?=$iv->metode_pengumpulan_data_lainnya;?></td>
        <td></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>4.7. Sarana Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box"><?=$iv->sarana_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Paper-assisted Personal Interviewing (PAPI)</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Computer-assisted Personal Interviewing (CAPI)</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Computer-assisted Telephones Interviewing (CATI)</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Computer Aided Web Interviewing (CAWI)</td>
        <td class="align-right">- 8</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Mail</td>
        <td class="align-right">- 16</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Lainnya (sebutkan)</td>
        <td class="align-right">- 32</td>
        <td colspan="6"><?=$iv->sarana_pengumpulan_data_lainnya;?></td>
        <td></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>4.8. Unit Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box"><?=$iv->unit_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Individu</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Rumah tangga</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Usaha/perusahaan</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Lainnya (sebutkan)</td>
        <td class="align-right">- 8</td>
        <td colspan="6"><?=$iv->unit_pengumpulan_data_lainnya;?></td>
        <td></td>
      </tr>

    </table>

    <div style="page-break-after: always;"></div>

    <!-- HALAMAN 5 -->

    <table>
      <tr style="display:none;">
        <?php 
            foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>';
        ?>
      </tr>

      <tr class="section-header">
        <td colspan="11">
            V. DESAIN SAMPEL<br>
            <span style="font-weight:normal;font-size:small;">Diisi jika cara pengumpulan data adalah survei sebagian</span>
        </td>
      </tr>

      <tr class="question">
        <td colspan="10">
            <label>5.1. Jenis Rancangan Sampel:</label>
        </td>
        <td>
            <div class="box"><?=$v->jenis_rancangan_sampel;?>&nbsp;</div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Single Stage/Phase</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Multi Stage/Phase</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>5.2. Metode Pemilihan Sampel Tahap Terakhir:</label>
        </td>
        <td>
            <div class="box"><?=$v->metode_pemilihan_sampel_tahap_terakhir;?>&nbsp;</div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Sampel Probabilitas</td>
        <td class="align-right">- 1</td>
        <td colspan="7">&rarr; ke R.5.3.a</td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Sampel Nonprobabilitas</td>
        <td class="align-right">- 2</td>
        <td colspan="7">&rarr; ke R.5.3.b</td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>5.3. Jika “sampel probabilitas” (R.5.2. berkode 1), Metode yang Digunakan:</label>
        </td>
        <td>
            <div class="box"><?=$v->metode_yang_digunakan;?>&nbsp;</div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Simple Random Sampling</td>
        <td class="align-right">- 1</td>
        <td colspan="7">&rarr; kode 1-5 ke R.5.4</td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Systematic Random Sampling</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Stratified Random Sampling</td>
        <td class="align-right">- 3</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Cluster Sampling</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Multi Stage Sampling</td>
        <td class="align-right">- 5</td>
        <td colspan="7"></td>
      </tr>

      <tr>
        <td></td>
        <td colspan="9"><label>Jika “sampel nonprobabilitas” (R.5.2. berkode 2), Metode yang Digunakan:</label></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Quota Sampling</td>
        <td class="align-right">- 6</td>
        <td colspan="7">&rarr; kode 6-10 ke R.5.7</td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Accidental Sampling</td>
        <td class="align-right">- 7</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Purposive Sampling</td>
        <td class="align-right">- 8</td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Snowball Sampling</td>
        <td class="align-right">- 9</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Saturation Sampling</td>
        <td class="align-right">- 10</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10"><label>5.4. Kerangka Sampel Tahap Terakhir:</label></td>
        <td><div class="box"><?=$v->kerangka_sampel_tahap_terakhir;?>&nbsp;</div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">List Frame</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Area Frame</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
     </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11"><label>5.5. Fraksi Sampel Keseluruhan:</label></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10"><?=$v->fraksi_sampel_keseluruhan;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11"><label>5.6. Nilai Perkiraan Sampling Error Variabel Utama:</label></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10"><?=$v->nilai_perkiraan_sampling_error_variabel_utama;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11"><label>5.7. Unit Sampel:</label></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10"><?=$v->unit_sampel;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11"><label>5.8. Unit Observasi:</label></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="10"><?=$v->unit_observasi;?></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="section-header">
        <td colspan="11">
            VI. PENGUMPULAN DATA
        </td>
      </tr>

      <tr class="question">
        <td colspan="10">
            <label>6.1. Apakah Melakukan Uji Coba (Pilot Survey)?</label>
        </td>
        <td>
            <div class="box"><?=$vi->apakah_melakukan_uji_coba;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Ya</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Tidak</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
    </table>

    <div style="page-break-after: always;"></div>

    <!-- HALAMAN 6 -->

    <table>
      <tr style="display:none;">
        <?php 
            foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>';
        ?>
      </tr>

      <tr class="question">
        <td colspan="10">
            <label>6.2. Metode Pemeriksaan Kualitas Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box"><?=$vi->metode_pemeriksaan_kualitas_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Kunjungan kembali (revisit)</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Supervisi</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Task Force</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Lainnya (sebutkan)</td>
        <td class="align-right">- 8</td>
        <td colspan="6"><?=$vi->metode_pemeriksaan_kualitas_pengumpulan_data_lainnya;?></td>
        <td></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>6.3. Apakah Melakukan Penyesuaian Nonrespon?</label>
        </td>
        <td>
            <div class="box"><?=$vi->apakah_melakukan_penyesuaian_nonrespon;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Ya</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Tidak</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="section-header">
        <td colspan="11"><span style="font-weight:normal; font-size:small;">
            Pertanyaan 6.4 – 6.7 ditanyakan jika sarana pengumpulan data adalah PAPI, CAPI, atau CATI<br>(Pilihan R.4.7. kode 1, 2, dan/atau 4 dilingkari)
        </span></td>
      </tr>

      <tr class="question">
        <td colspan="10">
            <label>6.4. Petugas Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box">&nbsp;<?=$vi->petugas_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Staf instansi penyelenggara</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Mitra/tenaga kontrak</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Staf instansi penyelenggara dan mitra/tenaga kontrak</td>
        <td class="align-right">- 3</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>6.5. Persyaratan Pendidikan Terendah Petugas Pengumpulan Data:</label>
        </td>
        <td>
            <div class="box">&nbsp;<?=$vi->persyaratan_pendidikan_terendah_petugas_pengumpulan_data;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">&leq; SMP</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">SMA/SMK</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Diploma I/II/III</td>
        <td class="align-right">- 3</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Diploma IV/S1/S2/S3</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>6.6. Jumlah Petugas:</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Supervisor/penyelia/pengawas</td>
        <td><div class="box">&nbsp;<?=$vi->jumlah_petugas_supervisor;?></div></td>
        <td colspan="7"> orang</td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Pengumpul data/enumerator</td>
        <td><div class="box">&nbsp;<?=$vi->jumlah_petugas_enumerator;?></div></td>
        <td colspan="7"> orang</td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>6.7. Apakah Melakukan Pelatihan Petugas?</label>
        </td>
        <td>
            <div class="box">&nbsp;<?=$vi->apakah_melakukan_pelatihan_petugas;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Ya</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Tidak</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="section-header">
        <td colspan="11">VII. PENGOLAHAN DAN ANALISIS</td>
      </tr>

      <tr class="question">
        <td colspan="11">
            <label>7.1. Tahapan Pengolahan Data:</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Penyuntingan (Editing)</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$vii->tahapan_pengolahan_data_editing;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Penyandian (Coding)</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$vii->tahapan_pengolahan_data_coding;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Data Entry</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$vii->tahapan_pengolahan_data_entry;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Penyahihan (Validasi)</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$vii->tahapan_pengolahan_data_validasi;?></div></td>
      </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="10">
            <label>7.2. Metode Analisis:</label>
        </td>
        <td>
            <div class="box"><?=$vii->metode_analisis;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Deskriptif</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Inferensia</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Deskriptif dan Inferensia</td>
        <td class="align-right">- 3</td>
        <td colspan="7"></td>
      </tr>
    </table>

    <div style="page-break-after: always;"></div>

    <!-- HALAMAN 7 -->

    <table>
      <tr style="display:none;">
        <?php 
            foreach($width as $w) echo '<td style="width:'.$w.'%">&nbsp;</td>';
        ?>
      </tr>

      <tr class="question">
        <td colspan="10">
            <label>7.3. Unit Analisis:</label>
        </td>
        <td>
            <div class="box"><?=$vii->unit_analisis;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Individu</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Rumahtangga</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Usaha/perusahaan</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Lainnya, sebutkan</td>
        <td class="align-right">- 8</td>
        <td colspan="7"><?=$vii->unit_analisis_lainnya;?></td>
     </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

     <tr class="question">
        <td colspan="10">
            <label>7.4. Tingkat Penyajian Hasil Analisis:</label>
        </td>
        <td>
            <div class="box"><?=$vii->tingkat_penyajian_hasil_analisis;?></div>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Nasional</td>
        <td class="align-right">- 1</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Provinsi</td>
        <td class="align-right">- 2</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Kabupaten/Kota</td>
        <td class="align-right">- 4</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Kecamatan</td>
        <td class="align-right">- 8</td>
        <td colspan="7"></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Lainnya, sebutkan</td>
        <td class="align-right">- 16</td>
        <td colspan="7"><?=$vii->tingkat_penyajian_hasil_analisis_lainnya;?></td>
     </tr>

     <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

     <tr class="section-header">
        <td colspan="11">VIII. DISEMINASI HASIL</td>
     </tr>

      <tr class="question">
        <td colspan="11">
            <label>8.1. Produk Kegiatan yang Tersedia untuk Umum:</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Tercetak (hardcopy)</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$viii->ketersediaan_produk_tercetak;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Digital (softcopy)</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$viii->ketersediaan_produk_digital;?></div></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2">Data Mikro</td>
        <td colspan="2">Ya - 1</td>
        <td colspan="5">Tidak - 2</td>
        <td><div class="box"><?=$viii->ketersediaan_produk_mikrodata;?></div></td>
      </tr>

      <tr class="end-question"><td colspan="11">&nbsp;</td></tr>

      <tr class="question">
        <td colspan="11">
            <label>8.2. Jika pilihan R.8.1. kode 1, Rencana Rilis Produk Kegiatan:</label>
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td colspan="9"><label>Tanggal</label></td>
      </tr>
      <tr>
        <td></td>
        <td>Tercetak</td>
        <td colspan="9">: <?=format_tanggal($viii->rencana_jadwal_rilis_produk_tercetak);?></td>
      </tr>
      <tr>
        <td></td>
        <td>Digital</td>
        <td colspan="9">: <?=format_tanggal($viii->rencana_jadwal_rilis_produk_digital);?></td>
      </tr>
      <tr>
        <td></td>
        <td>Data Mikro  </td>
        <td colspan="9">: <?=format_tanggal($viii->rencana_jadwal_rilis_produk_mikrodata);?></td>
      </tr>

      <tr class="end-question"><td colspan="11">&nbsp;</td></tr>
 
    </table>

    <table style="margin-top:80px">
        <tr>
            <td style="width:30%;">&nbsp;</td>
            <td style="width:30%">&nbsp;</td>
            <td style="text-align:center;">
                <?=$data->kota_tanda_tangan ;?>, <?=substr($data->tanggal_tanda_tangan,0,1)? date('d F Y', strtotime($data->tanggal_tanda_tangan)) : '<div style="width:120px; color:#fff; display:inline-block">&nbsp;.</div>';?><br>
                <br>
                <br>
<!--                 <i>- ditandatangani -</i>
 -->                <br>
                <br>
                <?=$data->nama_tanda_tangan;?><br>
                NIP. <?=$data->nip_tanda_tangan;?>
            </td>
        </tr>

        <tr>
          <td style="text-align:center; font-style: italic; font-size: small">
            <!--img src="<?=FCPATH.'/'.$qr_file;?>"-->
            <div style="italic;">
<!--              Diunduh dari website OMAE <br>pada <?=date('d-m-Y H:i:s');?>
-->            </div>
          </td>
          <td><!--<img src="<?=FCPATH.'/assets/'.($error?'error':'clean').'.png';?>">--></td>
          <td></td>
    </table>

  </div>
</body>
</html>

<?php
function format_tanggal($tanggal)
{
  $date = strtotime($tanggal);
  if($date)
    return date('d-m-Y', $date);
}