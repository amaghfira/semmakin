var blok, field;

var url_check = url2+'/get_check_field';

$.get(url2+'/dialog', function(data){$('#myDialog').html(data);});
$.each(checklist, function(i,v) {$('#'+i).attr('approval',v);});

$('[approval]').each(function(){
	var value = $(this).attr('approval');
	var bgcolor = value==1? 'green' : value==2? 'orange' : value==3? 'red' : '';
	var ikon = value==1? 'check' : value==2? 'info' : value==3? 'exclamation' : 'question';
	$(this).parent().append('<i class="approval fa fa-'+ikon+'" blok="'+$(this).attr('blok')+'" field="'+$(this).attr('id')+'"></i>');
	$(this).attr('disabled',true).css('background','white');
});

$('i.approval').hover(function(){
	var $this = $(this);
	var blok = $(this).attr('blok');
	var field = $(this).attr('field');
	var label = $(this).parent().parent().find('label:first-child').text();
	var data = {id_ms_keg:id_ms_keg, blok:blok, field:field};
	//console.log(url_check+' '+JSON.stringify(data));

	$.post(url_check, data, function(result){
		//console.log(result);
		if(result.success==1){
			$('#approval').val(result.data.checklist);
			$('#feedback').val(result.data.feedback);
			$('#feedback_2').val(result.data.feedback_2);
			$('#respon').val(result.data.respon);			
		} else alert(result.message);
	}, 'json');

	$('#myDialog').dialog({title:label, modal:true, close: function(){
		$('#approval').val('');$('#feedback').val('');$('#feedback_2').val('');$('#respon').val('');
	}});
}, function(){
	$('#myDialog').dialog('close');
});

