<?php
$sql = "select k.id_ms_keg,count(*) as t, sum(case when v.id_indah>0 then 1 end) as r from omae_ms_var v join omae_ms_keg k on k.id_ms_keg=v.id_ms_keg where k.id_wilayah='".$id_wilayah."' group by k.id_ms_keg";
foreach($this->db->query($sql)->result() as $r){
	$var[$r->id_ms_keg]=array('t'=>$r->t, 'r'=>$r->r?$r->r:0);
}

$sql = "select k.id_ms_keg,count(*) as t, sum(case when i.id_indah>0 then 1 end) as r from omae_ms_ind i join omae_ms_keg k on k.id_ms_keg=i.id_ms_keg where k.id_wilayah='".$id_wilayah."' group by k.id_ms_keg";
foreach($this->db->query($sql)->result() as $r){
	$ind[$r->id_ms_keg]=array('t'=>$r->t, 'r'=>$r->r?$r->r:0);
}

$sql = "select k.id_ms_keg,cek_keg from omae_cek_provinsi c join omae_ms_keg k on k.id_ms_keg=c.id_ms_keg where k.id_wilayah='".$id_wilayah."' order by k.id_ms_keg";
foreach($this->db->query($sql)->result() as $r){
	$cek[$r->id_ms_keg]=$r->cek_keg;
}

?>
<div class="box box-body">
<table class="table">
	<thead>
		<tr>
			<th>Judul Kegiatan</th>
			<th>Cek Prov</th>
			<th>MS-KEG</th>
			<th>MS-VAR</th>
			<th>MS-IND</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($this->mskeg->all_by_wilayah($id_wilayah) as $row) {
    $pic = $id_wilayah!='3300'? 1 : ($row->created_by?'1':'0');
	$v = isset($var[$row->id_ms_keg])?$var[$row->id_ms_keg]:null;
	$i = isset($ind[$row->id_ms_keg])?$ind[$row->id_ms_keg]:null;
	echo "<tr id_ms_keg='".$row->id_ms_keg."' id_indah='".$row->id_indah."' pic='".$pic."'>".
	"<td><small>".$row->instansi."</small><br>".$row->judul_kegiatan.($id_wilayah=='3300' && $row->created_by? "<br><small><i class='fa fa-comments-o'></i> ".$row->created_by."</small>" : "")."</td>".
	"<td cek=".(!empty($cek[$row->id_ms_keg]) && $cek[$row->id_ms_keg]=='1'? '1' : '0')."></td>".
	"<td cek=".($row->id_indah? '1' : '2')."></td>".
	"<td cek=".(!$v? '0' : ($v['t']>0 && $v['t']==$v['r']? '1' : '2'))."><small>".$v['r']." of ".$v['t']."</small></td>". 
	"<td cek=".(!$i? '0' : ($i['t']>0 && $i['t']==$i['r']? '1' : '2'))."><small>".$i['r']." of ".$i['t']."</small></td>". 
	"</tr>\n";
} ?>	
	</tbody>
</table>
</div>

<style>
	td small {font-style: italic;}
	td i.fa {font-size: small;}
	td i.fa-sign-out {cursor: pointer;}
	td i.fa-check-square-o {color: limegreen;}

	thead tr th {position: sticky; top: 0}
	tbody tr:hover {background: #eee;}
</style>

<script>
$('tbody tr').each(function(){
    var id_ms_keg = $(this).attr('id_ms_keg');
    
	var cek = $(this).find('td:nth-child(2)');
	if(cek.attr('cek')=='1') cek.html('<i class="fa fa-check-square-o"></i>');
	else cek.html('<a href="<?=base_url('v_provinsi/edit/');?>'+id_ms_keg+'" target="_ver"><i class="fa fa-question-circle"></i></a>');
	
	var mskeg = $(this).find('td:nth-child(3)');
	if(mskeg.attr('cek')=='1') mskeg.html('<i class="fa fa-check-square-o"></i>');
	else mskeg.html('<i class="fa fa-sign-out"></i>');

	var msvar = $(this).find('td:nth-child(4)');
	if(msvar.attr('cek')=='1') msvar.prepend('<i class="fa fa-check-square-o"></i> <br> ');
	else if(msvar.attr('cek')=='2') msvar.prepend('<i class="fa fa-sign-out"></i> <br> ');
	else msvar.html('-');

	var msind = $(this).find('td:nth-child(5)');
	if(msind.attr('cek')=='1') msind.prepend('<i class="fa fa-check-square-o"></i> <br> ');
	else if(msind.attr('cek')=='2') msind.prepend('<i class="fa fa-sign-out"></i> <br> ');
	else msind.html('-');
	
});

$('tbody tr td i.fa-sign-out').click(function(){
	var tr = $(this).closest('tr');
	var id_ms_keg = tr.attr('id_ms_keg');
	var id_indah = tr.attr('id_indah');
	var pic = tr.attr('pic');
	var kolom = $(this).parent().index();
	var judul = $('thead tr').find('th:nth-child('+(kolom+1)+')').text();

    if(pic>0 && id_indah && confirm("Konfirmasi reUpload Data")){
	    var title = $(this).closest('tr').find('td:first-child').html();
	    $('#popup-modal').modal('show');
	    $('.user-block').html(title);
        $('.modal-body').html('');

	    if(kolom==2) upload_keg(id_ms_keg, id_indah);
	    if(kolom==3) upload_var(id_ms_keg, id_indah);
	    if(kolom==4) upload_ind(id_ms_keg, id_indah);
    }
});

</script>

<div class="modal fade" id="popup-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      	  <span aria-hidden="true">&times;</span></button>
          <div class="user-block"></div>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<script>
var bearer;
$.get('<?=base_url('upload/get_bearer');?>', function(result){
   bearer = result; 
});
function upload_keg(id_ms_keg, id_indah)
{
	$('.modal-body').append('<div id="up_keg"><i class="fa fa-spinner fa-spin"></i> Upload MS Kegiatan</div>');
	$.ajax({
     type: "GET",
     url: "<?=base_url('payload/mskeg/'.$id_wilayah);?>/" + id_ms_keg, 
     success: function(output, status, xhr) { 
         if(status=='success'){
         	if(output){
         	    output.status = "DRAFT";
         		var settings = {
                  "url": "https://indah-api.bps.go.id/sdi/metadata-kegiatan/" + id_indah,
                  "method": "PUT",
         		  "timeout": 0,
         		  "headers": {
         		    "Content-Type": "application/json",
         		    "Authorization": "Bearer " + bearer
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
//     									upload_var(id_ms_keg,id_indah);
     								}
     							});

									$('#up_keg').html('<i class="fa fa-check"></i> MS Kegiatan uploaded');
     							$('tbody tr[id_ms_keg='+id_ms_keg+']').attr('id_indah',id_indah).find('td:nth-child(3)').html('<i class="fa fa-check-square-o"></i>');
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
         		$.each(output, function(i,payload){
         			var settings = {
         			  "url": "https://indah-api.bps.go.id/sdi/metadata-statistik-kegiatan/"+id_indah+"/metadata-statistik-variabel/",
         			  "method": "POST",
         			  "timeout": 0,
         			  "headers": {
         			    "Content-Type": "application/json",
         			    "Authorization": "Bearer " + bearer
         			  },
         			  "data": JSON.stringify(payload),
         			};


         			$.ajax(settings).done(function (response) {
         			  console.log(response);
		      		  if(response.status==200 && response.result[0].id!==undefined)
		      		  		$.ajax({
		  								type: "GET",
		  								url: "<?=base_url('upload/set_msvar/'.$id_wilayah);?>/" + id_ms_keg + '/' + payload.id_var + '/' + response.result[0].id,
		  							});
         			});
         			 
         		});

						$('#up_var').html('<i class="fa fa-check"></i> MS Variabel uploaded');
						$('tbody tr[id_ms_keg='+id_ms_keg+']').find('td:nth-child(4)').html('<i class="fa fa-check-square-o"></i>');

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
         			var settings = {
         			  "url": "https://indah-api.bps.go.id/sdi/metadata-statistik-kegiatan/"+id_indah+"/metadata-statistik-indikator/",
         			  "method": "POST",
         			  "timeout": 0,
         			  "headers": {
         			    "Content-Type": "application/json",
         			    "Authorization": "Bearer " + bearer
         			  },
         			  "data": JSON.stringify(payload),
         			};


         			$.ajax(settings).done(function (response) {
         			  console.log(response);
		      		  if(response.status==200 && response.result[0].id!==undefined)
		      		  		$.ajax({
		  								type: "GET",
		  								url: "<?=base_url('upload/set_msind/'.$id_wilayah);?>/" + id_ms_keg + '/' + payload.id_ind + '/' + response.result[0].id,
		  							});
         			});
         			 
         		});

						$('#up_ind').html('<i class="fa fa-check"></i> MS Indikator uploaded');
						$('tbody tr[id_ms_keg='+id_ms_keg+']').find('td:nth-child(5)').html('<i class="fa fa-check-square-o"></i>');

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

</script>