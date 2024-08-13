<?php
$arr = array();
$sql = "select userid, count(*) as variabel ".
    "from ".$this->db->dbprefix."ms_var join ".$this->db->dbprefix."ms_keg on ".$this->db->dbprefix."ms_keg.id_ms_keg=".$this->db->dbprefix."ms_var.id_ms_keg where id_wilayah='".$id_wilayah."' group by userid order by userid";
foreach($this->db->query($sql)->result() as $row)
    $arr[$row->userid]['variabel'] = $row->variabel;
    
$sql = "select userid, count(*) as indikator ".
    "from ".$this->db->dbprefix."ms_ind join ".$this->db->dbprefix."ms_keg on ".$this->db->dbprefix."ms_keg.id_ms_keg=".$this->db->dbprefix."ms_ind.id_ms_keg where id_wilayah='".$id_wilayah."' group by userid order by userid";
foreach($this->db->query($sql)->result() as $row)
    $arr[$row->userid]['indikator'] = $row->indikator;
?>
<?=form_dropdown('',array(''=>'- Semua Wilayah -')+$this->wilayah_model->arr_all(),$id_wilayah,array('id'=>'pilih_wilayah','class'=>'form-control'));?>
<div class="box box-body">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Instansi</th>
                <th>MS Kegiatan</th>
                <th>MS Variabel</th>
                <th>MS Indikator</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "select userid,instansi,count(*) as kegiatan from ".$this->db->dbprefix."ms_keg where id_wilayah='".$id_wilayah."' group by instansi order by instansi";
            $no = 1;
            foreach($this->db->query($sql)->result() as $row){
                echo '<tr>'.
                '<td>'.($no++).'</td>'.
                '<td>'.$row->instansi.'</td>'.
                '<td>'.$row->kegiatan.'</td>'.
                '<td>'.(!empty($arr[$row->userid]['variabel'])?$arr[$row->userid]['variabel']:'-').'</td>'.
                '<td>'.(!empty($arr[$row->userid]['indikator'])?$arr[$row->userid]['indikator']:'-').'</td>'.
                "</tr>\n";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
$('#pilih_wilayah').change(function(){
    location.href = '<?=base_url('report/instansi');?>/'+$(this).val();
});
</script>