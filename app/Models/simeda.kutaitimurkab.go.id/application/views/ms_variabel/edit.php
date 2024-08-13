<?php
$lock = $row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00';
?>
<div class="box box-info" style="width:100%; overflow-x:scroll">
	<table class="table" key="<?=$row->id_ms_keg;?>">
		<thead>
			<tr>
				<th style="width:20px">No</th>
				<th>Nama Variabel</th>
				<th>Alias</th>
				<th>Konsep</th>
				<th>Definisi</th>
				<th>Referensi Pemilihan</th>
				<th>Referensi Waktu</th>
				<th>Tipe Data</th>
				<th>Klasifikasi Isian</th>
				<th>Aturan Validasi</th>
				<th>Kalimat Pertanyaan</th>
				<th>Dapat Diakses Umum</th>
			</tr>
			<tr>
				<?php for($i=1; $i<=12; $i++) echo '<td>('.$i.')</td>'; ?>
			</tr>
		</thead>
		<tbody>
			<?php $no=1; foreach($this->mskegiatan_model->get_variabel($row->id_ms_keg) as $v){
				echo '<tr key="'.$v->id.'" check="'.$v->checklist.'">
					<td>'.($no++).'</td>
					<td>'.$v->nama_variabel.'</td>
					<td>'.$v->alias.'</td>
					<td>'.$v->konsep.'</td>
					<td>'.$v->definisi.'</td>
					<td>'.$v->referensi_pemilihan.'</td>							
					<td>'.$v->referensi_waktu.'</td>							
					<td>'.$v->tipe_data.'</td>							
					<td>'.$v->klasifikasi_isian.'</td>							
					<td>'.$v->aturan_validasi.'</td>							
					<td>'.$v->kalimat_pertanyaan.'</td>							
					<td>'.$v->dapat_diakses_umum.'</td>							
				</tr>';
			}?>
		</tbody>
	</table>
</div>

<?=anchor($this->router->class.'/index', '&laquo; Kembali');?>
<?php if(!$lock){ ?>
<button class="tambah btn btn-default pull-right"><i class="fa fa-plus-circle" title="Tambah Variabel Baru"></i> Tambah</button>
<?php } ?>

<style>
	blockquote { margin-bottom: 0; }

	tr th:nth-child(2),
	tr td:nth-child(2) {
		position: sticky;
		left: 0px;
		z-index: 999;
		background-color: #fff;
	} 

	thead td, tbody td:last-child { font-size: small; text-align: center; padding: 0}
	thead td, tbody td:first-child { text-align: center; }

	tbody tr:hover, tbody tr:hover > td:nth-child(2) {background:#f0f0f0}
</style>

<?php if(!$lock) { ?>
<div id="myVar" style="display: none">
	<form method="post" action="<?=base_url('ms_variabel/save');?>">
	<input type="hidden" id="id_ms_keg" name="id_ms_keg" value="<?=$row->id_ms_keg;?>">
	<input type="hidden" id="id_variabel" name="id_variabel" value="">
	<div class="row">
		<label>(2) Nama Variabel</label>
		<input id="nama_variabel" name="nama_variabel" class="form-control" required>
	</div>
	<div class="row">
		<label>(3) Alias</label>
		<input id="alias" name="alias" class="form-control">
	</div>
	<div class="row">
		<label>(4) Konsep</label>
		<textarea id="konsep" name="konsep" class="form-control" rows="4" required></textarea>
	</div>
	<div class="row">
		<label>(5) Definisi</label>
		<textarea id="definisi" name="definisi" class="form-control" rows="4" required></textarea>
	</div>
	<div class="row">
		<label>(6) Referensi Pemilihan</label>
		<textarea id="referensi_pemilihan" name="referensi_pemilihan" class="form-control" rows="4"></textarea>
	</div>
	<div class="row">
		<label>(7) Referensi Waktu</label>
		<input id="referensi_waktu" name="referensi_waktu" class="form-control" required>
	</div>
	<div class="row">
		<label>(8) Tipe Data</label>
		<input id="tipe_data" name="tipe_data" class="form-control">
	</div>
	<div class="row">
		<label>(9) Klasifikasi Isian</label>
		<textarea id="klasifikasi_isian" name="klasifikasi_isian" class="form-control" rows="4"></textarea>
	</div>
	<div class="row">
		<label>(10) Aturan Validasi</label>
		<textarea id="aturan_validasi" name="aturan_validasi" class="form-control" rows="4"></textarea>
	</div>
	<div class="row">
		<label>(11) Kalimat Pertanyaan</label>
		<textarea id="kalimat_pertanyaan" name="kalimat_pertanyaan" class="form-control" rows="4"></textarea>
	</div>
	<div class="row">
		<label>(12) Apakah Kolom (2) Dapat Diakses Umum</label>
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
#myVar, #myCheck {padding:0 20px 10px}
#myVar .btn, #myVar button, #myVar label,
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
th {padding:0;}
</style>
<script>
$('tbody tr').each(function(){
	var check = $(this).attr('check');
	var ikon = check=='0'? 'question' : check=='1'?'check' : check=='2'? 'info' : 'exclamation';
	var warna = check=='0'? '#fff' : check=='1'?'green' : check=='2'? 'orange' : 'red';
	if(check==1)
		$(this).find('td:last-child').append('<i class="bulat fa fa-check pull-right"></i>');
	else
		$(this).find('td:last-child').append('<span class=" pull-right"><?php if(!$lock) echo '<a href="#"><i class="fa fa-edit"></i></a> ';?><i class="bulat fa fa-'+ikon+'"></i></span>');
});

<?php if(!$lock) { ?>
$('tbody tr td a').click(function(e){
	e.preventDefault();
	$('#myVar form').trigger('reset');

	var tr = $(this).closest('tr'); 
	$('#id_ms_keg').val('<?=$row->id_ms_keg;?>');
	$('#id_variabel').val(tr.attr('key'));
	$('#nama_variabel').val(tr.find('td:nth-child(2)').text());
	$('#alias').val(tr.find('td:nth-child(3)').text());
	$('#konsep').val(tr.find('td:nth-child(4)').text());
	$('#definisi').val(tr.find('td:nth-child(5)').text());
	$('#referensi_pemilihan').val(tr.find('td:nth-child(6)').text());
	$('#referensi_waktu').val(tr.find('td:nth-child(7)').text());
	$('#tipe_data').val(tr.find('td:nth-child(8)').text());
	$('#klasifikasi_isian').val(tr.find('td:nth-child(9)').text());
	$('#aturan_validasi').val(tr.find('td:nth-child(10)').text());
	$('#kalimat_pertanyaan').val(tr.find('td:nth-child(11)').text());
	$('#dapat_diakses_umum').val(tr.find('td:nth-child(12)').text());

	$('#myVar').dialog({
		title:'Edit Variabel',
		width: 700,
		modal: true
	});

	$('#myVar #hapus').show()
		.click(function(e){
			e.preventDefault();
			if(confirm('Hapus rincian ini?')){
				location.href = '<?=base_url('ms_variabel/del/');?>'+tr.closest('table').attr('key')+'/'+tr.attr('key');
			}
		});
});

$('.tambah').click(function(){
	$('#myVar').dialog({
		title:'Tambah Variabel',
		width: 700,
		modal: true
	});

	$('#myVar form').trigger('reset');
	$('#myVar #hapus').hide();

	var table = $(this).closest('table'); 
	$('#id_ms_keg').val('<?=$row->id_ms_keg;?>');
});
<?php } ?>

$('thead th').css('text-align','left').css('vertical-align','middle');
$('thead td').css('text-align','left').css('padding-top','1px').css('padding-bottom','1px');

$('#tabel-variabel tbody tr').each(function(){
	var checklist = $(this).attr('checklist');
	var title = checklist=='1'?'Terisi, sesuai' : checklist=='2'?'Terisi, tidak sesuai' : checklist=='3'? 'Tidak terisi' : 'Menunggu verifikasi';
	var ikon = checklist=='1'?'check': checklist=='3'? 'exclamation' : checklist=='2'? 'info' : 'question';
	$(this).find('td:last-child').append('<i class="bulat fa fa-'+ikon+' pull-right" title="'+title+'"></i>');
});

</script>

<div id="myCheck" style="display:none">
	<input type="hidden" id="id_ms_keg" value="<?=$row->id_ms_keg;?>">
	<input type="hidden" id="id_variabel">
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
		<textarea id="respon" class="form-control" rows="4" required></textarea>
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
        <h4 class="modal-title"><i class="fa fa-warning"></i> <span id="nama">Error Variabel</span></h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
    </div>
  </div>
</div>

<script>
var disabled = <?=($row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00')? 'true' : 'false';?>;

$('i.bulat').css('cursor','pointer')
.click(function(){
    var bulat = $(this);
	var tr = $(this).closest('tr'); 
	var no = tr.find('td:nth-child(1)').text();
	var nama_variabel = tr.find('td:nth-child(2)').text();

  $.post('<?=base_url('ms_variabel/get_checklist');?>', {id_ms_keg:<?=$row->id_ms_keg;?>, id_variabel:tr.attr('key')}, function(result) {
  if(result.success==1){
	$('#id_variabel').val(tr.attr('key'));
	$('#checklist').val(result.data.checklist).change();
	$('#feedback').val(result.data.feedback);
	$('#respon').val(result.data.respon);

	if(result.data.checklist==1) $('#respon').attr('disabled',true);

	$('#myCheck').dialog({
		title: no+'. '+nama_variabel,
		width: 400,
		modal: true,
	});

	<?php if($lock) echo "$('#respon').attr('disabled',true);";?>

	var checklist = 0;	
	$( "input" ).on( "click", function() {
	  checklist = $("input:checked").val();
	});
	
<?php if(!$lock){?>
	$('#balas').click(function(){
		var data = {
			id_ms_keg:$('#id_ms_keg').val(), 
			id_variabel: $('#id_variabel').val(),
			respon: $('#respon').val(),
		};

		$.post('<?=base_url('ms_variabel/save_checklist');?>', data, function(result){
			if(result.success==1) {
    	    	var ikon = checklist=='0'? 'question' : checklist=='1'?'check' : checklist=='2'? 'info' : 'exclamation';
    	    	bulat.parent().attr('check',checklist);
    	    	bulat.attr('class','bulat fa fa-'+ikon);
                $('#myCheck').dialog('close');
			} else
				alert(result.message);
		},'json');
	});
<?php } ?>
  } else
      alert(result.message);
  }, 'json');	
});

var errors = <?=json_encode($this->mskegiatan_model->get_validasi_variabel($row->id_ms_keg));?>;
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
