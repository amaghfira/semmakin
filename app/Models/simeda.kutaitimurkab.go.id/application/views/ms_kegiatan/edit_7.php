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
				<input class="form-control align-center" multi-item approval="" blok="vii" id="unit_analisis" name="blok_vii[unit_analisis]" value="<?=$blok_vii->unit_analisis;?>" autofocus>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Individu <span class="pull-right">- 1</span></li>
				<li>Rumahtangga <span class="pull-right">- 2</span></li>
				<li>Usaha/perusahaan <span class="pull-right">- 4</span></li>
				<li>Lainnya, sebutkan<span class="pull-right">- 8</span></li>
				<input class="form-control" placeholder="Lainnya..." approval="" blok="vii" id="unit_analisis_lainnya" name="blok_vii[unit_analisis_lainnya]" value="<?=$blok_vii->unit_analisis_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>7.4. Tingkat Penyajian Hasil Analisis:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" multi-item approval="" blok="vii" id="tingkat_penyajian_hasil_analisis" name="blok_vii[tingkat_penyajian_hasil_analisis]" value="<?=$blok_vii->tingkat_penyajian_hasil_analisis;?>">
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Nasional <span class="pull-right">- 1</span></li>
				<li>Provinsi <span class="pull-right">- 2</span></li>
				<li>Kabupaten/Kota <span class="pull-right">- 4</span></li>
				<li>Kecamatan<span class="pull-right">- 8</span></li>
				<li>Lainnya, sebutkan<span class="pull-right">- 16</span></li>
				<input class="form-control" placeholder="Lainnya..." approval="" blok="vii" id="tingkat_penyajian_hasil_analisis_lainnya" name="blok_vii[tingkat_penyajian_hasil_analisis_lainnya]" value="<?=$blok_vii->tingkat_penyajian_hasil_analisis_lainnya;?>">
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
			<div class="col-sm-1"><input class="form-control align-center input-sm" ya-tidak approval="" blok="viii" id="ketersediaan_produk_tercetak" name="blok_viii[ketersediaan_produk_tercetak]" value="<?=$blok_viii->ketersediaan_produk_tercetak;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Digital (softcopy)</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" ya-tidak approval="" blok="viii" id="ketersediaan_produk_digital" name="blok_viii[ketersediaan_produk_digital]" value="<?=$blok_viii->ketersediaan_produk_digital;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Data Mikro</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" ya-tidak approval="" blok="viii" id="ketersediaan_produk_mikrodata" name="blok_viii[ketersediaan_produk_mikrodata]" value="<?=$blok_viii->ketersediaan_produk_mikrodata;?>"></div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>8.2. Jika pilihan R.8.1. kode 1, Rencana Rilis Produk Kegiatan:</label>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
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
							<td><input class="form-control" type="date" blok="viii" id="rencana_jadwal_rilis_produk_tercetak" approval="" name="blok_viii[rencana_jadwal_rilis_produk_tercetak]" value="<?=$blok_viii->rencana_jadwal_rilis_produk_tercetak;?>"></td>
						</tr>
						<tr tanggal>
							<td>Digital</td>
							<td><input class="form-control" type="date" blok="viii" id="rencana_jadwal_rilis_produk_digital" approval="" name="blok_viii[rencana_jadwal_rilis_produk_digital]" value="<?=$blok_viii->rencana_jadwal_rilis_produk_digital;?>"></td>
						</tr>
						<tr tanggal>
							<td>Data Mikro</td>
							<td><input class="form-control" type="date" blok="viii" id="rencana_jadwal_rilis_produk_mikrodata" approval="" name="blok_viii[rencana_jadwal_rilis_produk_mikrodata]" value="<?=$blok_viii->rencana_jadwal_rilis_produk_mikrodata;?>"></td>
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
					<input class="form-control" placeholder="Nama Kota" name="input[kota_tanda_tangan]" value="<?=$data->kota_tanda_tangan;?>">
				</div>
				<div class="col-sm-5">
					<input type="date" class="form-control" name="input[tanggal_tanda_tangan]" value="<?=$data->tanggal_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="Jabatan" name="input[jabatan_tanda_tangan]" value="<?=$data->jabatan_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="Nama Pejabat" name="input[nama_tanda_tangan]" value="<?=$data->nama_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="NIP Pejabat" name="input[nip_tanda_tangan]" value="<?=$data->nip_tanda_tangan;?>">
				</div>
			</div>
		</div>
	</div>

</div>

<!-- Pagination -->
<div class="col-sm-3 pull-right">
	<button class="btn btn-primary btn-sm btn-flat pull-right" name="selesai" value="selesai"><i class="fa fa-check"></i> Selesai </button>
<?php if(!$data->sedang_verifikasi && $data->approval_on=='0000-00-00 00:00:00') { ?>
	<button class="btn btn-default btn-sm btn-flat pull-right" title="Simpan, tetap di halaman ini"><i class="fa fa-save"></i></button>
<?php } ?>
</div>
<div class="col-sm-3">
	<button class="btn btn-default btn-sm btn-flat" name="prev" value="prev"><i class="fa fa-chevron-left"></i> Sebelumnya </button>
</div>
<div class="col-sm-6" style="text-align: center">
	<?php for($i=1; $i<=7; $i++) echo $i==$page? '<span class="btn btn-sm btn-primary">'.$i.'</span>' : anchor($this->router->class.'/edit/'.$data->id_ms_keg.'/'.$i,$i, array('class'=>'btn btn-sm btn-default'));?>
</div>
<!-- Pagination -->

</form>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'') + 
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'vii') + 
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'viii')
);?>;
var disabled = <?=($data->sedang_verifikasi || $data->approval_on!='0000-00-00 00:00:00')?'true':'false';?>;
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_approval.css');?>">
<script src="<?=base_url('assets/omae/ms_approval.js');?>"></script>

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
		console.log(result);
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
