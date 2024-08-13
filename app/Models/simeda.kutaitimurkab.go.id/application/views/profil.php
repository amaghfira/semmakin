<?php $arr_role = array('1'=>'Dinas/Instansi/OPD', '2'=>'BPS / Verifikator', '3'=>'Dinkominfo / Walidata', '9'=>'Administrator', '0'=>'Silakan kontak Administrator'); ?>
<div class="box box-primary">
    <div class="box-body box-profile">
      <img class="profile-user-img img-responsive img-circle" src="<?=$this->session->userdata('foto');?>" alt="User profile picture">
    
      <h3 class="profile-username text-center"><?=$this->session->userdata('username');?></h3>
    
      <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
          <b>Nama Instansi</b> <a class="pull-right"><?=$this->session->userdata('instansi');?></a>
        </li>
        <li class="list-group-item">
          <b>Wilayah</b> <a class="pull-right"><?=$this->wilayah_model->get_by_id($this->session->userdata('id_wilayah'))->wilayah;?></a>
        </li>
        <li class="list-group-item">
          <b>Role</b> <a class="pull-right"><?=$arr_role[$this->session->userdata('role')];?></a>
        </li>
      </ul>
    
      <button class="btn btn-default pull-right" data-toggle="modal" data-target="#modal-default"><i class="fa fa-lock"></i> Ganti Password</button>
    </div>
</div>

<div class="modal fade in" id="modal-default">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Ganti Password</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="password" id="pass" class="form-control" placeholder="Password Baru" style="text-align:center" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="word" class="form-control" placeholder="Konfirmasi Password" style="text-align:center">
                </div>
            </div>
            <div class="modal-footer">
                <div class='pull-left' id="message"></div>
                <button id="save" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#save').click(function(){
        if(!$('#pass').val() || !$('#word').val())
             $('#message').css('color','red').text('Password/Konfirmasi kosong');
        else if($('#pass').val()!=$('#word').val())
            $('#message').css('color','red').text('Password/Konfirmasi tidak sesuai');
        else if($('#pass').val()==$('#word').val()) {
            $('#message').html('<i class="fa fa-spinner fa-spin"></i>');
            $('body').append('<form method="post">');
            $('body form').append('<input type="hidden" name="password" value="'+$('#word').val()+'">').submit();
        }
    });
</script>

<pre><?php print_r($this->session->userdata());?></pre>