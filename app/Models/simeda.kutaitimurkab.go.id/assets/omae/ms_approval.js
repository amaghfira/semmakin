var blok, field;

var url_approval = url+'/approval';
var url_check = url+'/get_check_field';

$.get(url+'/approval_dialog', function(data){$('#myDialog').html(data);});
$.each(checklist, function(i,v) {$('#'+i).attr('approval',v);});

$('[approval]').each(function(){
	var value = $(this).attr('approval');

	var bgcolor = value==1? 'green' : value==2? 'orange' : value==3? 'red' : '';
	var ikon = value==1? 'check' : value==2? 'info' : value==3? 'exclamation' : 'question';

	$(this).parent().append('<i class="approval fa fa-'+ikon+'" blok="'+$(this).attr('blok')+'" field="'+$(this).attr('id')+'"></i>');
	if(value==1 || disabled) $(this).attr('disabled',true).attr('title','Untuk perbaikan data, silakan hubungi Verifikator/Walidata untuk diubah flag-nya');
});

$('i.approval').click(function(){
	var $this = $(this);
	var blok = $(this).attr('blok');
	var field = $(this).attr('field');
	var label = $(this).parent().parent().find('label:first-child').text();

	$.post(url_check, {id_ms_keg:id_ms_keg, blok:blok, field:field}, function(result){
		console.log(result);
		if(result.success==1){
			$('#blok').val(blok);
			$('#field').val(field);
			$('#approval').val(result.data.checklist);
			$('#feedback').val(result.data.feedback);
			$('#feedback_2').val(result.data.feedback_2);
			$('#respon').val(result.data.respon);			

			if(result.data.checklist==1 || disabled){
				$('#respon').attr('disabled',true);
				$('#submit').hide();
			}else{
				$('#respon').removeAttr('disabled');
				$('#submit').show();				
			}
		} else alert(result.message);
	}, 'json');

	$('#myDialog').dialog({title:label, modal:true, close: function(){
		$('#blok').val('');$('#field').val('');$('#approval').val('');$('#feedback').val('');$('#respon').val('');
		$(this).find('i.fa-spinner').removeClass('fa-spinner').removeClass('fa-spin').addClass('fa-save');
	}});

	$('#submit').click(function(){
	    if($('#respon').val() && !disabled){
    		$(this).find('i.fa-save').removeClass('fa-save').addClass('fa-spinner').addClass('fa-spin');
    		var data = {
    			id_ms_keg :id_ms_keg,
    			blok : $('#blok').val(),
    			field : $('#field').val(),
    			respon : $('#respon').val()
    		};
    		console.log(data)
    		$.post(url_approval,data,function(result){
    			console.log(result);
    			if(result.success==1){
    				$this.css('color','#999').css('background','#fff').attr('class','approval fa fa-question');			
    				$('#myDialog').dialog('close');
    			} else 
    				alert(result.message);
    		},'json');
	    } else 
		alert('Respon belum terisi');

	});		
});

if(disabled)
  $('#submit').hide().remove();
