<?php
$approved = $row->approval_on!='0000-00-00 00:00:00';
?>
<div class="box box-info" style="width:100%; overflow-x:scroll">
	<table class="table" key="<?=$row->id_ms_keg;?>">
		<thead>
			<tr>
				<th rowspan="2" style="width:20px">No</th>
				<th rowspan="2">Nama Indikator</th>
				<th rowspan="2">Konsep</th>
				<th rowspan="2">Definisi</th>
				<th rowspan="2">Interpretasi</th>
				<th rowspan="2">Metode/Rumus Penghitungan</th>
				<th rowspan="2">Ukuran</th>
				<th rowspan="2">Satuan</th>
				<th rowspan="2">Klasifikasi Penyajian</th>
				<th rowspan="2">Indikator Komposit</th>
				<th colspan="2">Indikator Pembangun</th>
				<th colspan="3">Variabel Pembangun</th>
				<th rowspan="2">Level Estimasi</th>
				<th rowspan="2">Dapat Diakses Umum</th>
				<th rowspan="2"></th>
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
					<td>'.$v->konsep.'</td>
					<td>'.$v->definisi.'</td>
					<td>'.$v->interpretasi.'</td>
					<td>'.$v->metode.'</td>							
					<td>'.$v->ukuran.'</td>							
					<td>'.$v->satuan.'</td>							
					<td>'.$v->klasifikasi.'</td>							
					<td>'.$v->indikator_komposit.'</td>							
					<td>'.$v->indikator_pembangun_publikasi.'</td>							
					<td>'.$v->indikator_pembangun_nama.'</td>							
					<td>'.$v->variabel_pembangun_kegiatan.'</td>							
					<td>'.$v->variabel_pembangun_kode.'</td>							
					<td>'.$v->variabel_pembangun_nama.'</td>							
					<td>'.$v->level_estimasi.'</td>							
					<td>'.$v->dapat_diakses_umum.'</td>							
					<td></td>							
				</tr>';
			}?>
		</tbody>
	</table>
</div>

<?=anchor($this->router->class.'/index', '&laquo; Kembali');?>

<style>
	blockquote { margin-bottom: 0; }

	tr th:nth-child(2),
	tr td:nth-child(2) {
		position: sticky;
		left: 0px;
		z-index: 9999;
		background-color: #fff;
	} 

	thead td, tbody td:last-child { font-size: small; text-align: center; padding: 0}
	thead td, tbody td:first-child { text-align: center; }
	tbody tr:hover, tbody tr:hover > td:nth-child(2) {background:#f0f0f0}
	.checkbox, .radio  {margin:0 10px;}
</style>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display:none">
	<input type="hidden" id="id_ms_keg" value="<?=$row->id_ms_keg;?>">
	<input type="hidden" id="id_indikator">
	<div class="row">
		<label>Hasil Pemeriksaan</label>
		<div class="radio">
			<label>
		    	<input type="radio" name="checklist" id="checklist_1" value="1">
				Terisi, sesuai
		    </label>
		</div>
		<div class="radio">
			<label>
		    	<input type="radio" name="checklist" id="checklist_2" value="2">
				Terisi, tidak sesuai
		    </label>
		</div>
		<div class="radio">
			<label>
		    	<input type="radio" name="checklist" id="checklist_3" value="3"> 
				Tidak terisi
		    </label>
		</div>
	</div>
	<div class="row">
		<label>Feedback</label>
		<textarea id="feedback" class="form-control" rows="4" <?=$approved? 'disabled' : 'required';?>></textarea>
	</div>
	<div class="row">
		<label>Respon OPD</label>
		<textarea id="respon" class="form-control" rows="4" disabled></textarea>
	</div>
<?php if(!$approved) { ?>
	<div class="row">
		<button id="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
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

<style>
div[role=dialog] {font-size:small; z-index:9999;}
#myDialog {padding:0 20px 10px}
#myDialog button, #myDialog label {margin-top:10px}

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
	$(this).append('<td><a href="#"><i class="bulat fa fa-'+ikon+'"></i></a></td>');
});

$('tbody tr td a').click(function(e){
	e.preventDefault();
	var bulat = $(this).find('i');
	$('#myDialog[name=checklist]').removeAttr('checked');

	var tr = $(this).closest('tr'); 
	var no = tr.find('td:nth-child(1)').text();
	var nama_variabel = tr.find('td:nth-child(2)').text();

  $.post('<?=base_url('v_indikator/get_checklist');?>', {id_ms_keg:<?=$row->id_ms_keg;?>, id_indikator : tr.attr('key')}, function(result) {
     if(result.success==1){
	$('#id_indikator').val(tr.attr('key'));
	$('#checklist_' + result.data.checklist).attr('checked','checked');
	$('#feedback').val(result.data.feedback);
	$('#respon').val(result.data.respon);

<?php if(!$approved) { ?>
$
<?php } ?>

	$('#myDialog').dialog({
		title: no+'. '+nama_variabel,
		width: 700,
		modal: true,
	});

	var checklist = 0;	
	$( "input" ).on( "click", function() {
	  checklist = $("input:checked").val();
	});

<?php if(!$approved) { ?>
	$('#submit').click(function(){
		var data = {
			id_ms_keg:$('#id_ms_keg').val(), 
			id_indikator: $('#id_indikator').val(),
			checklist: checklist,
			feedback: $('#feedback').val(),
		};

		$.post('<?=base_url('v_indikator/save_checklist');?>', data, function(result){
			if(result.success==1) {
    	    	var ikon = checklist=='0'? 'question' : checklist=='1'?'check' : checklist=='2'? 'info' : 'exclamation';
    	    	bulat.parent().attr('check',checklist);
    	    	bulat.attr('class','bulat fa fa-'+ikon);
                $('#myDialog').dialog('close');
			} else
				alert(result.message);
		},'json');
	});
<?php } ?>

     } else
        alert(result.message);
  }, 'json');
});

$('thead th').css('text-align','left').css('vertical-align','middle');
$('thead td').css('text-align','left').css('padding-top','1px').css('padding-bottom','1px');

var errors = <?=json_encode($this->mskegiatan_model->get_validasi_indikator($row->id_ms_keg));?>;
$.each(errors, function(i,e){
	var tr = $('tbody').find('tr[key='+i+']');
	var td = tr.find('td:nth-child(1)');
	td.append('<br><span class="badge bg-red">E</span>');
});

$('tbody tr td span.badge.bg-red').css('cursor','pointer')
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