<?php
$ignore = array('userid','id_wilayah','approval_on');

if($id_wilayah){
  $sql = "select blok, field, count(distinct(c.id_ms_keg)) as kegiatan".
    ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
    "from ".$this->db->dbprefix."ms_keg_checklist c ".
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
        "from ".$this->db->dbprefix."ms_keg_checklist c ".
        "join ".$this->db->dbprefix."ms_keg k on k.id_ms_keg=c.id_ms_keg ".
        "where k.id_wilayah='".$id_wilayah."' and k.userid='".$id_instansi."' ".
        "group by blok, field order by blok, field";
    
      $sql3 = "select id_ms_keg, judul_kegiatan, tahun, sedang_verifikasi from ".$this->db->dbprefix."ms_keg ".
        "where id_wilayah='".$id_wilayah."' and userid='".$id_instansi."'";

      $arr_kegiatan = array();
      $arr_lock = array();
      foreach($this->db->query($sql3)->result_array() as $row){
        $arr_kegiatan[$row['id_ms_keg']] = $row['judul_kegiatan']. ' ('.$row['tahun'].')';
        $arr_lock[$row['id_ms_keg']] = $row['sedang_verifikasi'];
      }
      if($id_ms_keg){
          $sql = "select blok, field, count(distinct(c.id_ms_keg)) as kegiatan".
            ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
            "from ".$this->db->dbprefix."ms_keg_checklist c ".
            "join ".$this->db->dbprefix."ms_keg k on k.id_ms_keg=c.id_ms_keg ".
            "where k.id_wilayah='".$id_wilayah."' and k.userid='".$id_instansi."' and k.id_ms_keg='".$id_ms_keg."' ".
            "group by blok, field order by blok, field";
      }
  }
} else {
  $sql = "select blok, field, count(distinct(id_ms_keg)) as kegiatan".
    ",sum(case when checklist=1 then 1 end) as kode_1, sum(case when checklist=2 then 1 end) as kode_2,  sum(case when checklist=3 then 1 end) as kode_3, sum(case when checklist=0 or checklist is null then 1 end) as belum ".
    "from ".$this->db->dbprefix."ms_keg_checklist group by blok, field order by blok, field";
}
?>
<?php
if(substr($this->session->userdata('id_wilayah'),2,2)=='00')
  echo form_dropdown('',array(''=>'- Semua Wilayah -')+$this->wilayah_model->arr_all(),$id_wilayah,array('id'=>'pilih_wilayah','class'=>'form-control'));
?>
<?php
if($id_wilayah){
  echo form_dropdown('',array(''=>'- Semua Instansi -')+$arr_instansi,$id_instansi,array('id'=>'pilih_instansi','class'=>'form-control'));
//  if($id_instansi)
  //  echo form_dropdown('',array(''=>'- Semua Kegiatan -')+$arr_kegiatan,$id_ms_keg,array('id'=>'pilih_kegiatan','class'=>'form-control'));
}
?>


<div class="box box-body">
    <table class="table">
        <tbody>
<?php
if($id_instansi){
    $i=1;
    foreach($arr_kegiatan as $key=>$val)
        echo '<tr key="'.$key.'" lock="'.$arr_lock[$key].'"><td>'.($i++).'. '.$val.'</td></tr>';
}
else if($id_wilayah){
    $i=1;
    foreach($arr_instansi as $key=>$val)
        echo '<tr><td>'.anchor('admin/delete/'.$id_wilayah.'/'.$key, ($i++).'. '.$val).'</td></tr>';
}
else {
    foreach($this->wilayah_model->arr_all() as $key=>$val)
        echo '<tr><td>'.anchor('admin/delete/'.$key, $val).'</td></tr>';
}
?>
        </tbody>
    </table>
</div>

<?php if($id_instansi){ ?>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <div class="user-block">
            <img class="img-circle img-bordered-sm" src="https://webapps.bps.go.id/jateng/omae/assets/theme/img/user7-128x128.jpg">
            <span class="username">Update Instansi</span>
          </div>
      </div>
      <div class="modal-body">
        <div class="alert alert-dismissible" style="padding-right: 15px; text-align: justify;">
            <p id="judul_kegiatan"></p>
            <p>
                <select id="target_instansi" class="form-control"><option value="">- Pilih Target Instansi -</option>
<?php
  $sql3 = "select userid,instansi from ".$this->db->dbprefix."users where id_wilayah='".$id_wilayah."' ";
  foreach($this->db->query($sql3)->result_array() as $row)
    echo '<option value='.$row['userid'].'>'.$row['instansi'].'</option>';
?>
                </select>
            </p>
            <p>
                <button id="submit_instansi" class="btn btn-primary btn-small">Submit</button>
            </p>
          </div>        
      </div>
    </div>
  </div>
</div>

<?php } ?>

<style>
    .fa-toggle, .fa-lock, .fa-unlock, td .fa-user-o, .fa-trash {font-size:12px;}
    .fa-toggle, td .fa-user-o {cursor:pointer; margin-right:8px;}
    .fa-lock {color:red;}
    .fa-unlock {color:green;}
</style>
<script>
<?php if(substr($this->session->userdata('id_wilayah'),2,2)=='00') { ?>
$('#pilih_wilayah').change(function(){
   location.href = "<?=base_url('admin/delete');?>/"+$(this).val(); 
});
<?php } ?>

$('#pilih_instansi').change(function(){
   location.href = "<?=base_url('admin/delete/'.$id_wilayah);?>/"+$(this).val(); 
});  

<?php if($id_wilayah && $id_instansi) { ?>
$('#pilih_kegiatan').change(function(){
   location.href = "<?=base_url('admin/delete/'.$id_wilayah.'/'.$id_instansi);?>/"+$(this).val(); 
});

$('tbody tr').each(function(){
    var lock = $(this).attr('lock')=='1'? 'lock' : 'unlock';
    $(this).find('td').append('<span class="pull-right">'+
    '<a href=#><i class="fa fa-toggle fa-'+ lock +'" title="Lock/Unlock"></i></a>  '+
    '<a href=#><i class="fa fa-user-o" title="Ganti Instansi"></i></a>  '+
    '<a href="#' + $(this).attr('key') + '" title="Hapus Kegiatan"><i class="fa fa-trash pull-right"></i></a></span>');
});

$('tbody tr td i.fa-toggle').click(function(){
    var tr = $(this).closest('tr');
    var key = tr.attr('key');
    var lock = tr.attr('lock');
console.log(key+' :: '+lock);
    if(confirm('Are you sure ?')){
        $.post('<?=base_url('admin/lock');?>', {key:key, lock:lock}, function(result){
console.log(result);
            $(this).removeClass('fa-lock').removeClass('fa-unlock').addClass('fa-'+result.result);
            tr.attr('lock',result.result=='lock'?1:0);
        },'json');
        
    }
});

$('tbody tr td a i.fa-trash').click(function(){
    var key = $(this).closest('tr').attr('key');
    if(confirm('Are you sure ?'))
        location.href='<?=base_url('admin/confirm_delete/');?>'+key;
});

$('tbody tr td a i.fa-user-o').click(function(){
    var key = $(this).closest('tr').attr('key');
    $("#modal-default").modal('show');
    $("#judul_kegiatan").text($(this).closest('tr').find('td:first-child').text());
    $("#submit_instansi").click(function(){
       var instansi =  $("#target_instansi").val();
       if(key && instansi){
           $.get("https://webapps.bps.go.id/jateng/omae/admin/move/"+key+"/"+instansi, function(result){
                if(result.result=='success')
                    location.reload();
                else
                    alert("Something error !!");
           },'json');
       }
    });
});


<?php } ?>
</script>