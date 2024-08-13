<?php
$blok_iii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iii');
$blok_iv = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iv');
?>
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>3.3.	Rencana Jadwal Kegiatan:</label>
				<table class="table col-sm-offset-1">
					<thead>
						<tr>
							<th></th>
							<th>AWAL</th>
							<th>&nbsp;</th>
							<th>AKHIR</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th align="left" colspan="8">A. Perencanaan</th>
						</tr>
						<tr tanggal>
							<td>1. Perencanaan Kegiatan</td>
							<td><input class="form-control" type="date" name="blok_iii[perencanaan_kegiatan_awal]" value="<?=$blok_iii->perencanaan_kegiatan_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[perencanaan_kegiatan_akhir]" value="<?=$blok_iii->perencanaan_kegiatan_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>2. Desain</td>
							<td><input class="form-control" type="date" name="blok_iii[desain_awal]" value="<?=$blok_iii->desain_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[desain_akhir]" value="<?=$blok_iii->desain_akhir;?>"></td>
						</tr>	

						<tr>
							<th align="left" colspan="8">B. Pengumpulan</th>
						</tr>
						<tr tanggal>
							<td>3. Pengumpulan Data</td>
							<td><input class="form-control" type="date" name="blok_iii[pengumpulan_data_awal]" value="<?=$blok_iii->pengumpulan_data_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[pengumpulan_data_akhir]" value="<?=$blok_iii->pengumpulan_data_akhir;?>"></td>
						</tr>	

						<tr>
							<th align="left" colspan="8">C. Pemeriksaan</th>
						</tr>
						<tr tanggal>
							<td>4. Pengolahan Data</td>
							<td><input class="form-control" type="date" name="blok_iii[pengolahan_data_awal]" value="<?=$blok_iii->pengolahan_data_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[pengolahan_data_akhir]" value="<?=$blok_iii->pengolahan_data_akhir;?>"></td>
						</tr>							

						<tr>
							<th align="left" colspan="8">D. Penyebarluasan</th>
						</tr>
						<tr tanggal>
							<td>5. Analisis</td>
							<td><input class="form-control" type="date" name="blok_iii[analisis_awal]" value="<?=$blok_iii->analisis_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[analisis_akhir]" value="<?=$blok_iii->analisis_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>6. Diseminasi Hasil</td>
							<td><input class="form-control" type="date" name="blok_iii[diseminasi_hasil_awal]" value="<?=$blok_iii->diseminasi_hasil_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[diseminasi_hasil_akhir]" value="<?=$blok_iii->diseminasi_hasil_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>7. Evaluasi</td>
							<td><input class="form-control" type="date" name="blok_iii[evaluasi_awal]" value="<?=$blok_iii->evaluasi_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[evaluasi_akhir]" value="<?=$blok_iii->evaluasi_akhir;?>"></td>
						</tr>
					</tbody>							
				</table>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>3.4.	Variabel (Karakteristik) yang Dikumpulkan:</label>
				<table id="tabel-variabel" class="table col-sm-offset-1" style="width: 96.67%">
					<thead>
						<tr>
							<th style="width:20px">No</th>
							<th>Nama Variabel (karakteristik)</th>
							<th>Konsep</th>
							<th>Definisi</th>
							<th>Referensi Waktu (Periode Enumerasi)</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($this->mskegiatan_model->get_variabel($data->id_ms_keg) as $row){
							echo '<tr key="'.$row->id.'" checklist="<?=$row->checklist;?>">
								<td>'.($no++).'</td>
								<td>'.$row->nama_variabel.'</td>
								<td>'.$row->konsep.'</td>
								<td>'.$row->definisi.'</td>
								<td>'.$row->referensi_waktu.'</td>							
							</tr>';
						}?>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		IV. DESAIN KEGIATAN
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>4.1. Kegiatan Ini Dilakukan</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="kegiatan_ini_dilakukan" name="blok_iv[kegiatan_ini_dilakukan]" value="<?=$blok_iv->kegiatan_ini_dilakukan;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Hanya Sekali  <span class="pull-right">- 1</span></li>
			</div>
			<div class="col-sm-2">
				<i class="fa fa-long-arrow-right"></i> langsung ke R.4.3</span>
			</div>
			<div class="col-sm-4">
				<li>Berulang <span class="pull-right">- 2</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.2. Jika “berulang” (R.4.1. berkode 2), Frekuensi Penyelenggaraan:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="frekuensi_penyelenggaraan" name="blok_iv[frekuensi_penyelenggaraan]" value="<?=$blok_iv->frekuensi_penyelenggaraan;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Harian <span class="pull-right">- 1</span></li>
				<li>Mingguan <span class="pull-right">- 2</span></li>
				<li>Bulanan <span class="pull-right">- 3</span></li>
				<li>Triwulanan <span class="pull-right">- 4</span></li>
			</div>
			<div class="col-sm-2">
				
			</div>
			<div class="col-sm-4">
				<li>Empat Bulanan <span class="pull-right">- 5</span></li>
				<li>Semesteran <span class="pull-right">- 6</span></li>
				<li>Tahunan <span class="pull-right">- 7</span></li>
				<li>> Dua Tahunan <span class="pull-right">- 8</span></li>
			</div>
		</div>
	</div>
</div>

<!-- Pagination -->
<div class="col-sm-3 pull-right">
</div>
<div class="col-sm-3">
</div>
<div class="col-sm-6" style="text-align: center">
	<?php for($i=1; $i<=7; $i++) echo anchor($this->router->class.'/view/'.$data->id_ms_keg.'/'.$i,$i, array('class'=>'btn btn-sm btn-'.($i==$page?'primary':'default')));?>
</div>
<!-- Pagination -->

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<div id="myVar" style="display: none">
	<input type="hidden" id="id_variabel" name="id_variabel" value="">
	<div class="row">
		<label>Nama Variabel</label>
		<input id="nama_variabel" name="nama_variabel" class="form-control" required>
	</div>
	<div class="row">
		<label>Konsep</label>
		<textarea id="konsep" name="konsep" class="form-control" rows="6" required></textarea>
	</div>
	<div class="row">
		<label>Definisi</label>
		<textarea id="definisi" name="definisi" class="form-control" rows="6" required></textarea>
	</div>
	<div class="row">
		<label>Periode Enumerasi</label>
		<input id="referensi_waktu" name="referensi_waktu" class="form-control" required>
	</div>
	<div class="row">
	</div>
</div>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<style>
	div[role=dialog] {font-size:small}
	#myVar {padding:0 20px}
	#myVar button {margin-top:10px}

	.bulat {
		font-size: smaller;
		width: 19px;
		height: 19px;
		margin: 2px -10px 2px 5px;
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
$('#tabel-variabel tbody tr').each(function(){
	var checklist = $(this).attr('checklist');
	var title = checklist=='1'?'Terisi, sesuai' : checklist=='2'?'Terisi, tidak sesuai' : checklist=='3'? 'Tidak terisi' : 'Menunggu approval';
	if(checklist=='1')
		$(this).append('<td><i class="bulat fa fa-check" title="'+title+'"></i></td>');
	else{
		var ikon = checklist=='3'? 'exclamation' : checklist=='2'? 'info' : 'question';
		$(this).append('<td><i class="bulat fa fa-'+ikon+'" title="'+title+'"></i></td>');
	}
});

$('#tabel-variabel a').click(function(e){
	e.preventDefault();
	var tr = $(this).closest('tr'); 
	var checklist = tr.attr('checklist'); 

	if(checklist != '1'){
		$('#id_variabel').val(tr.attr('key'));
		$('#nama_variabel').val(tr.find('td:nth-child(2)').text());
		$('#konsep').val(tr.find('td:nth-child(3)').text());
		$('#definisi').val(tr.find('td:nth-child(4)').text());
		$('#referensi_waktu').val(tr.find('td:nth-child(5)').text());

		$('#myVar').dialog({
			title:'Edit Karakterisik',
		});
	}
});

</script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var url2 = '<?=base_url('approval');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iv')
);?>;

</script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/approval.css');?>">
<script src="<?=base_url('assets/omae/approval.js');?>"></script>
