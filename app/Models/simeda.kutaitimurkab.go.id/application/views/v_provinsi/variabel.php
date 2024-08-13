<?php 
$approved = $row->approval_on=='0000-00-00 00:00:00'? false : true;
$cek_provinsi = $this->mskegiatan_model->get_cek_provinsi($row->id_ms_keg);
?>
<h4><?=$row->judul_kegiatan.' ('.$row->tahun.')';?></h4>
<h4><?=$row->instansi;?></h4>

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
				<th></th>
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

<form method="post">
<input type="hidden" name="id_ms_keg" value="<?=$row->id_ms_keg;?>">
<blockquote class="box box-success">
    <div class="box-body" style="font-style: italic;">
        <div>
  				<label>Diperiksa oleh : </label>
  				<input name="approved_by" class="form-control" value="<?=$cek_provinsi? $cek_provinsi->approved_by : '';?>" placeholder="Tuliskan nama pemeriksa">
  			</div>
        <div>
  				<label>Catatan : </label>
  	      <textarea name="catatan" class="form-control" placeholder="Tuliskan catatan hasil pemeriksaan" rows="5"><?php if($cek_provinsi) echo $cek_provinsi->catatan;?></textarea>
  	    </div>
    </div>
    <div class="box-footer">
  	    <div>
  	    	" Metadata Variabel dalam kuesioner ini telah melalui proses pemeriksaan oleh <b>BPS Provinsi</b> dan siap untuk dilanjutkan ke proses berikutnya. "
  	    </div>
        <div class="checkbox pull-left" style="margin-top:0; margin-bottom:0">
          <label>
            <input type="checkbox" name="cek_var" style="height: 24px" <?php if($cek_provinsi && $cek_provinsi->cek_var) echo 'checked';?>> Approval Variabel
          </label>
        </div>
        <button type="submit" class="btn btn-default pull-right"><i class="fa fa-check"></i> Submit</button>
      </div>
</blockquote>
</form>

<?=anchor($this->router->class.'/index/'.$row->id_wilayah, '&laquo; Kembali');?>

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
	.checkbox, .radio  {margin:0 10px;}
</style>

<link rel="stylesheet" type="text/css" href="<?=base_url('assets/jquery/jquery-ui.css');?>">
<script src="<?=base_url('assets/jquery/jquery-ui.min.js');?>"></script>

<div id="myDialog" style="display:none">
	<input type="hidden" id="id_ms_keg" value="<?=$row->id_ms_keg;?>">
	<input type="hidden" id="id_variabel">
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
		<textarea id="feedback" class="form-control" rows="4" required></textarea>
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
        <h4 class="modal-title"><i class="fa fa-warning"></i> <span id="nama">Error Variabel</span></h4>
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
	var check = $(this).attr('check');
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

  $.post('<?=base_url('v_variabel/get_checklist');?>', {id_ms_keg:<?=$row->id_ms_keg;?>, id_variabel:tr.attr('key')}, function(result) {
     if(result.success==1){
	$('#id_variabel').val(tr.attr('key'));
	$('#checklist_' + result.data.checklist).attr('checked','checked');
	$('#feedback').val(result.data.feedback);
	$('#respon').val(result.data.respon);

	$('#myDialog').dialog({
		title: no+'. '+nama_variabel,
		width: 400,
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
			id_variabel: $('#id_variabel').val(),
			checklist: checklist,
			feedback: $('#feedback').val(),
		};

		$.post('<?=base_url('v_variabel/save_checklist');?>', data, function(result){
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

  var approved = <?=$approved?'true':'false';?>;
});

$('thead th').css('text-align','left').css('vertical-align','middle');
$('thead td').css('text-align','left').css('padding-top','1px').css('padding-bottom','1px');

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