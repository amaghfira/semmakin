var blok, field;

var url_approval = url+'/approval';
var url_check = url+'/get_check_field';

$.get(url+'/dialog', function(data){$('#myDialog').html(data);});

$.each(checklist, function(i,v) {$('#'+i).attr('approval',v);});

$('[approval]').each(function(){
	var value = $(this).attr('approval');
	var bgcolor = value==1? 'green' : value==2? 'orange' : value==3? 'red' : 'skyblue';
	$(this).css('color','white').css('background',bgcolor);
});

$('[approval]').click(function(){
	var label = $(this).parent().parent().find('label:first-child').text();

	$('#myDialog').dialog({title:label, modal:true, close: function(){
		$('#blok').val('');$('#field').val('');$("input[type='radio']").removeAttr('checked');$('#feedback').val('');$('#respon').val('');
		$(this).find('i.fa-spinner').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-save');
	}});

	blok = $(this).attr('blok');
	field = $(this).attr('id');
	var value = $(this).attr('approval');

	$.post(url_check, {id_ms_keg:id_ms_keg, blok:blok, field:field}, function(result){
		console.log(result);
		if(result.success==1 && result.data){
			$('#approval_'+value).attr('checked','checked');
			$('#feedback').val(result.data.feedback);
			$('#feedback_2').val(result.data.feedback_2);
			$('#respon').val(result.data.respon);			
			if(approved) {
				$('#approval_*').attr('disabled',true);
				$('#feedback').attr('disabled',true);
				$('#feedback_2').attr('disabled',true);
				$('#submit').hide();
			}
		} else if(result.success===0) alert(result.message);
	}, 'json');

	if(!approved){
	    $('#submit').click(function(){
		$(this).find('i.fa-save').removeClass('fa-save').addClass('fa-spinner').addClass('fa-spin');
		var data = {
			id_ms_keg :id_ms_keg,
			blok : blok,
			field : field,
			value : $("input[type='radio']:checked").val(),
			feedback : $('#feedback').val(),
			feedback_2 : $('#feedback_2').val(),
		};
		console.log(data);

		$.post(url_approval,data,function(result){
			console.log(result);
			if(result.success==1){
				var value = $("input[type='radio']:checked").val();
				var bgcolor = value==1? 'green' : value==2? 'orange' : value==3? 'red' : 'skyblue';
				$('#'+result.field).css('color','white').css('background',bgcolor);			
				$('#myDialog').dialog('close');
			} else 
				alert(result.message);
		},'json');

	    });	
        }	
});

