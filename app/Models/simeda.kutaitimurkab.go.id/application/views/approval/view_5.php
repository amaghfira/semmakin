<?php
$blok_v = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'v');
$blok_vi = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'vi');
?>
<div class="box box-info">
	<div class="box-header with-border">
		V. DESAIN SAMPEL
		<div class="small">Diisi jika cara pengumpulan data adalah survei sebagian</div>
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>5.1. Jenis Rancangan Sampel:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" name="blok_v[jenis_rancangan_sampel]" value="<?=$blok_v->jenis_rancangan_sampel;?>" list-item autofocus>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Single Stage/Phase <span class="pull-right">- 1</span></li>
				<li>Multi Stage/Phase <span class="pull-right">- 2</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>5.2. Metode Pemilihan Sampel Tahap Terakhir:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" name="blok_v[metode_pemilihan_sampel_tahap_terakhir]" value="<?=$blok_v->metode_pemilihan_sampel_tahap_terakhir;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Sampel Probabilitas <span class="pull-right">- 1</span></li>
				<li>Sampel Nonprobabilitas <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-4">
				<i class="fa fa-long-arrow-right"></i> ke R.5.3.a<br>
				<i class="fa fa-long-arrow-right"></i> ke R.5.3.b<br>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>5.3. Jika “sampel probabilitas” (R.5.2. berkode 1), Metode yang Digunakan:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" name="blok_v[metode_yang_digunakan]" value="<?=$blok_v->metode_yang_digunakan;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Simple Random Sampling <span class="pull-right">- 1</span></li>
				<li>Systematic Random Sampling <span class="pull-right">- 2</span></li>
				<li>Stratified Random Sampling <span class="pull-right">- 3</span></li>
				<li>Cluster Sampling <span class="pull-right">- 4</span></li>
				<li>Multi Stage Sampling <span class="pull-right">- 5</span></li>
			</div>
			<div class="col-sm-4">
				<i class="fa fa-long-arrow-right"></i> kode 1-5 ke R.5.4<br>
			</div>

			<div class="col-sm-11 col-sm-offset-1">
				<label>Jika “sampel nonprobabilitas” (R.5.2. berkode 2), Metode yang Digunakan:</label>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Quota Sampling <span class="pull-right">- 6</span></li>
				<li>Accidental Sampling <span class="pull-right">- 7</span></li>
				<li>Purposive Sampling <span class="pull-right">- 8</span></li>
				<li>Snowball Sampling <span class="pull-right">- 9</span></li>
				<li>Saturation Sampling <span class="pull-right">- 10</span></li>
			</div>
			<div class="col-sm-4">
				<i class="fa fa-long-arrow-right"></i> kode 6-10 ke R.5.7<br>
			</div>

		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>5.4. Kerangka Sampel Tahap Terakhir:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" name="blok_v[kerangka_sampel_tahap_terakhir]" value="<?=$blok_v->kerangka_sampel_tahap_terakhir;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>List Frame <span class="pull-right">- 1</span></li>
				<li>Area Frame <span class="pull-right">- 2</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>5.5. Fraksi Sampel Keseluruhan:</label>
				<input class="form-control col-sm-offset-1" approval="" name="blok_v[fraksi_sampel_keseluruhan]" value="<?=$blok_v->fraksi_sampel_keseluruhan;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>5.6.	Nilai Perkiraan Sampling Error Variabel Utama:</label>
				<input class="form-control col-sm-offset-1" approval="" name="blok_v[nilai_perkiraan_sampling_error_variabel_utama]" value="<?=$blok_v->nilai_perkiraan_sampling_error_variabel_utama;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>5.7.	Unit Sampel:</label>
				<input class="form-control col-sm-offset-1" approval="" name="blok_v[unit_sampel]" value="<?=$blok_v->unit_sampel;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>5.8.	Unit Observasi:</label>
				<input class="form-control col-sm-offset-1" approval="" name="blok_v[unit_observasi]" value="<?=$blok_v->unit_observasi;?>">
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		VI. PENGUMPULAN DATA
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>6.1. Apakah Melakukan Uji Coba (Pilot Survey)?</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" approval="" name="blok_vi[apakah_melakukan_uji_coba]" value="<?=$blok_vi->apakah_melakukan_uji_coba;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Ya <span class="pull-right">- 1</span></li>
				<li>Tidak <span class="pull-right">- 2</span></li>
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

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'v') +
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'vi')
);?>;
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_approval.css');?>">
<script src="<?=base_url('assets/omae/ms_approval.js');?>"></script>
