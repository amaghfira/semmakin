<?php
  $omae = $_SERVER['DOCUMENT_ROOT'].'/omae';

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
    table, tr, th, td {border-collapse: collapse; border: 1px solid #999}
    .noborder, .noborder tr, .noborder td {border: none}
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
    <!-- MS INDIKATOR -->
    <div style="text-align:center;">
      <b>METADATA INDIKATOR</b><br>
      <b><?=$data->judul_kegiatan.' ('.$data->tahun.')';?></b><br>
      <?=$data->instansi;?>
    </div>
    <br>
  <table class="table" key="<?=$data->id_ms_keg;?>">
    <thead>
      <tr>
        <th rowspan="2" style="width:20px">No</th>
        <th rowspan="2">Nama Indikator</th>
        <th rowspan="2">Konsep</th>
        <th rowspan="2">Definisi</th>
        <th rowspan="2">Interpretasi</th>
        <th rowspan="2">Metode/Rumus Penghitungan</th>
        <th rowspan="2">Ukuran</th>
        <th rowspan="2">Satuan</th>
        <th rowspan="2">Klasifikasi Penyajian</th>
        <th rowspan="2">Indikator Komposit</th>
        <th colspan="2">Indikator Pembangun</th>
        <th colspan="3">Variabel Pembangun</th>
        <th rowspan="2">Level Estimasi</th>
        <th rowspan="2">Dapat Diakses Umum</th>
      </tr>
      <tr>
        <th>Publikasi Ketersediaan</th>
        <th>Nama</th>
        <th>Kegiatan Penghasil</th>
        <th>Kode Keg.</th>
        <th>Nama</th>
      </tr>
      <tr>
        <?php for($i=1; $i<=17; $i++) echo '<td>-'.$i.'-</td>'; ?>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($this->mskegiatan_model->get_indikator($data->id_ms_keg) as $v){
        echo '<tr key="'.$v->id.'" checklist="'.$v->checklist.'">
          <td>'.($no++).'</td>
          <td>'.$v->nama_indikator.'</td>
          <td>'.$v->konsep.'</td>
          <td>'.$v->definisi.'</td>
          <td>'.$v->interpretasi.'</td>
          <td>'.$v->metode.'</td>             
          <td>'.$v->ukuran.'</td>             
          <td>'.$v->satuan.'</td>             
          <td>'.$v->klasifikasi.'</td>              
          <td>'.$v->indikator_komposit.'</td>             
          <td>'.$v->indikator_pembangun_publikasi.'</td>              
          <td>'.$v->indikator_pembangun_nama.'</td>             
          <td>'.$v->variabel_pembangun_kegiatan.'</td>              
          <td>'.$v->variabel_pembangun_kode.'</td>              
          <td>'.$v->variabel_pembangun_nama.'</td>              
          <td>'.$v->level_estimasi.'</td>             
          <td>'.$v->dapat_diakses_umum.'</td>             
        </tr>';
      }?>
    </tbody>
  </table>
<br><br>
    <table style="margin-top:80px" class="noborder">
        <tr>
            <td colspan="14">&nbsp;</td>
            <td colspan="3" style="text-align:center;">
                <?=$data->kota_tanda_tangan ;?>, <?=date('d F Y', strtotime($data->tanggal_tanda_tangan));?><br>
                <br>
                <br>
<!--                 <i>- ditandatangani -</i>
 -->                <br>
                <br>
                <?=$data->nama_tanda_tangan;?><br>
                NIP. <?=$data->nip_tanda_tangan;?>
            </td>
        </tr>
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