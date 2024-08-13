<?php
$blok_vii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'vii');
$blok_viii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'viii');
?>
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>7.3. Unit Analisis:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" multi-item name="blok_vii[unit_analisis]" value="<?=$blok_vii->unit_analisis;?>" autofocus>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Individu <span class="pull-right">- 1</span></li>
				<li>Rumahtangga <span class="pull-right">- 2</span></li>
				<li>Usaha/perusahaan <span class="pull-right">- 4</span></li>
				<li>Lainnya, sebutkan<span class="pull-right">- 8</span></li>
				<input class="form-control" placeholder="Lainnya..." approval="" name="blok_vii[unit_analisis_lainnya]" value="<?=$blok_vii->unit_analisis_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>7.4. Tingkat Penyajian Hasil Analisis:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" multi-item name="blok_vii[tingkat_penyajian_hasil_analisis]" value="<?=$blok_vii->tingkat_penyajian_hasil_analisis;?>">
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Nasional <span class="pull-right">- 1</span></li>
				<li>Provinsi <span class="pull-right">- 2</span></li>
				<li>Kabupaten/Kota <span class="pull-right">- 4</span></li>
				<li>Kecamatan<span class="pull-right">- 8</span></li>
				<li>Lainnya, sebutkan<span class="pull-right">- 16</span></li>
				<input class="form-control" placeholder="Lainnya..." approval="" name="blok_vii[tingkat_penyajian_hasil_analisis_lainnya]" value="<?=$blok_vii->tingkat_penyajian_hasil_analisis_lainnya;?>">
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
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" ya-tidak name="blok_viii[ketersediaan_produk_tercetak]" value="<?=$blok_viii->ketersediaan_produk_tercetak;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Digital (softcopy)</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" ya-tidak name="blok_viii[ketersediaan_produk_digital]" value="<?=$blok_viii->ketersediaan_produk_digital;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">Data Mikro</div>
			<div class="col-sm-2"><span>Ya - 1</span> <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" ya-tidak name="blok_viii[ketersediaan_produk_mikrodata]" value="<?=$blok_viii->ketersediaan_produk_mikrodata;?>"></div>
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
							<td><input class="form-control" type="date" approval="" name="blok_viii[rencana_jadwal_rilis_produk_tercetak]" value="<?=$blok_viii->rencana_jadwal_rilis_produk_tercetak;?>"></td>
						</tr>
						<tr tanggal>
							<td>Digital</td>
							<td><input class="form-control" type="date" approval="" name="blok_viii[rencana_jadwal_rilis_produk_digital]" value="<?=$blok_viii->rencana_jadwal_rilis_produk_digital;?>"></td>
						</tr>
						<tr tanggal>
							<td>Data Mikro</td>
							<td><input class="form-control" type="date" approval="" name="blok_viii[rencana_jadwal_rilis_produk_mikrodata]" value="<?=$blok_viii->rencana_jadwal_rilis_produk_mikrodata;?>"></td>
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
					<input class="form-control" placeholder="Nama Kota" approval="" name="input[kota_tanda_tangan]" value="<?=$data->kota_tanda_tangan;?>">
				</div>
				<div class="col-sm-5">
					<input type="date" class="form-control" approval="" name="input[tanggal_tanda_tangan]" value="<?=$data->tanggal_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="Nama Pejabat" approval="" name="input[nama_tanda_tangan]" value="<?=$data->nama_tanda_tangan;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<input class="form-control" placeholder="NIP Pejabat" approval="" name="input[nip_tanda_tangan]" value="<?=$data->nip_tanda_tangan;?>">
				</div>
			</div>
		</div>
	</div>

</div>

<form method="post" action="<?=base_url('approval/submit');?>">
<input type="hidden" name="id_ms_keg" value="<?=$data->id_ms_keg;?>">
<input type="hidden" name="approval" id="approval" value="<?=$data->approval_on?'1':'2';?>">
<blockquote class="box box-success">
    <div class="box-body" style="font-style: italic;">
        " Metadata Kegiatan, Metadata Variabel, dan Metadata Indikator dalam kuesioner ini telah melalui proses pemeriksaan oleh verifikator (BPS dan Walidata), pengecekan validasi dan konsistensi, serta monitoring kualitas di Instansi/OPD, dan telah mendapat persetujuan dari Walidata untuk dilanjutkan ke proses berikutnya. "
    </div>
    <div class="box-footer">
        <div class="checkbox pull-left" style="margin-top:0; margin-bottom:0">
          <label>
            <input type="checkbox" id="checkbox" <?php if(substr($data->approval_on,0,4)!='0000') echo 'checked';?>> Approval
          </label>
        <?php if(substr($data->approval_on,0,4)!='0000') echo '<div class="small">Approved on : '.$data->approval_on.'</div>';?>
        </div>
        <button type="submit" class="btn btn-default pull-right"><i class="fa fa-check"></i> Submit</button>
      </div>
</blockquote>
</form>

<!-- Pagination -->
<div class="col-sm-3 pull-right">
	<?php if($this->session->userdata('role')=='9') echo anchor($this->router->class.'/delete_kegiatan/'.$data->id_ms_keg, '<i class="fa fa-trash"></i>',array('confirm'=>"Anda akan menghapus MS-Kegiatan ini beserta MS-Variabel dan MS-Indikator:\n\n".$data->judul_kegiatan."\n\nAre you sure?",'class'=>'pull-right'));?>
</div>
<div class="col-sm-3">
</div>
<div class="col-sm-6" style="text-align: center">
	<?php for($i=1; $i<=7; $i++) echo anchor($this->router->class.'/view/'.$data->id_ms_keg.'/'.$i,$i, array('class'=>'btn btn-sm btn-'.($i==$page?'primary':'default')));?>
</div>
<!-- Pagination -->

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var url2 = '<?=base_url('approval');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'vii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'viii')
);?>;
$('#checkbox').change(function(){
  $('#approval').val($(this).is(':checked')?'1':'2');
});

$('a[confirm]').click(function(e){
	e.preventDefault();
	if(confirm($(this).attr('confirm')))
		location.href=$(this).attr('href');
})
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/approval.css');?>">
<script src="<?=base_url('assets/omae/approval.js');?>"></script>

