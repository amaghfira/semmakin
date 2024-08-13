<?php foreach($this->mskegiatan_model->all_by_wilayah($this->session->userdata('id_wilayah')) as $row){
	$approved = substr($row->approval_on,0,4)!='0000'? '<span class="label bg-green pull-right"><i class="fa fa-check"></i></span>' : '<span class="label bg-gray pull-right"><i class="fa fa-question"></i></span>';
	$error = $this->mskegiatan_model->get_validasi($row->id_ms_keg)?'<span class="label bg-red" title="Masih ada validasi yang error">Error</span>' : '<span class="label bg-green">Clean</span>';
	echo '<div class="box"><blockquote key="'.$row->id_ms_keg.'" title="'.$row->instansi.'"><judul>'.$row->judul_kegiatan.' ('.$row->tahun.')</judul>'.
    $approved.
	'<small>'.$error.' &middot; '.date('d M Y',strtotime($row->created_on)).
	' &middot; <var>'.$this->mskegiatan_model->get_jml_variabel($row->id_ms_keg).' Variabel</var> &middot; <ind>'.$this->mskegiatan_model->get_jml_indikator($row->id_ms_keg).' Indikator</ind> '.
	' &middot; Status : '.(substr($row->approval_on,0,4)!='0000'? 'APPROVED' : 'Menunggu Approval').'</small></blockquote></div>';
} ?>

<style>
    blockquote {border-left: 3px solid #00c0ef80; border-bottom: 1px solid #00c0ef40}
</style>

<script>
$('blockquote[key]').each(function(){
	var key = $(this).attr('key');
	$(this).find('judul').html('<a href="<?=base_url('approval/view/');?>'+key+'/7">'+$(this).find('judul').text()+'</a>');
});
</script>