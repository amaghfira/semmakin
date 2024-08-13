<?php $approved = $data->approval_on!='0000-00-00 00:00:00'; ?>
<form method="post">
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-10">
				<label>Judul Kegiatan</label>
				<input class="form-control" blok="" id="judul_kegiatan" value="<?=$data->judul_kegiatan;?>" readonly approval="">
			</div>
			<div class="col-sm-2">
				<label>Tahun</label>
				<input class="form-control" blok="" id="tahun" value="<?=$data->tahun;?>" readonly approval="">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>Kode Kegiatan (diisi oleh petugas)</label>
				<input class="form-control" blok="" readonly value="<?=$data->id_wilayah.$data->id_ms_keg;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>Cara Pengumpulan Data</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" blok="" id="cara_pengumpulan_data" value="<?=$data->cara_pengumpulan_data;?>" list-item readonly approval="">
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Pencacahan Lengkap <span class="pull-right">- 1</span></li>
				<li>Survei <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-5">
				<li>Kompilasi Produk Administrasi <span class="pull-right">- 3</span></li>
				<li>Cara Lain Sesuai Perkembangan TI <span class="pull-right">- 4</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>Sektor Kegiatan</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" blok="" id="sektor_kegiatan" value="<?=$data->sektor_kegiatan;?>" list-item readonly  approval="" >
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Pertanian dan Perikanan<span class="pull-right">- 1</span></li>
				<li>Demografi dan Kependudukan<span class="pull-right">- 2</span></li>
				<li>Pembangunan<span class="pull-right">- 3</span></li>
				<li>Proyeksi Ekonomi<span class="pull-right">- 4</span></li>
				<li>Pendidikan dan Pelatihan<span class="pull-right">- 5</span></li>
				<li>Lingkungan<span class="pull-right">- 6</span></li>
				<li>Keuangan<span class="pull-right">- 7</span></li>
				<li>Globalisasi<span class="pull-right">- 8</span></li>
				<li>Kesehatan<span class="pull-right">- 9</span></li>
				<li>Industri dan Jasa<span class="pull-right">- 10</span></li>
				<li>Teknologi Informasi dan Komunikasi<span class="pull-right">- 11</span></li>
			</div>
			<div class="col-sm-5">
				<li>Perdagangan Internasional dan Neraca Perdagangan<span class="pull-right">- 12</span></li>
				<li>Ketenagakerjaan<span class="pull-right">- 13</span></li>
				<li>Neraca Nasional<span class="pull-right">- 14</span></li>
				<li>Indikator Ekonomi Bulanan<span class="pull-right">- 15</span></li>
				<li>Produktivitas<span class="pull-right">- 16</span></li>
				<li>Harga dan Paritas Daya Beli<span class="pull-right">- 17</span></li>
				<li>Sektor Publik, Perpajakan, dan Regulasi Pasar<span class="pull-right">- 18</span></li>
				<li>Perwilayahan dan Perkotaan<span class="pull-right">- 19</span></li>
				<li>Ilmu Pengetahuan dan Hak Paten<span class="pull-right">- 20</span></li>
				<li>Perlindungan Sosial dan Kesejahteraan<span class="pull-right">- 21</span></li>
				<li>Transportasi<span class="pull-right">- 22</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>Jika survei statistik sektoral, apakah mendapatkan rekomendasi kegiatan statistik dari BPS?</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control approval" blok="" id="apakah_mendapat_rekomendasi" value="<?=$data->apakah_mendapat_rekomendasi;?>" list-item readonly approval="">
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Ya <span class="pull-right">- 1</span></li>
				<li>Tidak <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-12">
				Jika Ya, Identitas Rekomendasi
				<input class="form-control" id="identitas_rekomendasi" value="<?=$data->identitas_rekomendasi;?>" readonly approval="">
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
<?=anchor('v_kegiatan','&laquo; Kembali');?>
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

<link rel="stylesheet" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url($this->router->class);?>';
var checklist = <?=json_encode($this->mskegiatan_model->get_checklist($data->id_ms_keg,''));?>;
var approved = <?=$approved?'true':'false';?>;

<?php if(!$approved) { ?>
$('#sedang_verifikasi').change(function(){
  var value = $(this).is(':checked');
  $.post('<?=base_url('v_kegiatan/sedang_verifikasi');?>', {id_ms_keg:<?=$data->id_ms_keg;?>, value:$(this).is(':checked')}, function(result){
  },'json');
});
<?php } ?>
</script>

<script src="<?=base_url('assets/omae/'.$this->router->class.'.js');?>"></script>
<link rel="stylesheet" href="<?=base_url('assets/omae/'.$this->router->class.'.css');?>">

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

<?php if($viewonly) { ?>
<style>
	#myDialog #submit {display: none;}
</style>	
<?php } ?>
