<?php
$ignore = array('userid','id_wilayah','approval_on');

if($id_wilayah){
  $sql = "select blok, field, count(distinct(c.id_ms_keg)) as kegiatan".
    ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
    "from ".$this->db->dbprefix."ms_keg_checklist_awal c ".
    "join ".$this->db->dbprefix."ms_keg k on k.id_ms_keg=c.id_ms_keg ".
    "where k.id_wilayah='".$id_wilayah."' ".
    "group by blok, field order by blok, field";

  $sql2 = "select userid,instansi from ".$this->db->dbprefix."users ".
    "where userid in (".
      "select distinct(userid) from ".$this->db->dbprefix."ms_keg where id_wilayah='".$id_wilayah."' ".
    ")";
  $arr_instansi = array();
  foreach($this->db->query($sql2)->result_array() as $row)
    $arr_instansi[$row['userid']] = $row['instansi'];

  if($id_instansi){
      $sql = "select blok, field, count(distinct(c.id_ms_keg)) as kegiatan".
        ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
        "from ".$this->db->dbprefix."ms_keg_checklist_awal c ".
        "join ".$this->db->dbprefix."ms_keg k on k.id_ms_keg=c.id_ms_keg ".
        "where k.id_wilayah='".$id_wilayah."' and k.userid='".$id_instansi."' ".
        "group by blok, field order by blok, field";
    
      $sql3 = "select id_ms_keg, judul_kegiatan, tahun from ".$this->db->dbprefix."ms_keg ".
        "where id_wilayah='".$id_wilayah."' and userid='".$id_instansi."'";
      $arr_kegiatan = array();
      foreach($this->db->query($sql3)->result_array() as $row)
        $arr_kegiatan[$row['id_ms_keg']] = $row['judul_kegiatan']. ' ('.$row['tahun'].')';
        
      if($id_ms_keg){
          $sql = "select blok, field, count(distinct(c.id_ms_keg)) as kegiatan".
            ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
            "from ".$this->db->dbprefix."ms_keg_checklist_awal c ".
            "join ".$this->db->dbprefix."ms_keg k on k.id_ms_keg=c.id_ms_keg ".
            "where k.id_wilayah='".$id_wilayah."' and k.userid='".$id_instansi."' and k.id_ms_keg='".$id_ms_keg."' ".
            "group by blok, field order by blok, field";
      }
  }
} else {
  $sql = "select blok, field, count(distinct(id_ms_keg)) as kegiatan".
    ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
    "from ".$this->db->dbprefix."ms_keg_checklist_awal group by blok, field order by blok, field";
}
?>
<?php
if(substr($this->session->userdata('id_wilayah'),2,2)=='00')
  echo form_dropdown('',array(''=>'- Semua Wilayah -')+$this->wilayah_model->arr_all(),$id_wilayah,array('id'=>'pilih_wilayah','class'=>'form-control'));
?>
<?php
if($id_wilayah){
  echo form_dropdown('',array(''=>'- Semua Instansi -')+$arr_instansi,$id_instansi,array('id'=>'pilih_instansi','class'=>'form-control'));
  if($id_instansi)
    echo form_dropdown('',array(''=>'- Semua Kegiatan -')+$arr_kegiatan,$id_ms_keg,array('id'=>'pilih_kegiatan','class'=>'form-control'));
}
?>


<div class="box box-body">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Pertanyaan</th>
<!--            <th>Jml Kegiatan</th>-->
                <th>Terisi & Sesuai</th>
                <th>Terisi, Tidak Sesuai</th>
                <th>Tidak Terisi</th>
                <th>Belum Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach($this->db->query($sql)->result() as $row){
              if(!in_array($row->field, $ignore))
                echo '<tr><td>'.($no++).'</td>'.
                '<td>'.($row->blok? $row->blok.'. ':'').$row->field.'</td>'.
//                '<td>'.$row->kegiatan.'</td>'.
                '<td>'.$row->kode_1.'</td>'.
                '<td>'.$row->kode_2.'</td>'.
                '<td>'.$row->kode_3.'</td>'.
                '<td>'.$row->belum.'</td>'.
                "</tr>\n";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
<?php if(substr($this->session->userdata('id_wilayah'),2,2)=='00') { ?>
$('#pilih_wilayah').change(function(){
   location.href = "<?=base_url('report/feedback_pertama');?>/"+$(this).val(); 
});
<?php } ?>

$('#pilih_instansi').change(function(){
   location.href = "<?=base_url('report/feedback_pertama/'.$id_wilayah);?>/"+$(this).val(); 
});  

<?php if($id_wilayah && $id_instansi) { ?>
$('#pilih_kegiatan').change(function(){
   location.href = "<?=base_url('report/feedback_pertama/'.$id_wilayah.'/'.$id_instansi);?>/"+$(this).val(); 
});  
<?php } ?>
</script>