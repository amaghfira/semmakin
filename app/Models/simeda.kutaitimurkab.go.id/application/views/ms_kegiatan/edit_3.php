<?php
$blok_iii = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iii');
$blok_iv = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iv');
?>
<form method="post" id="form-kegiatan">
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-12">
				<label>3.3.	Rencana Jadwal Kegiatan:</label>
				<table class="table col-sm-offset-1">
					<thead>
						<tr>
							<th></th>
							<th>AWAL</th>
							<th>&nbsp;</th>
							<th>AKHIR</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th align="left" colspan="8">A. Perencanaan</th>
						</tr>
						<tr tanggal>
							<td>1. Perencanaan Kegiatan</td>
							<td><input class="form-control" type="date" name="blok_iii[perencanaan_kegiatan_awal]" value="<?=$blok_iii->perencanaan_kegiatan_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[perencanaan_kegiatan_akhir]" value="<?=$blok_iii->perencanaan_kegiatan_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>2. Desain</td>
							<td><input class="form-control" type="date" name="blok_iii[desain_awal]" value="<?=$blok_iii->desain_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[desain_akhir]" value="<?=$blok_iii->desain_akhir;?>"></td>
						</tr>	

						<tr>
							<th align="left" colspan="8">B. Pengumpulan</th>
						</tr>
						<tr tanggal>
							<td>3. Pengumpulan Data</td>
							<td><input class="form-control" type="date" name="blok_iii[pengumpulan_data_awal]" value="<?=$blok_iii->pengumpulan_data_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[pengumpulan_data_akhir]" value="<?=$blok_iii->pengumpulan_data_akhir;?>"></td>
						</tr>	

						<tr>
							<th align="left" colspan="8">C. Pemeriksaan</th>
						</tr>
						<tr tanggal>
							<td>4. Pengolahan Data</td>
							<td><input class="form-control" type="date" name="blok_iii[pengolahan_data_awal]" value="<?=$blok_iii->pengolahan_data_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[pengolahan_data_akhir]" value="<?=$blok_iii->pengolahan_data_akhir;?>"></td>
						</tr>							

						<tr>
							<th align="left" colspan="8">D. Penyebarluasan</th>
						</tr>
						<tr tanggal>
							<td>5. Analisis</td>
							<td><input class="form-control" type="date" name="blok_iii[analisis_awal]" value="<?=$blok_iii->analisis_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[analisis_akhir]" value="<?=$blok_iii->analisis_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>6. Diseminasi Hasil</td>
							<td><input class="form-control" type="date" name="blok_iii[diseminasi_hasil_awal]" value="<?=$blok_iii->diseminasi_hasil_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[diseminasi_hasil_akhir]" value="<?=$blok_iii->diseminasi_hasil_akhir;?>"></td>
						</tr>							
						<tr tanggal>
							<td>7. Evaluasi</td>
							<td><input class="form-control" type="date" name="blok_iii[evaluasi_awal]" value="<?=$blok_iii->evaluasi_awal;?>"></td>
							<td>s.d</td>
							<td><input class="form-control" type="date" name="blok_iii[evaluasi_akhir]" value="<?=$blok_iii->evaluasi_akhir;?>"></td>
						</tr>
					</tbody>							
				</table>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>3.4.	Variabel (Karakteristik) yang Dikumpulkan:</label>
				<table id="tabel-variabel" class="table col-sm-offset-1" style="width: 96.67%">
					<thead>
						<tr>
							<th style="width:20px">No</th>
							<th>Nama Variabel (karakteristik)</th>
							<th>Konsep</th>
							<th>Definisi</th>
							<th>Referensi Waktu (Periode Enumerasi)</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($this->mskegiatan_model->get_variabel($data->id_ms_keg) as $row){
							echo '<tr key="'.$row->id.'" checklist="<?=$row->checklist;?>">
								<td>'.($no++).'</td>
								<td>'.$row->nama_variabel.'</td>
								<td>'.$row->konsep.'</td>
								<td>'.$row->definisi.'</td>
								<td>'.$row->referensi_waktu.'</td>							
							</tr>';
						}?>
					</tbody>
<?php if(!$data->sedang_verifikasi && $data->approval_on=='0000-00-00 00:00:00') { ?>
					<tfoot>
						<tr>
							<th></th>
							<th><input class="form-control input-sm" id="v_nama"></th>							
							<th><input class="form-control input-sm" id="v_konsep"></th>							
							<th><input class="form-control input-sm" id="v_definisi"></th>							
							<th><input class="form-control input-sm" id="v_referensi"></th>							
							<th><span id="insert" class="btn btn-default btn-flat btn-sm" title="Tambahkan dan Simpan"><i class="fa fa-save"></i></span></th>
						</tr>
					</tfoot>
<?php } ?>
				</table>
				
			</div>
		</div>
	</div>

	<div class="box-header with-border">
		IV. DESAIN KEGIATAN
	</div>
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>4.1. Kegiatan Ini Dilakukan</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="kegiatan_ini_dilakukan" name="blok_iv[kegiatan_ini_dilakukan]" value="<?=$blok_iv->kegiatan_ini_dilakukan;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Hanya Sekali  <span class="pull-right">- 1</span></li>
			</div>
			<div class="col-sm-2">
				<i class="fa fa-long-arrow-right"></i> langsung ke R.4.3</span>
			</div>
			<div class="col-sm-4">
				<li>Berulang <span class="pull-right">- 2</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.2. Jika “berulang” (R.4.1. berkode 2), Frekuensi Penyelenggaraan:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="frekuensi_penyelenggaraan" name="blok_iv[frekuensi_penyelenggaraan]" value="<?=$blok_iv->frekuensi_penyelenggaraan;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Harian <span class="pull-right">- 1</span></li>
				<li>Mingguan <span class="pull-right">- 2</span></li>
				<li>Bulanan <span class="pull-right">- 3</span></li>
				<li>Triwulanan <span class="pull-right">- 4</span></li>
			</div>
			<div class="col-sm-2">
				
			</div>
			<div class="col-sm-4">
				<li>Empat Bulanan <span class="pull-right">- 5</span></li>
				<li>Semesteran <span class="pull-right">- 6</span></li>
				<li>Tahunan <span class="pull-right">- 7</span></li>
				<li>> Dua Tahunan <span class="pull-right">- 8</span></li>
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

</form>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/omae/ms_kegiatan.css');?>">
<script src="<?=base_url('assets/omae/ms_kegiatan.js');?>"></script>

<div id="myVar" style="display: none">
	<form method="post" action="<?=base_url('ms_kegiatan/save_variabel/'.$data->id_ms_keg);?>">
	<input type="hidden" id="id_variabel" name="id_variabel" value="">
	<div class="row">
		<label>Nama Variabel</label>
		<input id="nama_variabel" name="nama_variabel" class="form-control" required>
	</div>
	<div class="row">
		<label>Konsep</label>
		<textarea id="konsep" name="konsep" class="form-control" rows="6" required></textarea>
	</div>
	<div class="row">
		<label>Definisi</label>
		<textarea id="definisi" name="definisi" class="form-control" rows="6" required></textarea>
	</div>
	<div class="row">
		<label>Periode Enumerasi</label>
		<input id="referensi_waktu" name="referensi_waktu" class="form-control" required>
	</div>
	<div class="row">
		<button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
		<a id="hapus" href="#" class="btn btn-flat btn-sm pull-right"><i class="fa fa-trash"></i></a>
	</div>
	</form>
</div>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<style>
	div[role=dialog] {font-size:small}
	#myVar {padding:0 20px 10px}
	#myVar button {margin-top:10px}

	.bulat {
		font-size: smaller;
		width: 19px;
		height: 19px;
		margin: 2px -10px 2px 5px;
		padding-top: 3px;
		border: 1px solid #ccc;
		border-radius: 50%;
		text-align: center;
		color: #ccc;
	}
	.bulat.fa-check { background-color: green;}
	.bulat.fa-info { background-color: orange;}
	.bulat.fa-exclamation { background-color: red;}
</style>
<script>
$('#tabel-variabel tbody tr').each(function(){
	var checklist = $(this).attr('checklist');
	var title = checklist=='1'?'Terisi, sesuai' : checklist=='2'?'Terisi, tidak sesuai' : checklist=='3'? 'Tidak terisi' : 'Menunggu approval';
	if(checklist=='1')
		$(this).append('<td><i class="bulat fa fa-check" title="'+title+'"></i></td>');
	else{
		var ikon = checklist=='3'? 'exclamation' : checklist=='2'? 'info' : 'question';
		$(this).append('<td><a href="#"><i class="fa fa-edit"></i></a> <i class="bulat fa fa-'+ikon+'" title="'+title+'"></i></td>');
	}
});

<?php if(!$data->sedang_verifikasi && $data->approval_on=='0000-00-00 00:00:00') { ?>
$('#tabel-variabel a').click(function(e){
	var form = $('#form-kegiatan');
	$.post(location.href, form.serialize());

	e.preventDefault();
	var tr = $(this).closest('tr'); 
	var checklist = tr.attr('checklist'); 

	if(checklist != '1'){
		$('#id_variabel').val(tr.attr('key'));
		$('#nama_variabel').val(tr.find('td:nth-child(2)').text());
		$('#konsep').val(tr.find('td:nth-child(3)').text());
		$('#definisi').val(tr.find('td:nth-child(4)').text());
		$('#referensi_waktu').val(tr.find('td:nth-child(5)').text());

		$('#myVar').dialog({
			title:'Edit Karakterisik',
		});

		$('#myVar #hapus').show()
			.click(function(e){
				e.preventDefault();
				if(confirm('Hapus rincian ini?')){
					location.href = '<?=base_url('ms_kegiatan/del_variabel/'.$data->id_ms_keg.'/');?>'+tr.attr('key');
				}
			});
	}
});

$('#tambah').click(function(){
	var form = $('#form-kegiatan');
	$.post(location.href, form.serialize());

	$('#myVar').dialog({
		title:'Tambah Karakterisik',
	});
	$('#myVar #hapus').hide();
});

$('#v_referensi').keydown(function(e){
	if(e.keyCode==13) $('#insert').focus().click();
});

$('#insert').click(function(){
	var data = {};
	data.id_variabel = '';
	data.nama_variabel = $('#v_nama').val();
	data.konsep = $('#v_konsep').val();
	data.definisi = $('#v_definisi').val();
	data.referensi_waktu = $('#v_referensi').val();
	//console.log(data);
	if(data.nama_variabel && data.konsep && data.definisi && data.referensi_waktu){
		$.post('<?=base_url($this->router->class.'/save_variabel/'.$data->id_ms_keg);?>', data, function(result){
			//console.log(result);
			if(result.id){
				$('#tabel-variabel tbody').append('<tr key="'+result.id+'"><td></td><td>'+data.nama_variabel+'</td><td>'+data.konsep+'</td><td>'+data.definisi+'</td><td>'+data.referensi_waktu+'</td><td></td></tr>');
				$('#v_nama').val('');
				$('#v_konsep').val('');
				$('#v_definisi').val('');
				$('#v_referensi').val('');
			} else
				alert('Gagal menyisipkan variabel baru');
		},'json');

	} else {
		alert('Isian tidak lengkap');
		$('#v_nama').focus();
	}
});
<?php } ?>
</script>

<div id="myDialog" style="display: none"></div>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iii')+
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iv')
);?>;

var disabled = <?=($data->sedang_verifikasi || $data->approval_on!='0000-00-00 00:00:00')?'true':'false';?>;
if(disabled) {
  $('input').attr('disabled',true);
  $('i.fa-edit').hide();
}
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
