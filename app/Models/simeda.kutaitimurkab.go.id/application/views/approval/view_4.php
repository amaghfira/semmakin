<?php
$blok_iv = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iv');
?>

<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>4.3. Tipe Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="tipe_pengumpulan_data" name="blok_iv[tipe_pengumpulan_data]" value="<?=$blok_iv->tipe_pengumpulan_data;?>" list-item>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Longitudinal Panel <span class="pull-right">- 1</span></li>
				<li>Longitudinal Cross Sectional <span class="pull-right">- 2</span></li>
				<li>Cross Sectional <span class="pull-right">- 3</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.4. Cakupan Wilayah Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="cakupan_wilayah_pengumpulan_data" name="blok_iv[cakupan_wilayah_pengumpulan_data]" value="<?=$blok_iv->cakupan_wilayah_pengumpulan_data;?>" list-item>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Seluruh Wilayah Indonesia <span class="pull-right">- 1</span></li>
				<li>Sebagian Wilayah Indonesia <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-6">
				<i class="fa fa-long-arrow-right"></i> langsung ke R.4.6</span>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>4.5.	Jika “sebagian wilayah Indonesia” (R.4.4. berkode 2), Wilayah Kegiatan:</label>
				<table id="tabel-wilayah" class="table col-sm-offset-1" style="width:96.67%">
					<thead>
						<tr>
							<th style="width:20px">No</th>
							<th>Provinsi</th>
							<th>Kabupaten/Kota</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($this->mskegiatan_model->get_wilayah($data->id_ms_keg) as $row){
							echo '<tr key="'.$row->id.'">
								<td>'.($no++).'</td>
								<td>'.$row->provinsi.'</td>
								<td>'.$row->kabupaten.'</td>
							</tr>';
						}?>
					</tbody>
				</table>
				
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.6. Metode Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="metode_pengumpulan_data"  name="blok_iv[metode_pengumpulan_data]" value="<?=$blok_iv->metode_pengumpulan_data;?>" multi-item>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Wawancara 
					<span class="pull-right">- 1</span></li>
				<li>Mengisi kuesioner sendiri (swacacah) 
					<span class="pull-right">- 2</span></li>
				<li>Pengamatan (observasi) 
					<span class="pull-right">- 4</span></li>
				<li>Pengumpulan data sekunder 
					<span class="pull-right">- 8</span></li>
				<li>Lainnya (sebutkan) 
					<span class="pull-right">- 16</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" blok="iv" id="metode_pengumpulan_data_lainnya"  name="blok_iv[metode_pengumpulan_data_lainnya]" value="<?=$blok_iv->metode_pengumpulan_data_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.7. Sarana Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="sarana_pengumpulan_data" name="blok_iv[sarana_pengumpulan_data]" value="<?=$blok_iv->sarana_pengumpulan_data;?>" multi-item>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Paper-assisted Personal Interviewing (PAPI) 
					<span class="pull-right">- 1</span></li>
				<li>Computer-assisted Personal Interviewing (CAPI) 
					<span class="pull-right">- 2</span></li>
				<li>Computer-assisted Telephones Interviewing (CATI) 
					<span class="pull-right">- 4</span></li>
				<li>Computer Aided Web Interviewing (CAWI) 
					<span class="pull-right">- 8</span></li>
				<li>Mail 
					<span class="pull-right">- 16</span></li>
				<li>Lainnya (sebutkan) 
					<span class="pull-right">- 32</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" id="sarana_pengumpulan_data_lainnya" name="blok_iv[sarana_pengumpulan_data_lainnya]" value="<?=$blok_iv->sarana_pengumpulan_data_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.8. Unit Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="unit_pengumpulan_data"  name="blok_iv[unit_pengumpulan_data]" value="<?=$blok_iv->unit_pengumpulan_data;?>" multi-item>
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Individu 
					<span class="pull-right">- 1</span></li>
				<li>Rumah tangga 
					<span class="pull-right">- 2</span></li>
				<li>Usaha/perusahaan 
					<span class="pull-right">- 4</span></li>
				<li>Lainnya (sebutkan) 
					<span class="pull-right">- 8</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" blok="iv" id="unit_pengumpulan_data_lainnya"  name="blok_iv[unit_pengumpulan_data_lainnya]" value="<?=$blok_iv->unit_pengumpulan_data_lainnya;?>">
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

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<style>
	div[role=dialog] {font-size:small}
	#myDialog {padding:0 20px}
	#myDialog button {margin-top:10px}
</style>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var url2 = '<?=base_url('approval');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iv')
);?>;
</script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/approval.css');?>">
<script src="<?=base_url('assets/omae/approval.js');?>"></script>
