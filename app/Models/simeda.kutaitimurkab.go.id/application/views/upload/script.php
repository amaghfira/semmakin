<?php if(!$this->session->has_userdata('bearer') || !$this->session->userdata('bearer')){ ?>
var bearer = null;
get_bearer();
<?php } else { ?>
var bearer = '<?=$this->session->userdata('bearer');?>';
<?php } ?>

$('tbody tr').each(function(){
    var id_ms_keg = $(this).attr('id_ms_keg');
    
	var app = $(this).find('td:nth-child(2)');
	if(app.attr('cek')=='1') app.html('<i class="fa fa-check-square-o"></i>');

	var cek = $(this).find('td:nth-child(3)');
	if(cek.attr('cek')=='1') cek.html('<i class="fa fa-check-square-o"></i>');
	else cek.html('<a href="<?=base_url('v_provinsi/edit/');?>'+id_ms_keg+'" target="_ver"><i class="fa fa-question-circle"></i></a>');
	
	var mskeg = $(this).find('td:nth-child(4)');
	if(app.attr('cek')=='1'){
	if(mskeg.attr('cek')=='1') mskeg.html('<i class="fa fa-check-square-o"></i>');
	else mskeg.html('<i class="fa fa-sign-out"></i>');
	

	var msvar = $(this).find('td:nth-child(5)');
	if(msvar.attr('cek')=='1') msvar.prepend('<i class="fa fa-check-square-o"></i> <br> ');
	else if(msvar.attr('cek')=='2') msvar.prepend('<i class="fa fa-sign-out"></i> <br> ');
	else msvar.html('-');

	var msind = $(this).find('td:nth-child(6)');
	if(msind.attr('cek')=='1') msind.prepend('<i class="fa fa-check-square-o"></i> <br> ');
	else if(msind.attr('cek')=='2') msind.prepend('<i class="fa fa-sign-out"></i> <br> ');
	else msind.html('-');
	}
	
});

$('tbody tr td i.fa-sign-out').click(function(){
    if(bearer===null)
        get_bearer();
        
	var tr = $(this).closest('tr');
	var id_ms_keg = tr.attr('id_ms_keg');
	var id_indah = tr.attr('id_indah');
	var pic = tr.attr('pic');
	var kolom = $(this).parent().index();
	var judul = $('thead tr').find('th:nth-child('+(kolom+1)+')').text();

    if(pic>0 && confirm("Konfirmasi Upload Data")){
	    var title = $(this).closest('tr').find('td:first-child').html();
	    $('#popup-modal').modal('show');
	    $('.user-block').html(title);
        $('.modal-body').html('');
		$('.modal-body').append('<div><i> <p class="text-center text-danger">(Mohon tunggu hingga seluruh data terupload di website Indah BPS)</p></i></div>');

	    if(kolom==3) upload_keg(id_ms_keg);
	    if(kolom==4) upload_var(id_ms_keg, id_indah);
	    if(kolom==5) upload_ind(id_ms_keg, id_indah);
    }
});


function get_bearer()
{
    $.ajax({
         type: "GET",
         url: "<?=base_url('upload/credential');?>", 
         success: function(output, status, xhr) { 
            var settings = {
              "url": "https://indah-api.bps.go.id/api/authenticate",
              "method": "POST",
              "timeout": 0,
              "headers": { "Content-Type": "application/json" },
              "data": output, 
            };
            
            $.ajax(settings).done(function (response) {
              bearer = response.token;
              $.post('<?=base_url('upload/set_bearer');?>', {bearer:response.token}, function(){});
            });
        }
    });
}

function upload_keg(id_ms_keg)
{
    console.log('ms_keg : ' + id_ms_keg);
	$('.modal-body').append('<div id="up_keg"><i class="fa fa-spinner fa-spin"></i> Upload MS Kegiatan</div>');
	$.ajax({
     type: "GET",
     url: "<?=base_url('payload/mskeg/'.$id_wilayah);?>/" + id_ms_keg, 
     success: function(output, status, xhr) { 
         if(status=='success'){
         	if(output){
         		var settings = {
         		  "url": "https://indah-api.bps.go.id/sdi/v2/metadata-statistik/kegiatan",
         		  "method": "POST",
         		  "timeout": 0,
         		  "headers": {
         		    "Content-Type": "application/json",
					"Access-Control-Allow-Origin" : "https://simeda.kutaitimurkab.go.id",
         		    "Authorization": "Bearer " + bearer,
					"Sec-Fetch-Site": "same-site"
         		  },
         		  "data": JSON.stringify(output)
         		};

         		$.ajax(settings).done(function (response) {
         		  console.log(response.status);
         		  if(response.status==200 && response.result[0].id!==undefined)
         		  		var id_indah = response.result[0].id;
         		  		$.ajax({
     								type: "GET",
     								url: "<?=base_url('upload/set_mskeg/'.$id_wilayah);?>/" + id_ms_keg + '/' + id_indah,
     								success: function(output, status, xhr) {
     									upload_var(id_ms_keg,id_indah);
     								}
     							});

									$('#up_keg').html('<i class="fa fa-check"></i> MS Kegiatan uploaded');
     							$('tbody tr[id_ms_keg='+id_ms_keg+']').attr('id_indah',id_indah).find('td:nth-child(4)').html('<i class="fa fa-check-square-o"></i>');
         		});

         	}
         	else {
         		console.log('mskeg is empty');
         		$('#up_keg').html('<i class="fa fa-ban"></i> MS Kegiatan is empty')
         	}
         }
     },
     error: function(output) {
          console.log("Error in API call");
          alert("Error in API call");
     }
  });
}

function upload_var(id_ms_keg,id_indah)
{
	$('.modal-body').append('<div id="up_var"><i class="fa fa-spinner fa-spin"></i> Upload MS Variabel</div>');
	$.ajax({
     type: "GET",
     url: "<?=base_url('payload/msvar/'.$id_wilayah);?>/" + id_ms_keg, 
     success: function(output, status, xhr) { 
         if(status=='success'){
         	if(output){
				var outputLength = output.length;
         		$.each(output, function(i,payload){
//     		        console.log('ms_var : ' + id_ms_keg + ' #'+i);
         			var settings = {
         			  "url": "https://indah-api.bps.go.id/sdi/v2/metadata-statistik/variabel",
         			  "method": "POST",
         			  "timeout": 4000,
         			  "headers": {
         			    "Content-Type": "application/json",
         			    "Authorization": "Bearer " + bearer
         			  },
         			  "data": JSON.stringify(payload[1]),
         			};


         			$.ajax(settings).done(function (response) {
         			  console.log(id_ms_keg + '/' + payload[0].id_var + '/' + response.result[0].id);
		      		  if(response.status==200 && response.result[0].id!==undefined)
		      		  		$.ajax({
		  								type: "GET",
		  								url: "<?=base_url('upload/set_msvar/'.$id_wilayah);?>/" + id_ms_keg + '/' + payload[0].id_var + '/' + response.result[0].id,
		  							});

						if (i === outputLength - 1) {
						$('#up_var').html('<i class="fa fa-check"></i> MS Variabel uploaded');
						$('tbody tr[id_ms_keg='+id_ms_keg+']').find('td:nth-child(5)').html('<i class="fa fa-check-square-o"></i>');
                    }
         			}).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX Request Failed: " + textStatus + ", " + errorThrown);

            // Jika respons gagal, Anda dapat mencoba lagi
			
            retryAjax(settings,id_ms_keg,payload,i,outputLength);
        });	 
         		});

						upload_ind(id_ms_keg,id_indah);
         	}
         	else {
         		console.log('msvar is empty');
         		$('#up_var').html('<i class="fa fa-ban"></i> MS Variabel is empty')
         	}
         }
     },
     error: function(output) {
          console.log("Error in API call");
          alert("Error in API call");
     }
  });
}

function retryAjax(settings,id_ms_keg,payload,i,outputLength) {
    console.log("Retrying AJAX request...");

    // Coba lagi setelah beberapa detik
    setTimeout(function() {
        $.ajax(settings)
            .done(function(response) {
                console.log(id_ms_keg + '/' + payload[0].id_var + '/' + response.result[0].id);
                if (response.status == 200 && response.result[0].id !== undefined)
                    $.ajax({
                        type: "GET",
                        url: "<?=base_url('upload/set_msvar/' . $id_wilayah);?>/" + id_ms_keg + '/' + payload[0].id_var + '/' + response.result[0].id,
                    });
				if (i === outputLength - 1) {
						$('#up_var').html('<i class="fa fa-check"></i> MS Variabel uploaded');
						$('tbody tr[id_ms_keg='+id_ms_keg+']').find('td:nth-child(5)').html('<i class="fa fa-check-square-o"></i>');
                    }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Request Failed: " + textStatus + ", " + errorThrown);
				retryAjax(settings,id_ms_keg,payload,i,outputLength);
                // Jika gagal lagi, Anda dapat menyesuaikan strategi percobaan lagi atau menangani kasus kesalahan dengan cara lain.
            });
    }, 10000); // Menunggu 10 detik sebelum mencoba lagi
}

function retryInd(settings,id_ms_keg,payload) {
    console.log("Retrying AJAX request...");

    // Coba lagi setelah beberapa detik
    setTimeout(function() {
        $.ajax(settings).done(function (response) {
         			  console.log(+ id_ms_keg + '/' + payload[0].id_ind + '/' + response.result[0].id);
		      		  if(response.status==200 && response.result[0].id!==undefined)
		      		  		$.ajax({
		  								type: "GET",
		  								url: "<?=base_url('upload/set_msind/'.$id_wilayah);?>/" + id_ms_keg + '/' + payload[0].id_ind + '/' + response.result[0].id,
		  							});
         			})
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Request Failed: " + textStatus + ", " + errorThrown);
				retryInd(settings,id_ms_keg,payload);
                // Jika gagal lagi, Anda dapat menyesuaikan strategi percobaan lagi atau menangani kasus kesalahan dengan cara lain.
            });
    }, 10000); // Menunggu 10 detik sebelum mencoba lagi
}

function upload_ind(id_ms_keg,id_indah)
{
	$('.modal-body').append('<div id="up_ind"><i class="fa fa-spinner fa-spin"></i> Upload MS Indikator</div>');
	$.ajax({
     type: "GET",
     url: "<?=base_url('payload/msind/'.$id_wilayah);?>/" + id_ms_keg, 
     success: function(output, status, xhr) { 
         if(status=='success'){
         	if(output){
         		$.each(output, function(i,payload){
//     		        console.log('ms_ind : ' + id_ms_keg + ' #'+i);
         			var settings = {
         			  "url": "https://indah-api.bps.go.id/sdi/v2/metadata-statistik/indikator",
         			  "method": "POST",
         			  "timeout": 4000,
         			  "headers": {
         			    "Content-Type": "application/json",
         			    "Authorization": "Bearer " + bearer
         			  },
         			  "data": JSON.stringify(payload[1]),
         			};


         			$.ajax(settings).done(function (response) {
         			  console.log(response);
		      		  if(response.status==200 && response.result[0].id!==undefined)
		      		  		$.ajax({
		  								type: "GET",
		  								url: "<?=base_url('upload/set_msind/'.$id_wilayah);?>/" + id_ms_keg + '/' + payload[0].id_ind + '/' + response.result[0].id,
		  							});
         			}).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX Request Failed: " + textStatus + ", " + errorThrown);

            // Jika respons gagal, Anda dapat mencoba lagi
            retryInd(settings,id_ms_keg,payload);
        });	
         			 
         		});

						$('#up_ind').html('<i class="fa fa-check"></i> MS Indikator uploaded');
						$('tbody tr[id_ms_keg='+id_ms_keg+']').find('td:nth-child(6)').html('<i class="fa fa-check-square-o"></i>');

         	}
         	else {
         		console.log('msind is empty');
         		$('#up_ind').html('<i class="fa fa-ban"></i> MS Indikator is empty')
         	}
         }
     },
     error: function(output) {
          console.log("Error in API call");
          alert("Error in API call");
     }
  });
}

