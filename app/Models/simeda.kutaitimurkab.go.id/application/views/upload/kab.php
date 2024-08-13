<?php
$sql = "select k.id_ms_keg,count(*) as t, sum(case when v.id_indah>0 then 1 end) as r from omae_ms_var v join omae_ms_keg k on k.id_ms_keg=v.id_ms_keg where k.id_wilayah='".$id_wilayah."' group by k.id_ms_keg";
foreach($this->db->query($sql)->result() as $r){
	$var[$r->id_ms_keg]=array('t'=>$r->t, 'r'=>$r->r?$r->r:0);
}

$sql = "select k.id_ms_keg,count(*) as t, sum(case when i.id_indah>0 then 1 end) as r from omae_ms_ind i join omae_ms_keg k on k.id_ms_keg=i.id_ms_keg where k.id_wilayah='".$id_wilayah."' group by k.id_ms_keg";
foreach($this->db->query($sql)->result() as $r){
	$ind[$r->id_ms_keg]=array('t'=>$r->t, 'r'=>$r->r?$r->r:0);
}

$sql = "select k.id_ms_keg,cek_keg from omae_cek_provinsi c join omae_ms_keg k on k.id_ms_keg=c.id_ms_keg where k.id_wilayah='".$id_wilayah."' order by k.id_ms_keg";
foreach($this->db->query($sql)->result() as $r){
	$cek[$r->id_ms_keg]=$r->cek_keg;
}

?>
<div class="box box-body">
<table class="table">
	<thead>
		<tr>
			<th>Judul Kegiatan</th>
			<th>App Wali</th>
			<th style="display:none;">Cek Prov</th>
			<th>MS-KEG</th>
			<th>MS-VAR</th>
			<th>MS-IND</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($this->mskeg->all_by_wilayah($id_wilayah) as $row) {
    $pic = $id_wilayah!='6400'? 1 : ($row->created_by?'1':'0');
	$v = isset($var[$row->id_ms_keg])?$var[$row->id_ms_keg]:null;
	$i = isset($ind[$row->id_ms_keg])?$ind[$row->id_ms_keg]:null;
	
	echo "<tr id_ms_keg='".$row->id_ms_keg."' id_indah='".$row->id_indah."' pic='".$pic."'>".
	"<td><small>".$row->instansi."</small><br>".$row->judul_kegiatan.($id_wilayah=='6400' && $row->created_by? "<br><small><i class='fa fa-comments-o'></i> ".$row->created_by."</small>" : "")."</td>".
	"<td cek='".(substr($row->approval_on,0,4)=='0000'?'0':'1')."'></td>".
	"<td style='display:none;' cek=".(!empty($cek[$row->id_ms_keg]) && $cek[$row->id_ms_keg]=='1'? '1' : '0')."></td>".
	"<td cek=".($row->id_indah? '1' : '2')."></td>".
//	"<td cek=".(!$v? '0' : ($v['t']>0 && $v['t']==$v['r']? '1' : '2'))."><small>".$v['r']." of ".$v['t']."</small></td>". 
  //  "<td cek=".(!$i? '0' : ($i['t']>0 && $i['t']==$i['r']? '1' : '2'))."><small>".$i['r']." of ".$i['t']."</small></td>". 
	"<td cek=".(!$v? '0' : ($v['t']>0 && $v['t']==$v['r']? '1' : '2'))."><small>".(isset($v) ? $v['r'] : '-')." of ".(isset($v) ? $v['t'] : '-')."</small></td>". 
    "<td cek=".(!$i? '0' : ($i['t']>0 && $i['t']==$i['r']? '1' : '2'))."><small>".(isset($i) ? $i['r'] : '-')." of ".(isset($i) ? $i['t'] : '-')."</small></td>". 
	"</tr>\n";
} ?>	
	</tbody>
</table>
</div>

<style>
	td small {font-style: italic;}
	td i.fa {font-size: small;}
	td i.fa-sign-out {cursor: pointer;}
	td i.fa-check-square-o {color: limegreen;}

	thead tr th {position: sticky; top: 0}
	tbody tr:hover {background: #eee;}
</style>

<div class="modal fade" id="popup-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      	  <span aria-hidden="true">&times;</span></button>
          <div class="user-block"></div>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<script src="<?=base_url('upload/script/'.$id_wilayah);?>"></script>
