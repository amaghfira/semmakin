<?php foreach($this->mskegiatan_model->all($this->session->userdata('userid')) as $row) {
	$status = $this->mskegiatan_model->get_checklist_status($row->id_ms_keg);
	$lock = $row->sedang_verifikasi || $row->approval_on!='0000-00-00 00:00:00'? '<i class="fa fa-lock" title="Data dikunci, sudah approval atau sedang proses verifikasi"></i>' : '';
	$error = $this->mskegiatan_model->get_validasi($row->id_ms_keg)?'<span class="label bg-red" title="Masih ada validasi yang error">Error</span>' : '<span class="label bg-green">Clean</span>';
	$approved = '<span class="label pull-right bg-'.($row->approval_on!='0000-00-00 00:00:00'? 'green' : 'gray').'" title="'.($row->approval_on!='0000-00-00 00:00:00'? 'APPROVED' : 'Belum Approval').'"><i class="fa fa-'.($row->approval_on!='0000-00-00 00:00:00'? 'check' : 'question').'"></i></span>';

	echo '<div class="box"><blockquote key="'.$row->id_ms_keg.'"><judul>'.$row->judul_kegiatan.' ('.$row->tahun.')</judul>'.
    $approved.
	'<small>'.$lock.' &middot; '.$error.' &middot; '.date('d M Y',strtotime($row->created_on)).
	' &middot; <var>'.$this->mskegiatan_model->get_jml_variabel($row->id_ms_keg).' Variabel</var> &middot; <ind>'.$this->mskegiatan_model->get_jml_indikator($row->id_ms_keg).' Indikator</ind> '.
	' &middot; Status : '.
        ($status && $status->kode_0? '<span class="badge bg-gray">'.$status->kode_0.'</span> ':'').
        ($status && $status->kode_1? '<span class="badge bg-green">'.$status->kode_1.'</span> ':'').
        ($status && $status->kode_2? '<span class="badge bg-orange">'.$status->kode_2.'</span> ':'').
        ($status && $status->kode_3? '<span class="badge bg-red">'.$status->kode_3.'</span> ':'').
        '<a href="#" key="'.$this->mskegiatan_model->get_hash($row->id_ms_keg).'"><i class="fa fa-download"></i></a>'.
    '</small></blockquote></div>';
} ?>

<?=anchor('ms_kegiatan/add','<i class="fa fa-plus-circle"></i> Input Baru',array('class'=>'btn btn-default btn-flat btn-sm pull-right'));?>

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
    blockquote {border-left: 3px solid #00c0ef80; border-bottom: 1px solid #00c0ef40}
	.badge, .label {cursor:help;}
</style>

<script>
$('blockquote[key]').each(function(){
	var key = $(this).attr('key');
	$(this).find('judul').html('<a href="<?=base_url('ms_kegiatan/edit/');?>'+key+'">'+$(this).find('judul').text()+'</a>');
	$(this).find('var').html('<a href="<?=base_url('ms_variabel/edit/');?>'+key+'">'+$(this).find('var').text()+'</a>');
	$(this).find('ind').html('<a href="<?=base_url('ms_indikator/edit/');?>'+key+'">'+$(this).find('ind').text()+'</a>');
});
	$('.badge.bg-gray').attr('title','Menunggu verifikasi');
	$('.badge.bg-green').attr('title','Verifikasi : Sesuai');
	$('.badge.bg-orange').attr('title','Verifikasi : Terisi, tapi belum sesuai');
	$('.badge.bg-red').attr('title','Verifikasi : Belum terisi');

	$('a[key]').click(function(){
        window.open('<?=base_url('pdf/');?>'+$(this).attr('key'));
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
	
</script>