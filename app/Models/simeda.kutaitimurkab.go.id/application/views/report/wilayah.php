<?php
$arr_keg = array();
$sql = "select id_wilayah, count(distinct(userid)) as instansi, count(*) as kegiatan, sum(case when approval_on not like '0000%' then 1 else 0 end) as approved ".
    "from ".$this->db->dbprefix."ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $row)
  $arr_keg[$row->id_wilayah] = array(
    'instansi' => $row->instansi,
    'kegiatan' => $row->kegiatan,
    'approved' => $row->approved,
    'variabel' => '',
    'indikator' => '',
  );

$sql = "select id_wilayah, count(*) as variabel ".
    "from ".$this->db->dbprefix."ms_var ms_var join ".$this->db->dbprefix."ms_keg ms_keg on ms_keg.id_ms_keg=ms_var.id_ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $row)
  if(isset($arr_keg[$row->id_wilayah])) $arr_keg[$row->id_wilayah]['variabel'] = $row->variabel;

$sql = "select id_wilayah, count(*) as indikator ".
    "from ".$this->db->dbprefix."ms_ind ms_ind join ".$this->db->dbprefix."ms_keg ms_keg on ms_keg.id_ms_keg=ms_ind.id_ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $row)
  if(isset($arr_keg[$row->id_wilayah])) $arr_keg[$row->id_wilayah]['indikator'] = $row->indikator;
?>
<div class="box box-body">
    <table class="table table-stripe">
        <thead>
            <tr>
                <th>Kode/Wilayah</th>
                <th>Jumlah OPD <br> Kontributor DDA</th>
                <th>Instansi <br> Yang Mengisi</th>
                <th>MS Kegiatan</th>
                <th>Approved</th>
                <th>MS Variabel</th>
                <th>MS Indikator</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = array('instansi'=>0, 'kegiatan'=>0, 'approved'=>0, 'variabel'=>0, 'indikator'=>0, 'target_kontributor'=>0);
            foreach($this->wilayah_model->get_all() as $row){
              if(isset($arr_keg[$row->id])) { 
                echo '<tr key="'.$row->id.'">'.
                '<td>'.$row->id.'. '.$row->wilayah.'</td>'.
                '<td>'.$row->target_kontributor.'</td>'.
                '<td>'.$arr_keg[$row->id]['instansi'].'</td>'.
                '<td>'.$arr_keg[$row->id]['kegiatan'].'</td>'.
                '<td>'.$arr_keg[$row->id]['approved'].'</td>'.
                '<td>'.$arr_keg[$row->id]['variabel'].'</td>'.
                '<td>'.$arr_keg[$row->id]['indikator'].'</td>'.
                "</tr>\n";
                $sum['instansi']+=$arr_keg[$row->id]['instansi'];
                $sum['target_kontributor']+=$row->target_kontributor;
                $sum['kegiatan']+=$arr_keg[$row->id]['kegiatan'];
                $sum['approved']+=$arr_keg[$row->id]['approved'];
                $sum['variabel']+=$arr_keg[$row->id]['variabel']?$arr_keg[$row->id]['variabel']:0;
                $sum['indikator']+=$arr_keg[$row->id]['indikator']?$arr_keg[$row->id]['indikator']:0;
              } else  
                echo '<tr>'.
                '<td>'.$row->id.'. '.$row->wilayah.'</td>'.
                '<td>'.$row->target_kontributor.'</td>'.
                '<td></td>'.
                '<td></td>'.
                '<td></td>'.
                '<td></td>'.
                '<td></td>'.
                "</tr>\n";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th><?=$sum['target_kontributor'];?></th>
                <th><?=$sum['instansi'];?></th>
                <th><?=$sum['kegiatan'];?></th>
                <th><?=$sum['approved'];?></th>
                <th><?=$sum['variabel'];?></th>
                <th><?=$sum['indikator'];?></th>
            </tr>            
        </tfoot>
    </table>
</div>

<style>
thead tr th {position:sticky; top:0; background:#fff;}
tbody tr td:first-child {position:sticky; left:0px;}

tbody tr:hover {background:#eee;}

</style>

<script>
$('tbody tr').each(function(){
    var key = $(this).attr('key');
    var td = $(this).find('td:first-child()');
    td.html('<a href="<?=base_url('report/instansi/');?>'+key+'">'+td.text()+'</a>');
});

$('tbody tr td').hover(function(){
    var col = $(this).index();
    var title = $('thead tr th:nth-child('+(col+1)+')').text();
    if(col>0)
        $(this).attr('title',title);
});
</script>