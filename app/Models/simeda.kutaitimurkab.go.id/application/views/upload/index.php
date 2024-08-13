<?php 
$sql = "select id_wilayah,count(*) as t, sum(case when id_indah>0 then 1 end) as r from omae_ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $r){
	$keg[$r->id_wilayah]=array('t'=>$r->t, 'r'=>$r->r);
}
$sql = "select id_wilayah,count(*) as t, sum(case when v.id_indah>0 then 1 end) as r from omae_ms_var v join omae_ms_keg k on k.id_ms_keg=v.id_ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $r){
	$var[$r->id_wilayah]=array('t'=>$r->t, 'r'=>$r->r);
}
$sql = "select id_wilayah,count(*) as t, sum(case when i.id_indah>0 then 1 end) as r from omae_ms_ind i join omae_ms_keg k on k.id_ms_keg=i.id_ms_keg group by id_wilayah order by id_wilayah";
foreach($this->db->query($sql)->result() as $r){
	$ind[$r->id_wilayah]=array('t'=>$r->t, 'r'=>$r->r);
}
?>
<div class="box box-body">
<table class="table">
	<thead>
		<tr>
			<th rowspan="2">Wilayah</th>
			<th colspan="2">Kegiatan</th>
			<th colspan="2">Variabel</th>
			<th colspan="2">Indikator</th>
		</tr>
		<tr>
			<th>T</th><th>R</th>
			<th>T</th><th>R</th>
			<th>T</th><th>R</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($this->wilayah->get_all() as $row) {
	$k = isset($keg[$row->id])?$keg[$row->id]:null;
	$v = isset($var[$row->id])?$var[$row->id]:null;
	$i = isset($ind[$row->id])?$ind[$row->id]:null;
	echo "<tr><td>".anchor('upload/kab/'.$row->id,$row->id)."</td>".
	"<td>".($k?$k['t']:'')."</td><td>".($k?$k['r']:'')."</td>". //keg
	"<td>".($v?$v['t']:'')."</td><td>".($v?$v['r']:'')."</td>". //var
	"<td>".($i?$i['t']:'')."</td><td>".($i?$i['r']:'')."</td>". //ind
	"</tr>\n";
} ?>	
	</tbody>
</table>
</div>