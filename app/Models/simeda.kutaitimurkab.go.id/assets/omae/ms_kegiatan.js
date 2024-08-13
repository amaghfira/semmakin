$('li').each(function(){
	var key = $(this).find('span').text().substr(2);
	$(this).attr('key',key);
});

$('input[list-item]').blur(function(){
	$(this).removeClass('error');
	$(this).parent().parent().find('li').removeClass('selected');

	var val = $(this).val();
	if(val){
		var li = $(this).parent().parent().find('li[key='+val+']');

		if(li.text()) li.addClass('selected');
		else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
});

$('input[multi-item]').blur(function(){
	$(this).removeClass('error');
	$(this).parent().parent().find('li').removeClass('selected');

	var val = $(this).val();

	if(val>=32) {
		var li = $(this).parent().parent().find('li[key=32]');
		if(li.text()) {
			li.addClass('selected');
			val = val-32;
		} else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
	if(val>=16) {
		var li = $(this).parent().parent().find('li[key=16]');
		if(li.text()) {
			li.addClass('selected');
			val = val-16;
		} else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
	if(val>=8) {
		var li = $(this).parent().parent().find('li[key=8]');
		if(li.text()) {
			li.addClass('selected');
			val = val-8;
		} else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
	if(val>=4) {
		var li = $(this).parent().parent().find('li[key=4]');
		if(li.text()) {
			li.addClass('selected');
			val = val-4;
		} else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
	if(val>=2) {
		var li = $(this).parent().parent().find('li[key=2]');
		if(li.text()) {
			li.addClass('selected');
			val = val-2;
		} else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
	if(val>=1) {
		var li = $(this).parent().parent().find('li[key=1]');
		if(li.text()) {
			li.addClass('selected');
			val = val-1;
		} else {
			alert('Input di luar range isian');
			$(this).addClass('error').val('').focus();
			return;
		}
	}
});

$('input[ya-tidak]').blur(function(){
	var val = $(this).val();
	$(this).parent().parent().find('span').each(function(){
		var key = $(this).text().substr(-1);
		if(key==val) $(this).addClass('selected');
		else $(this).removeClass('selected');
	});
});

$('input').each(function(){
	$(this).focus().blur();
});

$('body input:first-child').focus();

$('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        var inputs = $(this).parents("form").eq(0).find(":input");
        if (inputs[inputs.index(this) + 1] != null) {                    
            inputs[inputs.index(this) + 1].focus();
        }
        e.preventDefault();
        return false;
    }
});