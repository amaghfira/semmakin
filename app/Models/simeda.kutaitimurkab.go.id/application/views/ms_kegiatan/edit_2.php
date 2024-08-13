<?php
$blok_i = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'i');
$blok_ii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'ii');
$blok_iii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iii');
?>
<form method="post">
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
	<button class="btn btn-primary btn-sm btn-flat pull-right" name="next" value="next" title="Simpan, lanjut ke halaman berikutnya">Selanjutnya <i class="fa fa-chevron-right"></i></button>
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

</div>
</form>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'i')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'ii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iii')
);?>;
var disabled = <?=($data->sedang_verifikasi || $data->approval_on!='0000-00-00 00:00:00')?'true':'false';?>;
</script>

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

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_approval.css');?>">
<script src="<?=base_url('assets/omae/ms_approval.js');?>"></script>
