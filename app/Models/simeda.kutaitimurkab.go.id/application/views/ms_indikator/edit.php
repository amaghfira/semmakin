<?php
$lock = $row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00';
?>
<div class="box box-info" style="width:100%; overflow-x:scroll">
	<table class="table" key="<?=$row->id_ms_keg;?>">
		<thead>
			<tr>
				<th rowspan="2" style="width:20px">No</th>
				<th rowspan="2">Nama Indikator</th>
				<th rowspan="2">Konsep</th>
				<th rowspan="2" style="min-width:250px">Definisi</th>
				<th rowspan="2" style="min-width:250px">Interpretasi</th>
				<th rowspan="2" style="min-width:250px">Metode/Rumus Penghitungan</th>
				<th rowspan="2">Ukuran</th>
				<th rowspan="2">Satuan</th>
				<th rowspan="2" style="min-width:250px">Klasifikasi Penyajian</th>
				<th rowspan="2">Indikator Komposit</th>
				<th colspan="2">Indikator Pembangun</th>
				<th colspan="3">Variabel Pembangun</th>
				<th rowspan="2">Level Estimasi</th>
				<th rowspan="2">Dapat Diakses Umum</th>
			</tr>
			<tr>
				<th>Publikasi Ketersediaan</th>
				<th>Nama</th>
				<th>Kegiatan Penghasil</th>
				<th>Kode Keg.</th>
				<th>Nama</th>
			</tr>
			<tr>
				<?php for($i=1; $i<=17; $i++) echo '<td>('.$i.')</td>'; ?>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($this->mskegiatan_model->get_indikator($row->id_ms_keg) as $v){
				echo '<tr key="'.$v->id.'" checklist="'.$v->checklist.'">
					<td>'.($no++).'</td>
					<td>'.$v->nama_indikator.'</td>
					<td>'.nl2br($v->konsep).'</td>
					<td>'.nl2br($v->definisi).'</td>
					<td>'.nl2br($v->interpretasi).'</td>
					<td>'.nl2br($v->metode).'</td>							
					<td>'.$v->ukuran.'</td>							
					<td>'.$v->satuan.'</td>							
					<td>'.nl2br($v->klasifikasi).'</td>							
					<td>'.$v->indikator_komposit.'</td>							
					<td>'.nl2br($v->indikator_pembangun_publikasi ?? '').'</td>							
					<td>'.$v->indikator_pembangun_nama.'</td>							
					<td>'.$v->variabel_pembangun_kegiatan.'</td>							
					<td>'.$v->variabel_pembangun_kode.'</td>							
					<td>'.$v->variabel_pembangun_nama.'</td>							
					<td>'.$v->level_estimasi.'</td>							
					<td>'.$v->dapat_diakses_umum.'</td>							
				</tr>';
			}?>
		</tbody>
	</table>
</div>

<?=anchor($this->router->class.'/index', '&laquo; Kembali');?>
<?php if(!$lock) { ?>
  <button class="tambah btn btn-default pull-right"><i class="fa fa-plus-circle" title="Tambah Variabel Baru"></i> Tambah</button>
<?php } ?>

<style>
	blockquote { margin-bottom: 0; }
	thead td, tbody td:last-child { font-size: small; text-align: center; padding: 0}
	thead td, tbody td:first-child { text-align: center; }
tr th:nth-child(2), tr td:nth-child(2) {
	position: sticky;
	left: 0;
	background: #fff;
	z-index: 999;
}
	tbody tr:hover, tbody tr:hover > td:nth-child(2) {background:#f0f0f0}

</style>

<?php if(!$lock) { ?>
<div id="myInd" style="display: none">
	<form method="post" action="<?=base_url($this->router->class.'/save');?>">
	<input type="hidden" id="id_ms_keg" name="id_ms_keg" value="<?=$row->id_ms_keg;?>">
	<input type="hidden" id="id_indikator" name="id_indikator" value="">
	<div class="row">
		<label>(2) Nama Indikator</label>
		<input id="nama_indikator" name="nama_indikator" class="form-control" required>
	</div>
	<div class="row">
		<label>(3) Konsep</label>
		<textarea id="konsep" name="konsep" class="form-control" rows="4" required></textarea>
	</div>
	<div class="row">
		<label>(4) Definisi</label>
		<textarea id="definisi" name="definisi" class="form-control" rows="4" required></textarea>
	</div>
	<div class="row">
		<label>(5) Interpretasi</label>
		<textarea id="interpretasi" name="interpretasi" class="form-control" rows="4"></textarea>
	</div>
	<div class="row">
		<label>(6) Metode</label>
		<textarea id="metode" name="metode" class="form-control" rows="4"></textarea>
	</div>
	<div class="row">
		<label>(7) Ukuran</label>
		<input id="ukuran" name="ukuran" class="form-control">
	</div>
	<div class="row">
		<label>(8) Satuan</label>
		<input id="satuan" name="satuan" class="form-control" required>
	</div>
	<div class="row">
		<label>(9) Klasifikasi Penyajian</label>
		<textarea id="klasifikasi" name="klasifikasi" class="form-control" rows="4" ></textarea>
	</div>
	<div class="row">
		<label>(10) Indikator Komposit</label>
		<select id="indikator_komposit" name="indikator_komposit" class="form-control" required><option>1-Ya</option><option>2-Tidak</option></select>
	</div>
	<hr>
	<div class="row">
		<label>(11) Indikator Pembangun - Publikasi Ketersediaan</label>
		<textarea id="indikator_pembangun_publikasi" name="indikator_pembangun_publikasi" class="form-control" rows="4" ></textarea>
	</div>
	<div class="row">
		<label>(12) Indikator Pembangun - Nama</label>
		<textarea id="indikator_pembangun_nama" name="indikator_pembangun_nama" class="form-control" rows="4" ></textarea>
	</div>
	<hr>
	<div class="row">
		<label>(13) Variabel Pembangun	- Kegiatan Penghasil</label>
		<input id="variabel_pembangun_kegiatan" name="variabel_pembangun_kegiatan" class="form-control" >
	</div>
	<div class="row">
		<label>(14) Variabel Pembangun	- Kode Kegiatan</label>
		<input id="variabel_pembangun_kode" name="variabel_pembangun_kode" class="form-control" >
	</div>
	<div class="row">
		<label>(15) Variabel Pembangun	- Nama</label>
		<input id="variabel_pembangun_nama" name="variabel_pembangun_nama" class="form-control" >
	</div>
	<hr>
	<div class="row">
		<label>(16) Level Estimasi</label>
		<input id="level_estimasi" name="level_estimasi" class="form-control" >
	</div>
	<div class="row">
		<label>(17) Apakah Kolom (2) Dapat Diakses Umum</label>
		<select id="dapat_diakses_umum" name="dapat_diakses_umum" class="form-control" required><option>1-Ya</option><option>2-Tidak</option></select>
	</div>

	<div class="row">
		<button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
		<span class="btn btn-sm btn-default" onclick="$('#myDialog').dialog('close')"><i class="fa fa-times"></i> Tutup</span>
		<a id="hapus" href="#" class="btn btn-flat btn-sm pull-right"><i class="fa fa-trash"></i></a>
	</div>
	</form>
</div>
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<style>
div[role=dialog] {font-size:small; z-index:1030;}
#myInd, #myCheck {padding:0 20px}
#myInd .btn, #myInd button, #myInd label,
#myCheck .btn, #myCheck button, #myCheck label {margin-top:10px}
.bulat {
	font-size: smaller;
	width: 19px;
	height: 19px;
	margin: 2px 0px;
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
$('tbody tr').each(function(){
	var check = $(this).attr('checklist');
	var ikon = check=='0'? 'question' : check=='1'?'check' : check=='2'? 'info' : 'exclamation';
	var warna = check=='0'? '#fff' : check=='1'?'green' : check=='2'? 'orange' : 'red';
	if(check==1)
		$(this).append('<td><i class="bulat fa fa-check"></i></td>');
	else
		$(this).append('<td><?php if(!$lock) { ?><a href="#"><i class="fa fa-edit"></i></a> <?php } ?> <i class="bulat fa fa-'+ikon+'"></i></td>');
});

<?php if(!$lock) { ?>
$('tbody tr td a').click(function(e){
	e.preventDefault();
	$('#myInd form').trigger('reset');

	var judul_kegiatan = $('h1').text(); 
	var tr = $(this).closest('tr'); 
	$('#id_ms_keg').val('<?=$row->id_ms_keg;?>');
	$('#id_indikator').val(tr.attr('key'));
	$('#nama_indikator').val(tr.find('td:nth-child(2)').text());
	$('#konsep').val(tr.find('td:nth-child(3)').text());
	$('#definisi').val(tr.find('td:nth-child(4)').text());
	$('#interpretasi').val(tr.find('td:nth-child(5)').text());
	$('#metode').val(tr.find('td:nth-child(6)').text());
	$('#ukuran').val(tr.find('td:nth-child(7)').text());
	$('#satuan').val(tr.find('td:nth-child(8)').text());
	$('#klasifikasi').val(tr.find('td:nth-child(9)').text());
	$('#indikator_komposit').val(tr.find('td:nth-child(10)').text());
	$('#indikator_pembangun_publikasi').val(tr.find('td:nth-child(11)').text());
	$('#indikator_pembangun_nama').val(tr.find('td:nth-child(12)').text());
	$('#variabel_pembangun_kegiatan').val(tr.find('td:nth-child(13)').text()).change();
	$('#variabel_pembangun_kode').val(tr.find('td:nth-child(14)').text());
	$('#variabel_pembangun_nama').val(tr.find('td:nth-child(15)').text());
	$('#level_estimasi').val(tr.find('td:nth-child(16)').text());
	$('#dapat_diakses_umum').val(tr.find('td:nth-child(17)').text()).change();

	$('#myInd').dialog({
		title:'Edit Indikator',
		width: 700,
		//modal: true
	});

	$('#myInd #hapus').show()
		.click(function(e){
			e.preventDefault();
			if(confirm('Hapus rincian ini?')){
				location.href = '<?=base_url('ms_indikator/del/');?>'+tr.closest('table').attr('key')+'/'+tr.attr('key');
			}
		});
});

$('.tambah').click(function(){
	$('#myInd').dialog({
		title:'Tambah Indikator',
		width: 700,
		modal: true
	});

	$('#myInd form').trigger('reset');
	$('#myInd #hapus').hide();

	var table = $(this).closest('table'); 
	$('#id_ms_keg').val('<?=$row->id_ms_keg;?>');
	
	$('#indikator_komposit').change(function(){
	    if($(this).val().substr(0,1)=='2'){
	        $('#variabel_pembangun_kegiatan').val($('h1').text().trim());
	        $('#variabel_pembangun_kode').val('<?=$row->id_wilayah;?>_<?=$row->id_ms_keg;?>');
	    } else {
	        $('#variabel_pembangun_kegiatan').val('');
	        $('#variabel_pembangun_kode').val('');
	    }
	})

});
<?php } ?>

$('thead th').css('text-align','center').css('vertical-align','middle');
$('thead td').css('padding','1px');
</script>

<div id="myCheck" style="display:none">
	<input type="hidden" id="id_ms_keg" value="<?=$row->id_ms_keg;?>">
	<input type="hidden" id="id_indikator">
	<div class="row">
		<label>Hasil Pemeriksaan</label>
		<select id="checklist" class="form-control" disabled>
		    <option value="0">Menunggu verifikasi</option>
		    <option value="1">Terisi, sesuai</option>
		    <option value="2">Terisi, tidak sesuai</option>
		    <option value="3">Tidak terisi</option>
		</select>
	</div>
	<div class="row">
		<label>Feedback</label>
		<textarea id="feedback" class="form-control" rows="4" disabled></textarea>
	</div>
	<div class="row">
		<label>Respon OPD</label>
		<textarea id="respon" class="form-control" rows="4" <?=$lock?'disabled':'required';?>></textarea>
	</div>
<?php if(!$lock) { ?>
	<div class="row">
		<button id="balas" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</div>
<?php } ?>
</div>

<div class="modal fade" id="modal-error">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-warning"></i> <span id="nama">Error Indikator</span></h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
    </div>
  </div>
</div>

<script>
$('i.bulat').css('cursor','pointer')
.click(function(){
    var bulat = $(this);
	var tr = $(this).closest('tr'); 
	var no = tr.find('td:nth-child(1)').text();
	var nama_indikator = tr.find('td:nth-child(2)').text();

  $.post('<?=base_url('ms_indikator/get_checklist');?>', {id_ms_keg:<?=$row->id_ms_keg;?>, id_indikator:tr.attr('key')}, function(result) {
  if(result.success==1){
	$('#id_indikator').val(tr.attr('key'));
	$('#checklist').val(result.data.checklist).change();
	$('#feedback').val(result.data.feedback);
	$('#respon').val(result.data.respon);

	$('#myCheck').dialog({
		title: no+'. '+nama_indikator,
		width: 400,
		modal: true,
	});

	var checklist = 0;	
	$( "input" ).on( "click", function() {
	  checklist = $("input:checked").val();
	});
	
	$('#balas').click(function(){
		var data = {
			id_ms_keg:$('#id_ms_keg').val(), 
			id_indikator: $('#id_indikator').val(),
			respon: $('#respon').val(),
		};

		$.post('<?=base_url('ms_indikator/save_checklist');?>', data, function(result){
			if(result.success==1) {
    	    	var ikon = checklist=='0'? 'question' : checklist=='1'?'check' : checklist=='2'? 'info' : 'exclamation';
    	    	bulat.parent().attr('check',checklist);
    	    	bulat.attr('class','bulat fa fa-'+ikon);
                $('#myCheck').dialog('close');
			} else
				alert(result.message);
		},'json');
	});
  } else
      alert(result.message);
  }, 'json');	
});

var errors = <?=json_encode($this->mskegiatan_model->get_validasi_indikator($row->id_ms_keg));?>;
$.each(errors, function(i,e){
	var tr = $('tbody').find('tr[key='+i+']');
	var td = tr.find('td:nth-child(1)');
	td.append('<br><span class="label bg-red">E</span>');
});

$('tbody tr td span.label.bg-red').css('cursor','pointer')
	.click(function(){
		var key = $(this).closest('tr').attr('key');
		$('#modal-error').modal('show');
		$('#nama').text($(this).closest('tr').find('td:nth-child(2)').text());
		$('.modal-body').html("");

		$.each(errors[key], function(i,e){
			$('#modal-error .modal-body').append('<li>'+e+'</li>');
		});
	});

</script>
