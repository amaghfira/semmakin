<?php $approved = $data->approval_on!='0000-00-00 00:00:00'; ?>
<?php
$blok_vii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'vii');
$blok_viii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'viii');
?>
<form method="post">
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>7.3. Unit Analisis:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" multi-item approval="" blok="vii" id="unit_analisis" value="<?=$blok_vii->unit_analisis;?>">
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Individu <span class="pull-right">- 1</span></li>
				<li>Rumahtangga <span class="pull-right">- 2</span></li>
				<li>Usaha/perusahaan <span class="pull-right">- 4</span></li>
				<li>Lainnya, sebutkan<span class="pull-right">- 8</span></li>
				<input class="form-control" placeholder="Lainnya..." approval="" blok="vii" id="unit_analisis_lainnya" value="<?=$blok_vii->unit_analisis_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>7.4. Tingkat Penyajian Hasil Analisis:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" multi-item approval="" blok="vii" id="tingkat_penyajian_hasil_analisis" value="<?=$blok_vii->tingkat_penyajian_hasil_analisis;?>">
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Nasional <span class="pull-right">- 1</span></li>
				<li>Provinsi <span class="pull-right">- 2</span></li>
				<li>Kabupaten/Kota <span class="pull-right">- 4</span></li>
				<li>Kecamatan<span class="pull-right">- 8</span></li>
				<li>Lainnya, sebutkan<span class="pull-right">- 16</span></li>
				<input class="form-control" placeholder="Lainnya..." approval="" blok="vii" id="tingkat_penyajian_hasil_analisis_lainnya" value="<?=$blok_vii->tingkat_penyajian_hasil_analisis_lainnya;?>">
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		VIII. DISEMINASI HASIL
	</div>

	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>8.1. Produk Kegiatan yang Tersedia untuk Umum:</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Tercetak (hardcopy)</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" ya-tidak approval="" blok="viii" id="ketersediaan_produk_tercetak" value="<?=$blok_viii->ketersediaan_produk_tercetak;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Digital (softcopy)</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" ya-tidak approval="" blok="viii" id="ketersediaan_produk_digital" value="<?=$blok_viii->ketersediaan_produk_digital;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Data Mikro</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" ya-tidak approval="" blok="viii" id="ketersediaan_produk_mikrodata" value="<?=$blok_viii->ketersediaan_produk_mikrodata;?>"></div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>8.2. Jika pilihan R.8.1. kode 1, Rencana Rilis Produk Kegiatan:</label>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<tr tanggal>
							<td>Tercetak</td>
							<td><input class="form-control" type="date" approval="" blok="viii" id="rencana_jadwal_rilis_produk_tercetak" value="<?=$blok_viii->rencana_jadwal_rilis_produk_tercetak;?>"></td>
						</tr>
						<tr tanggal>
							<td>Digital</td>
							<td><input class="form-control" type="date" approval="" blok="viii" id="rencana_jadwal_rilis_produk_digital" value="<?=$blok_viii->rencana_jadwal_rilis_produk_digital;?>"></td>
						</tr>
						<tr tanggal>
							<td>Data Mikro</td>
							<td><input class="form-control" type="date" approval="" blok="viii" id="rencana_jadwal_rilis_produk_mikrodata" value="<?=$blok_viii->rencana_jadwal_rilis_produk_mikrodata;?>"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="box-footer">
		<div class="col-sm-6 col-sm-offset-6">
			<div class="row">
				<div class="col-sm-7">
					<input class="form-control" placeholder="Nama Kota" approval="" blok="" id="kota_tanda_tangan" value="<?=$data->kota_tanda_tangan;?>">
				</div>
				<div class="col-sm-5">
					<input type="date" class="form-control" approval="" blok="" id="tanggal_tanda_tangan" value="<?=$data->tanggal_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="Mengetahui Jabatan" name="input[jabatan_tanda_tangan]" value="<?=$data->jabatan_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="Nama Pejabat" approval="" blok="" id="nama_tanda_tangan" value="<?=$data->nama_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="NIP Pejabat" approval="" blok="" id="nip_tanda_tangan" value="<?=$data->nip_tanda_tangan;?>">
				</div>
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
<div class="col-sm-2">
	<?=anchor($this->router->class, '<i class="fa fa-check"></i> Selesai', array('class'=>'btn btn-sm btn-primary'));?>
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
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'vii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'viii')
	);?>;
var approved = <?=$approved?'true':'false';?>;
<?php if(!$approved) { ?>
$('#sedang_verifikasi').change(function(){
  var value = $(this).is(':checked');
  $.post('<?=base_url('v_kegiatan/sedang_verifikasi');?>', {id_ms_keg:<?=$data->id_ms_keg;?>, value: $(this).is(':checked')}, function(result){
  },'json');
});
<?php } ?>
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
