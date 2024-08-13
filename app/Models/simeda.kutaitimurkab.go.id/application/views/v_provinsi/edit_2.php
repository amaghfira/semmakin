<?php $approved = $data->approval_on!='0000-00-00 00:00:00'; ?>
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
				<input class="form-control" blok="i" approval="" id="instansi_penyelenggara" value="<?=$blok_i->instansi_penyelenggara;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>1.2. Alamat Lengkap Instansi Penyelenggara</label>
				<textarea class="form-control" blok="i" approval="" id="alamat_lengkap_instansi_penyelenggara"><?=$blok_i->alamat_lengkap_instansi_penyelenggara;?></textarea>
			</div>

			<div class="col-sm-5">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				    <input type="text" class="form-control" placeholder="Telepon" blok="i" approval="" id="telepon" value="<?=$blok_i->telepon;?>">
				</div>
				<div class="input-group">
					<span class="input-group-addon">@</span>
				    <input type="text" class="form-control" placeholder="E-Mail" blok="i" approval="" id="email" value="<?=$blok_i->email;?>">
				</div>
			</div>
			<div class="col-sm-5">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-fax"></i></span>
				    <input type="text" class="form-control" placeholder="Faximile" blok="i" approval="" id="faksimile" value="<?=$blok_i->faksimile;?>">
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
	        	<input class="form-control" blok='ii' approval="" id="unit_penanggung_jawab_eselon1" value="<?=$blok_ii->unit_penanggung_jawab_eselon1;?>">
	      	</div>
	      	<span class="col-sm-2 align-right">Eselon 2</span>
	      	<div class="col-sm-10">
	        	<input class="form-control" blok='ii' approval="" id="unit_penanggung_jawab_eselon2" value="<?=$blok_ii->unit_penanggung_jawab_eselon2;?>">
	      	</div>
		</div>
		<div class="form-group ">
			<div class="col-sm-12">
				<label>2.2. Penanggung Jawab Teknis (setingkat Eselon 3)</label>
			</div>
	      	<span class="col-sm-2 align-right">Jabatan</span>
	       	<div class="col-sm-10">
	        	<input class="form-control" blok='ii' approval="" id="jabatan_penanggung_jawab_teknis" value="<?=$blok_ii->jabatan_penanggung_jawab_teknis;?>">
	      	</div>
	      	<span class="col-sm-2 align-right">Alamat</span>
	      	<div class="col-sm-10">
	        	<input class="form-control" blok='ii' approval="" id="alamat_penanggung_jawab_teknis" value="<?=$blok_ii->alamat_penanggung_jawab_teknis;?>">
	      	</div>

	      	<div class="col-sm-2"></div> 
	      	<div class="col-sm-5">
		      	<div class="input-group">
		      		<span class="input-group-addon"><i class="fa fa-phone"></i></span>
		      	    <input type="text" class="form-control" placeholder="Telepon" blok='ii' approval="" id="telepon_penanggung_jawab_teknis" value="<?=$blok_ii->telepon_penanggung_jawab_teknis;?>">
		      	</div>
		      	<div class="input-group">
		      		<span class="input-group-addon">@</span>
		      	    <input type="text" class="form-control" placeholder="E-Mail" blok='ii' approval="" id="email_penanggung_jawab_teknis" value="<?=$blok_ii->email_penanggung_jawab_teknis;?>">
		      	</div>
	      	</div>
	      	<div class="col-sm-5">
		      	<div class="input-group">
		      		<span class="input-group-addon"><i class="fa fa-fax"></i></span>
		      	    <input type="text" class="form-control" placeholder="Faximile" blok='ii' approval="" id="faksimile_penanggung_jawab_teknis" value="<?=$blok_ii->faksimile_penanggung_jawab_teknis;?>">
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
				<textarea class="form-control" rows="6" blok='iii' approval="" id="latar_belakang_kegiatan"><?=$blok_iii->latar_belakang_kegiatan;?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<label>3.2. Tujuan Kegiatan</label>
				<textarea class="form-control" rows="6" blok='iii' approval="" id="tujuan_kegiatan"><?=$blok_iii->tujuan_kegiatan;?></textarea>
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

</div>
</form>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url($this->router->class);?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'i')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'ii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iii'));?>;
var approved = <?=$approved? 'true' : 'false';?>;
<?php if(!$approved) { ?>
$('#sedang_verifikasi').change(function(){
  var value = $(this).is(':checked');
  $.post('<?=base_url('v_kegiatan/sedang_verifikasi');?>', {id_ms_keg:<?=$data->id_ms_keg;?>, value: $(this).is(':checked')}, function(result){
  },'json');
});
<?php }?>
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
