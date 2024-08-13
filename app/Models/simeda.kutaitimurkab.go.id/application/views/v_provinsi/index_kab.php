<?php
$userid = isset($userid)? $userid : '';
?>
<?=form_dropdown('',array(''=>'- Pilih Wilayah -')+$this->wilayah_model->arr_all(),$id_wilayah,array('id'=>'pilih_wilayah','class'=>'form-control')).'<br>';?>

	<?php $i=1; foreach($this->mskegiatan_model->all_by_wilayah($id_wilayah) as $row){
		$cek_provinsi = $this->mskegiatan_model->get_cek_provinsi($row->id_ms_keg);
		$status = $this->mskegiatan_model->get_checklist_status($row->id_ms_keg);
		$lock = $row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00'? '<i class="fa fa-lock"></i>' : '';
		$error = $this->mskegiatan_model->get_validasi($row->id_ms_keg)?'<span class="label bg-red" title="Masih ada validasi yang error">Error</span>' : '<span class="label bg-green">Clean</span>';

		echo '<blockquote key="'.$row->id_ms_keg.'" '.($cek_provinsi && $cek_provinsi->cek_keg?'cek=1':($cek_provinsi && !$cek_provinsi->cek_keg && $cek_provinsi->catatan?'cek=2':'')).'><judul>'.($i++).'. '.$row->judul_kegiatan.' ('.$row->tahun.')</judul>'.
        '<span class="label pull-right bg-'.($row->approval_on!='0000-00-00 00:00:00'? 'green' : 'gray').'" title="'.($row->approval_on!='0000-00-00 00:00:00'? 'APPROVED' : 'Belum approval').'"><i class="fa fa-'.($row->approval_on!='0000-00-00 00:00:00'? 'check' : 'question').'"></i></span>'.
		'<small>'.$lock.' '.$error.' &middot; '.
		$row->instansi.' &middot; '.
		date('d M Y',strtotime($row->created_on)).
		' &middot; <var '.($cek_provinsi && $cek_provinsi->cek_var?'cek':'').'>'.$this->mskegiatan_model->get_jml_variabel($row->id_ms_keg).' Variabel</var> &middot; <ind '.($cek_provinsi && $cek_provinsi->cek_ind?'cek':'').'>'.$this->mskegiatan_model->get_jml_indikator($row->id_ms_keg).' Indikator</ind> '.
		' &middot; Verifikasi : '.
        ($status && $status->kode_0? '<span class="badge bg-gray">'.$status->kode_0.'</span> ':'').
        ($status && $status->kode_1? '<span class="badge bg-green">'.$status->kode_1.'</span> ':'').
        ($status && $status->kode_2? '<span class="badge bg-orange">'.$status->kode_2.'</span> ':'').
        ($status && $status->kode_3? '<span class="badge bg-red">'.$status->kode_3.'</span> ':'').
//        '<a href="#" key="'.$this->mskegiatan_model->get_hash($row->id_ms_keg).'"><i class="fa fa-download"></i></a>'.
        '</small></blockquote >';
    } ?>

<div class="modal fade" id="modal-dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-warning"></i> <text>MODAL DIALOG</text></h4>
      </div>
      <div class="modal-body">
        <p></p>
      </div>
    </div>
  </div>
</div>

<style>
blockquote {background:#fff; border-left: 3px solid #00c0ef80; border-bottom: 1px solid #00c0ef40}
	judul {display: block;}
	.box[key] {margin-bottom: 10px;}
	.box[key] small {padding-left: 10px}
	.badge, .label {cursor:help;}
</style>
<script>
	$('a[key]').click(function(){
        window.open('<?=base_url('pdf/');?>'+$(this).attr('key'));
	});

$('[key]').each(function(){
	var key = $(this).attr('key');
	var userid = $(this).find('user').attr('val');

	$(this).find('judul').html('<a href="<?=base_url('v_provinsi/edit/');?>'+key+'">'+$(this).find('judul').html()+'</a>');

	var cek_var = $(this).find('var')
	cek_var.html('<a href="<?=base_url('v_provinsi/variabel/');?>'+key+'">'+$(this).find('var').text()+'</a>');
	if(cek_var.is('[cek]'))
		cek_var.find('a').addClass('label bg-green').attr('title','Variabel : Sudah Approval');

	var cek_ind = $(this).find('ind');
	cek_ind.html('<a href="<?=base_url('v_provinsi/indikator/');?>'+key+'">'+$(this).find('ind').text()+'</a>');
	if(cek_ind.is('[cek]'))
		cek_ind.find('a').addClass('label bg-green').attr('title','Indikator : Sudah Approval');

	if($(this).is('[cek]')){
		var cek = $(this).attr('cek');
		$(' <span class="label bg-'+(cek==1?'green':'orange')+' pull-right prov" title="Pemeriksaan Oleh Provinsi"><i class="fa fa-search"></i></span>').insertAfter($(this).find('judul'));
	}

	$('.label.bg-gray').attr('title','Menunggu approval Kab/Kota');
	$('.badge.bg-gray').attr('title','Menunggu verifikasi Kab/Kota');
	$('.badge.bg-green').attr('title','Verifikasi : Sesuai');
	$('.badge.bg-orange').attr('title','Verifikasi : Terisi, tapi belum sesuai');
	$('.badge.bg-red').attr('title','Verifikasi : Belum terisi');
});

$('i.fa-lock').css('cursor','pointer').attr('title','Klik untuk UNLOCK kegiatan beserta variabel dan indikator').click(function(){
    var $this = $(this);
    var judul = $(this).closest('blockquote').find('judul').text();
    if(confirm('Unlock kegiatan ini beserta variabel dan indikatornya ?'+'\n\n'+judul)) {
        var key = $(this).closest('blockquote').attr('key');
        $.post('<?=base_url('v_kegiatan/sedang_verifikasi');?>', {id_ms_keg:key, value:false}, function(result){
            $this.remove();
        },'json');
    }
});

$('blockquote .badge').css('cursor','pointer').click(function(){
  var key = $(this).closest('blockquote').attr('key');
  var judul = $(this).closest('blockquote').find('judul').text();
  var status = $(this).attr('title');
  var value = 0;
  if($(this).hasClass('bg-green')) value = 1;
  else if($(this).hasClass('bg-orange')) value = 2;
  else if($(this).hasClass('bg-red')) value = 3;

  $.get('<?=base_url('ms_kegiatan/checklist_by_status');?>/'+key+'/'+value, function(result){
    if(result.success){
		$('#modal-dialog .modal-title text').text(status);
		$('#modal-dialog .modal-body').html('<ul></ul>');
		$.each(result.data, function(i,e){
			$('#modal-dialog .modal-body ul').append('<li>'+e+'</li>');
		});
		$('#modal-dialog .modal-body ul li').css('margin-bottom','10px');
		$('#modal-dialog').modal('show');
    } else 
        alert(result.message);
  }, 'json');
});

$('blockquote .label.bg-red').css('cursor','pointer').click(function(){
  var key = $(this).closest('blockquote').attr('key');

  $.get('<?=base_url('ms_kegiatan/validasi');?>/'+key, function(result){
		$('#modal-dialog .modal-title text').text('Validasi Masih ERROR');
		$('#modal-dialog .modal-body').html('<ul></ul>');
		$.each(result, function(i,e){
          $.each(e, function(j,v){
			$('#modal-dialog .modal-body ul').append('<li>'+v+'</li>');
          });
		});
		$('#modal-dialog .modal-body ul li').css('margin-bottom','10px');
		$('#modal-dialog').modal('show');
  }, 'json');
});

$("#pilih_wilayah").change(function(){
	if($(this).val())
		location.href='<?=base_url('v_provinsi');?>/index/'+$(this).val();
});
</script>

<div class="modal fade" id="prov-dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-search"></i> Pemeriksaan oleh Provinsi</h4>
      </div>
      <div class="modal-body">
      	<div>
      		<label id="cek_judul">Judul Kegiatannya apa....</label>
      		<div style="padding-left:20px;"><i id="cek_keg" class="fa fa-square-o"></i> MS Kegiatan</div>
      		<div style="padding-left:20px;"><i id="cek_var"class="fa fa-square-o"></i> MS Variabel</div>
      		<div style="padding-left:20px;"><i id="cek_ind" class="fa fa-square-o"></i> MS Indikator</div>
      		<textarea class="form-control" id="cek_catatan" rows="5"></textarea>
      	</div>
      </div>
      <div class="modal-footer" style="padding:5px 15px">
      	Diperiksa oleh : <span id="cek_pemeriksa"></span>
      </div>
    </div>
  </div>
</div>

<script>
$('span.prov').css('cursor','pointer').click(function(){
	var id_ms_keg = $(this).closest('blockquote').attr('key');
	var judul_kegiatan = $(this).closest('blockquote').find('judul').text();
	$.get('<?=base_url('v_provinsi/get/'.$id_wilayah);?>/'+id_ms_keg, function(result){
		console.log(result);
		if(result.success==1){
			$('#prov-dialog').modal('show');
			if(result.cek_keg==1) $('#cek_keg').attr('class','fa fa-check-square-o');
			if(result.cek_var==1) $('#cek_var').attr('class','fa fa-check-square-o');
			if(result.cek_ind==1) $('#cek_ind').attr('class','fa fa-check-square-o');
			$('#cek_catatan').text(result.cek_catatan);
			$('#cek_pemeriksa').text(result.cek_pemeriksa);
			$('#cek_judul').text(judul_kegiatan);
		}
	},'json');

});
</script>
