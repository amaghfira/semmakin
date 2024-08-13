<?php
$blok_iv = $this->mskegiatan_model->get_blok($data->id_ms_keg, 'iv');
?>
<form method="post" id="form-kegiatan">
<div class="box box-info">
	<div class="box-body">
		<div class="form-group">
			<div class="col-sm-11">
				<label>4.3. Tipe Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="tipe_pengumpulan_data" name="blok_iv[tipe_pengumpulan_data]" value="<?=$blok_iv->tipe_pengumpulan_data;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Longitudinal Panel <span class="pull-right">- 1</span></li>
				<li>Longitudinal Cross Sectional <span class="pull-right">- 2</span></li>
				<li>Cross Sectional <span class="pull-right">- 3</span></li>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.4. Cakupan Wilayah Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="cakupan_wilayah_pengumpulan_data"  name="blok_iv[cakupan_wilayah_pengumpulan_data]" value="<?=$blok_iv->cakupan_wilayah_pengumpulan_data;?>" list-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Seluruh Wilayah Indonesia <span class="pull-right">- 1</span></li>
				<li>Sebagian Wilayah Indonesia <span class="pull-right">- 2</span></li>
			</div>
			<div class="col-sm-4">
				<i class="fa fa-long-arrow-right"></i> langsung ke R.4.6</span>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>4.5.	Jika “sebagian wilayah Indonesia” (R.4.4. berkode 2), Wilayah Kegiatan:</label>
				<table id="tabel-wilayah" class="table col-sm-offset-1" style="width:96.67%">
					<thead>
						<tr>
							<th style="width:20px">No</th>
							<th>Provinsi</th>
							<th>Kabupaten/Kota</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($this->mskegiatan_model->get_wilayah($data->id_ms_keg) as $row){
							echo '<tr key="'.$row->id.'">
								<td>'.($no++).'</td>
								<td>'.$row->provinsi.'</td>
								<td>'.$row->kabupaten.'</td>
							</tr>';
						}?>
					</tbody>
<?php if(!$data->sedang_verifikasi && $data->approval_on=='0000-00-00 00:00:00') { ?>
					<tfoot>
						<tr>
							<th></th>
							<th><select id="v_provinsi" class="form-control input-sm"></select></th>
							<th><select id="v_kabupaten" class="form-control input-sm"></select></th>
							<th><span id="insert" class="btn btn-default btn-flat btn-sm"><i class="fa fa-save"></i></span></th>
						</tr>
					</tfoot>
<?php } ?>
				</table>
				
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.6. Metode Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="metode_pengumpulan_data"  name="blok_iv[metode_pengumpulan_data]" value="<?=$blok_iv->metode_pengumpulan_data;?>" multi-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Wawancara 
					<span class="pull-right">- 1</span></li>
				<li>Mengisi kuesioner sendiri (swacacah) 
					<span class="pull-right">- 2</span></li>
				<li>Pengamatan (observasi) 
					<span class="pull-right">- 4</span></li>
				<li>Pengumpulan data sekunder 
					<span class="pull-right">- 8</span></li>
				<li>Lainnya (sebutkan) 
					<span class="pull-right">- 16</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" blok="iv" id="metode_pengumpulan_data_lainnya"name="blok_iv[metode_pengumpulan_data_lainnya]" value="<?=$blok_iv->metode_pengumpulan_data_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.7. Sarana Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="sarana_pengumpulan_data"  name="blok_iv[sarana_pengumpulan_data]" value="<?=$blok_iv->sarana_pengumpulan_data;?>" multi-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Paper-assisted Personal Interviewing (PAPI) 
					<span class="pull-right">- 1</span></li>
				<li>Computer-assisted Personal Interviewing (CAPI) 
					<span class="pull-right">- 2</span></li>
				<li>Computer-assisted Telephones Interviewing (CATI) 
					<span class="pull-right">- 4</span></li>
				<li>Computer Aided Web Interviewing (CAWI) 
					<span class="pull-right">- 8</span></li>
				<li>Mail 
					<span class="pull-right">- 16</span></li>
				<li>Lainnya (sebutkan) 
					<span class="pull-right">- 32</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" blok="iv" id="sarana_pengumpulan_data_lainnya" name="blok_iv[sarana_pengumpulan_data_lainnya]" value="<?=$blok_iv->sarana_pengumpulan_data_lainnya;?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-11">
				<label>4.8. Unit Pengumpulan Data:</label>
			</div>
			<div class="col-sm-1">
				<input class="form-control" approval="" blok="iv" id="unit_pengumpulan_data" name="blok_iv[unit_pengumpulan_data]" value="<?=$blok_iv->unit_pengumpulan_data;?>" multi-item>
			</div>
			<div class="col-sm-4 col-sm-offset-1">
				<li>Individu 
					<span class="pull-right">- 1</span></li>
				<li>Rumah tangga 
					<span class="pull-right">- 2</span></li>
				<li>Usaha/perusahaan 
					<span class="pull-right">- 4</span></li>
				<li>Lainnya (sebutkan) 
					<span class="pull-right">- 8</span></li>
				<input class="form-control" placeholder="(Lainnya) Sebutkan" approval="" blok="iv" id="unit_pengumpulan_data_lainnya" name="blok_iv[unit_pengumpulan_data_lainnya]" value="<?=$blok_iv->unit_pengumpulan_data_lainnya;?>">
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

<div id="myKab" style="display: none">
	<form method="post" action="<?=base_url('ms_kegiatan/save_wilayah/'.$data->id_ms_keg);?>">
	<input type="hidden" id="id_wilayah" name="id_wilayah" value="">
	<div class="row">
		<label>Provinsi</label>
		<select id="provinsi" name="provinsi" class="form-control" required></select>
	</div>
	<div class="row">
		<label>Kabupaten</label>
		<select id="kabupaten" name="kabupaten" class="form-control" required></select>
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
	#myKab {padding:0 20px 10px}
	#myKab button {margin-top:10px}
</style>
<script>
<?php if(!$data->sedang_verifikasi && $data->approval_on=='0000-00-00 00:00:00') { ?>

$.get('<?=base_url('ms_kegiatan/master_provinsi');?>', function(result){
  $.each(result, function(i,e){
    $('#provinsi').append('<option value="'+i+'">'+e+'</option>');
    $('#v_provinsi').append('<option value="'+i+'">'+e+'</option>');
  });
  $("#provinsi").sortSelect();
  $("#v_provinsi").sortSelect();
},'json');

$('#provinsi').change(function(){
  if($(this).val()){
    $("#kabupaten").html('');
    $.get('<?=base_url('ms_kegiatan/master_kabupaten/');?>'+$(this).val(), function(result){
      $.each(result, function(i,e){
        $('#kabupaten').append('<option>'+e+'</option>');
      });
      $('#kabupaten').append('<option>- SELURUH KABUPATEN/KOTA -</option>');
      $("#kabupaten").sortSelect();
    },'json');
  }
});

$('#v_provinsi').change(function(){
  if($(this).val()){
    $("#v_kabupaten").html('');
    $.get('<?=base_url('ms_kegiatan/master_kabupaten/');?>'+$(this).val(), function(result){
      $.each(result, function(i,e){
        $('#v_kabupaten').append('<option>'+e+'</option>');
      });
      $('#v_kabupaten').append('<option>- SELURUH KABUPATEN/KOTA -</option>');
      $("#v_kabupaten").sortSelect();
    },'json');
  }
});


$('#tabel-wilayah tbody tr').each(function(){
	$(this).append('<td><a href="#"><i class="fa fa-edit"></i></a></td>');
});

$('#tabel-wilayah a').click(function(e){
	var form = $('#form-kegiatan');
	$.post(location.href, form.serialize());

	e.preventDefault();
	var tr = $(this).closest('tr'); 

	$('#id_wilayah').val(tr.attr('key'));
	$('#provinsi').val(tr.find('td:nth-child(2)').text());
	$('#kabupaten').val(tr.find('td:nth-child(3)').text());

	$('#myKab').dialog({
		title:'Edit Wilayah',
	});

	$('#myKab #hapus').show()
		.click(function(e){
			e.preventDefault();
			if(confirm('Hapus rincian ini?')){
				location.href = '<?=base_url('ms_kegiatan/del_wilayah/'.$data->id_ms_keg.'/');?>'+tr.attr('key');
			}
		});
});

$('#tambah').click(function(){
	var form = $('#form-kegiatan');
	$.post(location.href, form.serialize());

	$('#myKab').dialog({
		title:'Tambah Wilayah',
	});
	$('#myKab #hapus').hide();
});

$('#v_kabupaten').keydown(function(e){
	if(e.keyCode==13) $('#insert').focus().click();
});

$('#insert').click(function(){
	var data = {};
	data.provinsi = $('#v_provinsi option:selected').text();
	data.kabupaten = $('#v_kabupaten option:selected').text();
console.log(data);
	if(data.provinsi!='- Pilih -' && data.kabupaten!='- Pilih -'){
		$.post('<?=base_url('ms_kegiatan/save_wilayah/'.$data->id_ms_keg);?>', data, function(result){
console.log(result);		    
			if(result.id){
				$('#tabel-wilayah tbody').append('<tr><td></td><td>'+data.provinsi+'</td><td>'+data.kabupaten+'</td><td></td></tr>');
				$('#v_provinsi').val('');
				$('#v_kabupaten').val('');	
			}
		},'json');
	} else
		alert('Provinsi dan Kabupaten harus terisi');
});

$.fn.extend({
    sortSelect() {
        let options = this.find("option"),
            arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();

        arr.sort((o1, o2) => { // sort select
            let t1 = o1.t.toLowerCase(), 
                t2 = o2.t.toLowerCase();
            return t1 > t2 ? 1 : t1 < t2 ? -1 : 0;
        });

        options.each((i, o) => {
            o.value = arr[i].v;
            $(o).text(arr[i].t);
        });
    }
});

<?php } ?>

</script>

<script>
var id_ms_keg = '<?=$data->id_ms_keg;?>';
var url = '<?=base_url('ms_kegiatan');?>';
var checklist = <?=json_encode(
	$this->mskegiatan_model->get_checklist($data->id_ms_keg,'iv')
);?>;

var disabled = <?=($data->sedang_verifikasi || $data->approval_on!='0000-00-00 00:00:00')?'true':'false';?>;
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
