<?php foreach($this->mskegiatan_model->all_by_wilayah($this->session->userdata('id_wilayah')) as $row) { 
$lock = $row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00'? '<i class="fa fa-lock"></i>' : '';
$approved = $row->approval_on!='0000-00-00 00:00:00'? '<span class="label bg-green pull-right"><i class="fa fa-check"></i></span>' : '<span class="label bg-gray pull-right"><i class="fa fa-question"></i></span>';
$error = $this->mskegiatan_model->get_validasi($row->id_ms_keg)?'<span class="label bg-red" title="Masih ada validasi yang error">Error</span>' : '<span class="label bg-green">Clean</span>';
$e_indikator = $this->mskegiatan_model->get_validasi_indikator($row->id_ms_keg);
?>
<div class="box box-info">
	<blockquote key="<?=$row->id_ms_keg;?>">
		<judul><?=anchor($this->router->class.'/edit/'.$row->id_ms_keg, $row->judul_kegiatan.' ('.$row->tahun.')');?></judul> <?=$approved;?>
		<small><?=$lock;?> <?=$error;?> &middot; <?=$row->instansi;?>  &middot; <a href="#" key="<?=$this->mskegiatan_model->get_hash($row->id_ms_keg);?>"><i class="fa fa-download"></i></a> </small>
	</blockquote>
	<?php $vars = $this->mskegiatan_model->get_indikator($row->id_ms_keg);
	if ($vars) { 
	?>
	<table id="tabel-indikator" class="table" key="<?=$row->id_ms_keg;?>">
		<thead>
			<tr>
				<th style="width:20px">No</th>
				<th>Nama Indikator</th>
				<th>Konsep</th>
				<th>Definisi</th>
				<th>Satuan</th>
				<th>Dapat Diakses Umum</th>
			</tr>
			<tr>
				<td>(1)</td>
				<td>(2)</td>
				<td>(3)</td>
				<td>(4)</td>
				<td>(8)</td>
				<td>(17)</td>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($vars as $v){
				echo '<tr key="'.$v->id.'" checklist="'.$v->checklist.'"'.(!empty($e_indikator[$v->id])?' error' : '').'>
					<td>'.($no++).'</td>
					<td>'.$v->nama_indikator.'</td>
					<td>'.$v->konsep.'</td>
					<td>'.$v->definisi.'</td>
					<td>'.$v->satuan.'</td>
					<td>'.$v->dapat_diakses_umum.'</td>
				</tr>';
			}?>
		</tbody>
	</table>
	<?php } ?>
</div>
<?php } ?>

<style>
blockquote {border-left: 3px solid #00c0ef80; border-bottom: 1px solid #00c0ef40}
	blockquote { margin-bottom: 0; }
	thead td, tbody td:last-child { font-size: small; text-align: center; padding: 0}
	thead th, tbody td:first-child { text-align: center; }
	tbody tr:hover {background:#f0f0f0}

.bulat {
	font-size: smaller;
	width: 19px;
	height: 19px;
	margin: 2px 0px;
	padding-top: 3px;
	border: 1px solid #ccc;
	border-radius: 50%;
	text-align: center;
	color: #ccc;
}
.bulat.fa-check { background-color: green;}
.bulat.fa-info { background-color: orange;}
.bulat.fa-exclamation { background-color: red;}
</style>

<script>
	$('a[key]').click(function(){
        window.open('<?=base_url('ind/');?>'+$(this).attr('key'));
	});

	$('thead th').css('text-align','left').css('vertical-align','middle');
	$('thead td').css('text-align','left').css('padding-top','1px').css('padding-bottom','1px');

	$('#tabel-indikator tbody tr').each(function(){
		var checklist = $(this).attr('checklist');
		var title = checklist=='1'?'Terisi, sesuai' : checklist=='2'?'Terisi, tidak sesuai' : checklist=='3'? 'Tidak terisi' : 'Menunggu approval';
		var ikon = checklist=='1'?'check': checklist=='3'? 'exclamation' : checklist=='2'? 'info' : 'question';
		$(this).append('<td><i class="bulat fa fa-'+ikon+'" title="'+title+'"></i></td>');
		
		if($(this).is('[error]'))
		    $(this).find('td:last-child').append('<br><span class="label bg-red" title="Ada error di Indikator ini">E</span>');
	});

$('i.fa-lock').css('cursor','pointer').attr('title','Klik untuk UNLOCK kegiatan beserta variabel dan indikator').click(function(){
    var $this = $(this);
    var judul = $(this).closest('blockquote').find('judul').text();
    if(confirm('Unlock kegiatan ini beserta variabel dan indikatornya ?'+'\n\n'+judul)) {
        var key = $(this).closest('blockquote').attr('key');
        $.post('<?=base_url('v_kegiatan/sedang_verifikasi');?>', {id_ms_keg:key, value:false}, function(result){
            $this.remove();
        },'json');
    }
});

</script>