<div class="box box-default <?php if($file) echo 'collapsed-box';?>" style="margin-bottom:0">
    <div class="box-header with-border">
        <h3 class="box-title">Log Files</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <div class="box-body" id='logs'>
        <?php foreach(array_reverse(glob(APPPATH.'/logs/*.php')) as $f) {
	    echo '<li>'.substr(basename($f),0,-4).'</li>';
        } ?>
    </div>
</div>


<?php

if($file){
	echo '<pre>';
	readfile(APPPATH.'/logs/'.$file.'.php');
	echo '</pre>';
	echo anchor('site/error_log/'.$file.'/clear', '<i class="fa fa-trash"></i>', array('class'=>'pull-right','confirm'=>'Are you sure?','title'=>'Hapus log file ini'));
}
?>

<style>
	pre {
		height: 800px;
		overflow: scroll;
	}
</style>

<script>
	var url = '<?=base_url('site/error_log');?>';
	$('#logs li').each(function(){
		$(this).html('<a href="'+url+'/'+$(this).text()+'">'+$(this).text()+'</a>');
	});

	$('a[confirm]').click(function(e){
		e.preventDefault();
		if(confirm($(this).attr('confirm'))) location.href=$(this).attr('href');
	});

</script>