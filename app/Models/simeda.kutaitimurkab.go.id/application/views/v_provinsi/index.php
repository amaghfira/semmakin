<?php
$arr_keg = array();
$sql = "select id_wilayah, count(distinct(userid)) as instansi, count(*) as kegiatan ".
    "from ".$this->db->dbprefix."ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $row)
  $arr_keg[$row->id_wilayah] = array(
    'instansi' => $row->instansi,
    'kegiatan' => $row->kegiatan,
    'approved' => '0',
    'variabel' => '0',
    'indikator' => '0',
  );
$sql = "select id_wilayah, sum(case when cek_keg=1 then 1 end) as cek_keg, sum(case when cek_keg=1 then 1 end) as cek_keg, sum(case when cek_var=1 then 1 end) as cek_var,  sum(case when cek_ind=1 then 1 end) as cek_ind ".
    "from ".$this->db->dbprefix."cek_provinsi cek_provinsi join ".$this->db->dbprefix."ms_keg ms_keg on cek_provinsi.id_ms_keg=ms_keg.id_ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $row) {
  $arr_keg[$row->id_wilayah]['approved'] = $row->cek_keg;
  $arr_keg[$row->id_wilayah]['variabel'] = $row->cek_var;
  $arr_keg[$row->id_wilayah]['indikator'] = $row->cek_ind;
} ?>
<div class="box box-body">
    <table class="table table-stripe">
        <thead>
            <tr>
                <th>Kode/Wilayah</th>
                <th>Instansi<br>Yang Mengisi</th>
                <th>MS Kegiatan</th>
                <th>Approval<br>MS Kegiatan</th>
                <th>Approval<br>MS Variabel</th>
                <th>Approval<br>MS Indikator</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = array('instansi'=>0, 'kegiatan'=>0, 'approved'=>0, 'variabel'=>0, 'indikator'=>0, 'target_kontributor'=>0);
            foreach($this->wilayah_model->get_all() as $row){
              if(isset($arr_keg[$row->id])) { 
                echo '<tr key="'.$row->id.'">'.
                '<td>'.$row->id.'. '.$row->wilayah.'</td>'.
                '<td>'.$arr_keg[$row->id]['instansi'].'</td>'.
                '<td>'.$arr_keg[$row->id]['kegiatan'].'</td>'.
                '<td>'.$arr_keg[$row->id]['approved'].'</td>'.
                '<td>'.$arr_keg[$row->id]['variabel'].'</td>'.
                '<td>'.$arr_keg[$row->id]['indikator'].'</td>'.
                '<td></td>'.
                "</tr>\n";
                $sum['instansi']+=$arr_keg[$row->id]['instansi'];
                $sum['kegiatan']+=$arr_keg[$row->id]['kegiatan'];
                $sum['variabel']+=$arr_keg[$row->id]['variabel'];
                $sum['indikator']+=$arr_keg[$row->id]['indikator'];
                $sum['approved']+=$arr_keg[$row->id]['approved'];
              } else  
                echo '<tr>'.
                '<td>'.$row->id.'. '.$row->wilayah.'</td>'.
                '<td></td>'.
                '<td></td>'.
                '<td></td>'.
                '<td></td>'.
                '<td></td>'.
                "</tr>\n";
            }
            ?>
        </tbody>
    </table>
</div>

<style>
thead tr th {position:sticky; top:0; background:#fff;}
tbody tr:hover {background:#eee;}
</style>

<script>
$('tbody tr').each(function(){
    var key = $(this).attr('key');
    var td = $(this).find('td:first-child()');
    td.html('<a href="<?=base_url('v_provinsi/index/');?>'+key+'">'+td.text()+'</a>');
});

$('tbody tr td').each(function(){
    if($(this).text()=='0')
        $(this).text('');
});
</script>