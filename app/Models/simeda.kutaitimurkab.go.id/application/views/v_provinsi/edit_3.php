<?php $approved = $data->approval_on!='0000-00-00 00:00:00'; ?>
<?php
$blok_iii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iii');
$blok_iv = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iv');
?>
<form method="post">
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
							<td><input class="form-control" type="date" approval="" blok="iii" id="perencanaan_kegiatan_awal" name="blok_iii[perencanaan_kegiatan_awal]" value="<?=$blok_iii->perencanaan_kegiatan_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="perencanaan_kegiatan_akhir" name="blok_iii[perencanaan_kegiatan_akhir]" value="<?=$blok_iii->perencanaan_kegiatan_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>2. Desain</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="desain_awal" name="blok_iii[desain_awal]" value="<?=$blok_iii->desain_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="desain_akhir" name="blok_iii[desain_akhir]" value="<?=$blok_iii->desain_akhir;?>"></td>
						</tr>	

						<tr>
							<th align="left" colspan="8">B. Pengumpulan</th>
						</tr>
						<tr tanggal>
							<td>3. Pengumpulan Data</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="pengumpulan_data_awal" name="blok_iii[pengumpulan_data_awal]" value="<?=$blok_iii->pengumpulan_data_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="pengumpulan_data_akhir" name="blok_iii[pengumpulan_data_akhir]" value="<?=$blok_iii->pengumpulan_data_akhir;?>"></td>
						</tr>	

						<tr>
							<th align="left" colspan="8">C. Pemeriksaan</th>
						</tr>
						<tr tanggal>
							<td>4. Pengolahan Data</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="pengolahan_data_awal" name="blok_iii[pengolahan_data_awal]" value="<?=$blok_iii->pengolahan_data_awal;?>"></td>
							<td>s.d</td> 
							<td><input class="form-control" type="date"  approval="" blok="iii" id="pengolahan_data_akhir" name="blok_iii[pengolahan_data_akhir]" value="<?=$blok_iii->pengolahan_data_akhir;?>"></td>
						</tr>							

						<tr>
							<th align="left" colspan="8">D. Penyebarluasan</th>
						</tr>
						<tr tanggal>
							<td>5. Analisis</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="analisis_awal" name="blok_iii[analisis_awal]" value="<?=$blok_iii->analisis_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="analisis_akhir" name="blok_iii[analisis_akhir]" value="<?=$blok_iii->analisis_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>6. Diseminasi Hasil</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="diseminasi_hasil_awal" name="blok_iii[diseminasi_hasil_awal]" value="<?=$blok_iii->diseminasi_hasil_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="diseminasi_hasil_akhir" name="blok_iii[diseminasi_hasil_akhir]" value="<?=$blok_iii->diseminasi_hasil_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>7. Evaluasi</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="evaluasi_awal" name="blok_iii[evaluasi_awal]" value="<?=$blok_iii->evaluasi_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" approval="" blok="iii" id="evaluasi_akhir" name="blok_iii[evaluasi_akhir]" value="<?=$blok_iii->evaluasi_akhir;?>"></td>
						</tr>
					</tbody>							
				</table>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>3.4.	Variabel (Karakteristik) yang Dikumpulkan:</label>
				<?=anchor('v_provinsi/variabel/'.$data->id_ms_keg,'<span class="badge bg-blue pull-right"><i class="fa fa-link"></i> Verifikasi Variabel</span>','target=_variabel');?>
				<table id="tabel-variabel" class="table col-sm-offset-1" style="width: 96.67%">
					<thead>
						<tr>
							<th style="width:20px">No</th>
							<th>Nama Variabel (karakteristik)</th>
							<th>Konsep</th>
							<th>Definisi</th>
							<th>Referensi Waktu (Periode Enumerasi)</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($this->mskegiatan_model->get_variabel($data->id_ms_keg) as $row){
							echo '<tr key="'.$row->id.'" cek="'.$row->checklist.'">
								<td>'.($no++).'</td>
								<td>'.$row->nama_variabel.'</td>
								<td>'.$row->konsep.'</td>
								<td>'.$row->definisi.'</td>
								<td>'.$row->referensi_waktu.'</td>	
								<td></td>
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
				<input class="form-control" blok="iv" approval="" id="kegiatan_ini_dilakukan" value="<?=$blok_iv->kegiatan_ini_dilakukan;?>" list-item>
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
				<input class="form-control"  blok="iv" approval="" id="frekuensi_penyelenggaraan" value="<?=$blok_iv->frekuensi_penyelenggaraan;?>" list-item>
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

<?php if(!$approved) { ?>
	<div class="box-footer" style="text-align:right">
		Kunci data,  proses verfikasi belum selesai 
		<input type="checkbox" id="sedang_verifikasi" <?=$data->sedang_verifikasi?'checked':'';?>> 
	</div>
<?php } ?>
</div>

<!-- Pagination -->
<div class="col-sm-2">
	<?=anchor($this->router->class.'/edit/'.$data->id_ms_keg.'/'.($page-1), '<i class="fa fa-chevron-left"></i> Sebelumnya', array('class'=>'btn btn-sm btn-default'));?>
</div>
<div class="col-sm-8" style="text-align: center">
	<?php for($i=1; $i<=7; $i++) echo anchor($this->router->class.'/edit/'.$data->id_ms_keg.'/'.$i,$i, array('class'=>'btn btn-sm btn-'.($i==$page?'primary':'default')));?>
</div>
<div class="col-sm-2 pull-right">
	<?=anchor($this->router->class.'/edit/'.$data->id_ms_keg.'/'.($page+1), 'Selanjutnya <i class="fa fa-chevron-right"></i>', array('class'=>'btn btn-sm btn-primary'));?>
</div>
<!-- Pagination -->

</form>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('v_kegiatan');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iv'));?>;
var approved = <?=$approved?'true':'false';?>;
<?php if(!$approved) { ?>
$('#sedang_verifikasi').change(function(){
  var value = $(this).is(':checked');
  $.post('<?=base_url('v_kegiatan/sedang_verifikasi');?>', {id_ms_keg:<?=$data->id_ms_keg;?>, value: $(this).is(':checked')}, function(result){
  },'json');
});
<?php } ?>

$('#tabel-variabel tbody tr').each(function(){
	var cek = $(this).attr('cek');
	var ikon = '<span class="badge bg-gray"><i class="fa fa-question"></i></class>';
	if(cek=='1') ikon = '<span class="badge bg-green"><i class="fa fa-check"></i></class>';
	else if(cek=='2') ikon = '<span class="badge bg-orange"><i class="fa fa-info"></i></class>';
	$(this).find('td:last-child').html(ikon); 
});
</script>

<script src="<?=base_url('assets/omae/v_kegiatan.js');?>"></script>
<link rel="stylesheet" href="<?=base_url('assets/omae/v_kegiatan.css');?>">

<?php if($error){ ?>
<div class="modal fade" id="modal-error">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-warning"></i> Error Halaman Ini</h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
    </div>
  </div>
</div>
<script>
$('h1').prepend('<small style="vertical-align:top"><span id="validasi" class="label bg-red" title="Validasi Error">E</span></small>');
$('h1 .label').css('cursor','pointer').click(function(){
	$.get('<?=base_url('ms_kegiatan/validasi/'.$data->id_ms_keg.'/'.$page);?>', function(result){
		//console.log(result);
		if(result.length>0){
			$('#modal-error .modal-body').html('<ul></ul>');
			$.each(result, function(i,e){
				$('#modal-error .modal-body ul').append('<li>'+e+'</li>');
			});
			$('#modal-error .modal-body ul li').css('margin-bottom','10px');
			$('#modal-error').modal('show');
		} else
			alert('Error ada di halaman lainnya');
	},'json');
});
</script>
<?php } ?>
