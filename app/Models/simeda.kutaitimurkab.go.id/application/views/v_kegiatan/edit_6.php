<?php $approved = $data->approval_on!='0000-00-00 00:00:00'; ?>
<?php
$blok_vi = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'vi');
$blok_vii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'vii');
?>
<form method="post">
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>6.2. Metode Pemeriksaan Kualitas Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" multi-item approval="" blok="vi" id="metode_pemeriksaan_kualitas_pengumpulan_data" value="<?=$blok_vi->metode_pemeriksaan_kualitas_pengumpulan_data;?>">
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Kunjungan kembali (revisit) <span class="pull-right">- 1</span></li>
				<li>Supervisi <span class="pull-right">- 2</span></li>
				<li>Task Force <span class="pull-right">- 4</span></li>
				<li>Lainnya (sebutkan)<span class="pull-right">- 8</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" blok="vi" id="metode_pemeriksaan_kualitas_pengumpulan_data_lainnya" value="<?=$blok_vi->metode_pemeriksaan_kualitas_pengumpulan_data_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>6.3. Apakah Melakukan Penyesuaian Nonrespon?</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" list-item approval="" blok="vi" id="apakah_melakukan_penyesuaian_nonrespon" value="<?=$blok_vi->apakah_melakukan_penyesuaian_nonrespon;?>">
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Ya <span class="pull-right">- 1</span></li>
				<li>Tidak <span class="pull-right">- 2</span></li>
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		<div class="small">Pertanyaan 6.4 – 6.7 ditanyakan jika sarana pengumpulan data adalah PAPI, CAPI, atau CATI (Pilihan R.4.7. kode 1, 2, dan/atau 4 dilingkari)</div>
	</div>

	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>6.4. Petugas Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" list-item approval="" blok="vi" id="petugas_pengumpulan_data" value="<?=$blok_vi->petugas_pengumpulan_data;?>">
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>Staf instansi penyelenggara <span class="pull-right">- 1</span></li>
				<li>Mitra/tenaga kontrak <span class="pull-right">- 2</span></li>
				<li>Staf instansi penyelenggara dan mitra/tenaga kontrak <span class="pull-right">- 3</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>6.5. Persyaratan Pendidikan Terendah Petugas Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" list-item approval="" blok="vi" id="persyaratan_pendidikan_terendah_petugas_pengumpulan_data" value="<?=$blok_vi->persyaratan_pendidikan_terendah_petugas_pengumpulan_data;?>">
			</div>
			<div class="col-sm-6 col-sm-offset-1">
				<li>≤ SMP <span class="pull-right">- 1</span></li>
				<li>SMA/SMK <span class="pull-right">- 2</span></li>
				<li>Diploma I/II/III <span class="pull-right">- 3</span></li>
				<li>Diploma IV/S1/S2/S3 <span class="pull-right">- 4</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>6.6. Jumlah Petugas:</label>
			</div>
			<div class="col-sm-3 col-sm-offset-1">
				<li>Supervisor/penyelia/pengawas</li>
			</div>
			<div class="col-sm-2"> 
				<div class="input-group">
					<input type="text" class="form-control" approval="" blok="vi" id="jumlah_petugas_supervisor" value="<?=$blok_vi->jumlah_petugas_supervisor;?>">
				    <span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>
			</div>

			<div class="col-sm-3 col-sm-offset-1">
				<li>Pengumpul data/enumerator</li>
			</div>
			<div class="col-sm-2"> 
				<div class="input-group">
					<input type="text" class="form-control" approval="" blok="vi" id="jumlah_petugas_enumerator" value="<?=$blok_vi->jumlah_petugas_enumerator;?>">
				    <span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>6.7. Apakah Melakukan Pelatihan Petugas?</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" list-item approval="" blok="vi" id="apakah_melakukan_pelatihan_petugas" value="<?=$blok_vi->apakah_melakukan_pelatihan_petugas;?>">
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Ya <span class="pull-right">- 1</span></li>
				<li>Tidak <span class="pull-right">- 2</span></li>
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		VII. PENGOLAHAN DAN ANALISIS
	</div>

	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>7.1. Tahapan Pengolahan Data:</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">Penyuntingan (Editing)</div>
			<div class="col-sm-2">Ya - 1 <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" blok="vii" id="tahapan_pengolahan_data_editing" value="<?=$blok_vii->tahapan_pengolahan_data_editing;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">Penyandian (Coding)</div>
			<div class="col-sm-2">Ya - 1 <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" blok="vii" id="tahapan_pengolahan_data_coding" value="<?=$blok_vii->tahapan_pengolahan_data_coding;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">Data Entry</div>
			<div class="col-sm-2">Ya - 1 <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" blok="vii" id="tahapan_pengolahan_data_entry" value="<?=$blok_vii->tahapan_pengolahan_data_entry;?>"></div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">Penyahihan (Validasi)</div>
			<div class="col-sm-2">Ya - 1 <span class="pull-right">Tidak - 2</span></div>			
			<div class="col-sm-1"><input class="form-control align-center input-sm" approval="" blok="vii" id="tahapan_pengolahan_data_validasi" value="<?=$blok_vii->tahapan_pengolahan_data_validasi;?>"></div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>7.2. Metode Analisis:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control align-center" list-item approval="" blok="vii" id="metode_analisis" value="<?=$blok_vii->metode_analisis;?>">
			</div>			
			<div class="col-sm-6 col-sm-offset-1">
				<li>Deskriptif <span class="pull-right">- 1</span></li>
				<li>Inferensia <span class="pull-right">- 2</span></li>
				<li>Deskriptif dan Inferensia <span class="pull-right">- 3</span></li>
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
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'vi')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'vii')
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
