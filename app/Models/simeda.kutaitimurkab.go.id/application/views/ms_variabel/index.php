<?php foreach($this->mskegiatan_model->all($this->session->userdata('userid')) as $row) { 
$lock = $row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00'? '<i class="fa fa-lock"></i>' : '';
$e_variabel = $this->mskegiatan_model->get_validasi_variabel($row->id_ms_keg);
?>
<div class="box">
	<blockquote>
		<?=anchor($this->router->class.'/edit/'.$row->id_ms_keg, $row->judul_kegiatan.' ('.$row->tahun.')');?>
		<small><?=$lock;?> <?=$row->instansi;?>  &middot;  <a href="#" key="<?=$this->mskegiatan_model->get_hash($row->id_ms_keg);?>"><i class="fa fa-download"></i></a> </small>
	</blockquote>
	<?php $vars = $this->mskegiatan_model->get_variabel($row->id_ms_keg);
	if($vars) { 
	?>
	<table id="tabel-variabel" class="table" key="<?=$row->id_ms_keg;?>">
		<thead>
			<tr>
				<th style="width:20px">No</th>
				<th>Nama Variabel</th>
				<th>Konsep</th>
				<th>Definisi</th>
				<th>Tipe Data</th>
				<th>Kalimat Pertanyaan</th>
				<th>Dapat Diakses Umum</th>
			</tr>
			<tr>
				<td>(1)</td>
				<td>(2)</td>
				<td>(4)</td>
				<td>(5)</td>
				<td>(8)</td>
				<td>(11)</td>
				<td>(12)</td>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($vars as $v){
				echo '<tr key="'.$v->id.'" checklist="'.$v->checklist.'"'.(!empty($e_variabel[$v->id])?' error' : '').'>
					<td>'.($no++).'</td>
					<td>'.$v->nama_variabel.'</td>
					<td>'.$v->konsep.'</td>
					<td>'.$v->definisi.'</td>
					<td>'.$v->tipe_data.'</td>							
					<td>'.$v->kalimat_pertanyaan.'</td>							
					<td>'.$v->dapat_diakses_umum.'</td>							

				</tr>';
			}?>
		</tbody>
	</table>
	<?php } ?>
</div>
<?php } ?>

<style>

blockquote {border-left: 3px solid #00c0ef80; border-bottom: 1px solid #00c0ef40;margin-bottom: 0; }
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
        window.open('<?=base_url('var/');?>'+$(this).attr('key'));
	});

	$('thead th').css('text-align','left').css('vertical-align','middle');
	$('thead td').css('text-align','left').css('padding-top','1px').css('padding-bottom','1px');

	$('#tabel-variabel tbody tr').each(function(){
		var checklist = $(this).attr('checklist');
		var title = checklist=='1'?'Terisi, sesuai' : checklist=='2'?'Terisi, tidak sesuai' : checklist=='3'? 'Tidak terisi' : 'Menunggu verifikasi';
		var ikon = checklist=='1'?'check': checklist=='3'? 'exclamation' : checklist=='2'? 'info' : 'question';
		$(this).append('<td><i class="bulat fa fa-'+ikon+'" title="'+title+'"></i></td>');
		if($(this).is('[error]'))
		    $(this).find('td:last-child').append('<br><span class="label bg-red" title="Ada error di Variabel ini">E</span>');
	});

</script>