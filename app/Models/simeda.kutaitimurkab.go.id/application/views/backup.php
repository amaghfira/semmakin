<div class="box box-info">
<table id="backup" class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Filename</th>
			<th>Size</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php $i=1;
	foreach(array_reverse(glob($this->backup_dir.'/*.zip')) as $file){
		if(substr($file,0,1)!='.'){
			echo "<tr><td>".($i++)."</td>".
				"<td>".basename($file)."</td>".
				"<td>".human_filesize($file)."</td>".
				"<td></td></tr>\n";
		}
	} ?>
	</tbody>
</table>
</div>

<?=anchor('backup/create','<i class="fa fa-cloud-upload"></i> Create Backup',array('class'=>'btn btn-primary pull-right'));?>

<style>
tr th:first-child {width:30px;text-align:center;}
tr th:last-child {width:60px;}
tr td:first-child, tr td:last-child {text-align:center;}
</style>

<script>
var base_url 	= '<?=base_url('backup');?>';
$('#backup tr').each(function(){
	var filename 	= $(this).find('td:nth-child(2)').text();
	$(this).find('td:last-child')
		.html($('<a>').attr('title','Download')
				.attr('href',base_url+'/get/'+filename)
				.html('<i>').attr('class','fa fa-arrow-down'))
		.append('&nbsp;')
		.append($('<a>').attr('title','Delete').attr('confirm','Are you realy sure?')
				.attr('href',base_url+'/del/'+filename)
				.html('<i>').attr('class','fa fa-ban'));
});
$('a[confirm]').click(function(){
	return confirm($(this).attr('confirm'));
});
</script>

<?php
function human_filesize($file, $precision = 0) {
	$size = filesize($file);
    for($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {}
    return round($size, $precision).' '.['B','kB','MB','GB','TB','PB','EB','ZB','YB'][$i];
}
?>	