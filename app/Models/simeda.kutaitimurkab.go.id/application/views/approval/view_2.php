<?php
$blok_i = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'i');
$blok_ii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'ii');
$blok_iii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iii');
?>
<div class="box box-info">
	<div class="box-header with-border">
		I. PENYELENGGARA
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>1.1. Instansi Penyelenggara</label>
				<input class="form-control" approval="" blok="i" id="instansi_penyelenggara" name="blok_i[instansi_penyelenggara]" value="<?=$blok_i->instansi_penyelenggara;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>1.2. Alamat Lengkap Instansi Penyelenggara</label>
				<textarea class="form-control" approval="" blok="i" id="alamat_lengkap_instansi_penyelenggara" name="blok_i[alamat_lengkap_instansi_penyelenggara]"><?=$blok_i->alamat_lengkap_instansi_penyelenggara;?></textarea>
			</div>

			<div class="col-sm-5">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				    <input type="text" class="form-control" placeholder="Telepon" approval="" blok="i" id="telepon" name="blok_i[telepon]" value="<?=$blok_i->telepon;?>">
				</div>
				<div class="input-group">
					<span class="input-group-addon">@</span>
				    <input type="text" class="form-control" placeholder="E-Mail" approval="" blok="i" id="email" name="blok_i[email]" value="<?=$blok_i->email;?>">
				</div>
			</div>
			<div class="col-sm-5">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-fax"></i></span>
				    <input type="text" class="form-control" placeholder="Faximile" approval="" blok="i" id="faksimile" name="blok_i[faksimile]" value="<?=$blok_i->faksimile;?>">
				</div>
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		II. PENANGGUNG JAWAB
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>2.1. Unit Eselon Penanggung Jawab</label>
			</div>
	      	<span class="col-sm-2 align-right">Eselon 1</span>
	       	<div class="col-sm-10">
	        	<input class="form-control" approval="" blok="ii" id="unit_penanggung_jawab_eselon1" name="blok_ii[unit_penanggung_jawab_eselon1]" value="<?=$blok_ii->unit_penanggung_jawab_eselon1;?>">
	      	</div>
	      	<span class="col-sm-2 align-right">Eselon 2</span>
	      	<div class="col-sm-10">
	        	<input class="form-control" approval="" blok="ii" id="unit_penanggung_jawab_eselon2" name="blok_ii[unit_penanggung_jawab_eselon2]" value="<?=$blok_ii->unit_penanggung_jawab_eselon2;?>">
	      	</div>
		</div>
		<div class="form-group ">
			<div class="col-sm-12">
				<label>2.2. Penanggung Jawab Teknis (setingkat Eselon 3)</label>
			</div>
	      	<span class="col-sm-2 align-right">Jabatan</span>
	       	<div class="col-sm-10">
	        	<input class="form-control" approval="" blok="ii" id="jabatan_penanggung_jawab_teknis" name="blok_ii[jabatan_penanggung_jawab_teknis]" value="<?=$blok_ii->jabatan_penanggung_jawab_teknis;?>">
	      	</div>
	      	<span class="col-sm-2 align-right">Alamat</span>
	      	<div class="col-sm-10">
	        	<input class="form-control" approval="" blok="ii" id="alamat_penanggung_jawab_teknis" name="blok_ii[alamat_penanggung_jawab_teknis]" value="<?=$blok_ii->alamat_penanggung_jawab_teknis;?>">
	      	</div>

	      	<div class="col-sm-2"></div> 
	      	<div class="col-sm-5">
		      	<div class="input-group">
		      		<span class="input-group-addon"><i class="fa fa-phone"></i></span>
		      	    <input type="text" class="form-control" placeholder="Telepon" approval="" blok="ii" id="telepon_penanggung_jawab_teknis" name="blok_ii[telepon_penanggung_jawab_teknis]" value="<?=$blok_ii->telepon_penanggung_jawab_teknis;?>">
		      	</div>
		      	<div class="input-group">
		      		<span class="input-group-addon">@</span>
		      	    <input type="text" class="form-control" placeholder="E-Mail" approval="" blok="ii" id="email_penanggung_jawab_teknis" name="blok_ii[email_penanggung_jawab_teknis]" value="<?=$blok_ii->email_penanggung_jawab_teknis;?>">
		      	</div>
	      	</div>
	      	<div class="col-sm-5">
		      	<div class="input-group">
		      		<span class="input-group-addon"><i class="fa fa-fax"></i></span>
		      	    <input type="text" class="form-control" placeholder="Faximile" approval="" blok="ii" id="faksimile_penanggung_jawab_teknis" name="blok_ii[faksimile_penanggung_jawab_teknis]" value="<?=$blok_ii->faksimile_penanggung_jawab_teknis;?>">
		      	</div>
		    </div>
		</div>
	</div>

	<div class="box-header with-border">
		III. PERENCANAAN DAN PERSIAPAN
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>3.1. Latar Belakang Kegiatan</label>
				<textarea class="form-control" rows="6" approval="" blok="iii" id="latar_belakang_kegiatan" name="blok_iii[latar_belakang_kegiatan]"><?=$blok_iii->latar_belakang_kegiatan;?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<label>3.2. Tujuan Kegiatan</label>
				<textarea class="form-control" rows="6" approval="" blok="iii" id="tujuan_kegiatan" name="blok_iii[tujuan_kegiatan]"><?=$blok_iii->tujuan_kegiatan;?></textarea>
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

</div>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var url2 = '<?=base_url('approval');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'i')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'ii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iii')
);?>;

</script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/approval.css');?>">
<script src="<?=base_url('assets/omae/approval.js');?>"></script>
