<?php 
  $assets = '/assets';

  $this->ci =& get_instance();
  $this->ci->load->config('google');
  $is_google = $this->ci->config->item('is_active');
  $redirectUri = $this->ci->config->item('redirectUri');
?><!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <meta name="description" content="Sistem Informasi Metadata Kutai Timur">
  <meta name="author" content="Diskominfo Kutai Timur">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="<?=$assets;?>/applogo.png">
  <link rel="stylesheet" href="<?=$assets;?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$assets;?>/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=$assets;?>/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=$assets;?>/theme/css/AdminLTE.min.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" style="margin-bottom:0">
    <a href="#">LOGIN <img style="height:30px" src="<?=$assets;?>/applogo.png" alt="App Logo"> <b>SIMEDA</b></a>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">SIMEDA</p>

    <form method="post" action="<?=base_url('login');?>">
      <div class="form-group has-feedback">
        <input id='u' type="text" class="form-control" placeholder="Username" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id='p' type="password" class="form-control" placeholder="Password" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button id='submit' type="submit" class="btn btn-primary btn-block btn-flat btn-small">Sign In</button>
        </div>

        <div class="col-xs-2 pull-right">
          <span class="btn btn-flat btn-small btn-default pull-right" title="Tentang SIMEDA" data-toggle="modal" data-target="#modal-default">
            <i class="fa fa-question-circle"></i>
          </span>
        </div>
        
        <?php if($is_google) { ?>
        <div class="col-xs-1 pull-right">
          <?=anchor($redirectUri,'<i class="fa fa-google-plus"></i>',array('class'=>'btn btn-small pull-right', 'title'=>'Google Sign In'));?>
        </div>
      <?php } ?>
      </div>
    </form>

  </div>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <div class="user-block">
            <img class="img-circle img-bordered-sm" src="http://jatengklik.us.to/omae//assets/theme/img/user7-128x128.jpg">
            <span class="username">Selamat datang di SIMEDA (Sistem Informasi Meta Data)</span>
            <span class="description">Administrator</span>
          </div>
      </div>
      <div class="modal-body">
        <div class="alert alert-dismissible" style="padding-right: 15px;
    text-align: justify;">
            <p>
              SIMEDA adalah rumah metadata statistik sektoral. 
              Aplikasi berbasis website ini digunakan untuk pengelolaan metadata secara elektronik dengan user OPD, BPS dan Diskominfo.
            </p>
            <p>
              SIMEDA digunakan untuk entri kuesioner oleh OPD, pemeriksaan oleh BPS/Diskominfo, serta approval oleh Diskominfo. Proses pemeriksaan dilengkapi dengan tahap pemberian respon dan feedback dari OPD.
            </p>
            <p>
              SIMEDA yang dikumpulkan adalah metadata kegiatan (ms-keg), metadata variabel (ms-var), dan metadata indikator (ms-ind). 
              Tabulasi output SIMEDA bisa digunakan sebagai acuan dalam melakukan pembinaan statistik sektoral dalam pengumpulan metadata.
            </p>
            <hr>
            <p>
              Untuk informasi login (username dan password) silakan menghubungi Dinas Komunikasi dan Informatika (Dinkominfo) masing-masing Kabupaten Kutai Timur.
            </p>
          </div>        
      </div>
    </div>
  </div>
</div>

<script src="<?=$assets;?>/jquery/jquery.min.js"></script>
<script src="<?=$assets;?>/bootstrap/js/bootstrap.min.js"></script>

<script>
    $('form').submit(function(e){
        e.preventDefault();
        $('#submit').prepend('<i class="fa fa-spinner fa-spin"></i> ');
        $.post($(this).attr('action'), {username:$('#u').val(), password:$('#p').val()}, function(data){
            console.log(data);
            if (data.login==true) location.reload();
            else alert(data.message);
            $('#submit i.fa').remove();
        }, 'json');
    });
</script>
</body>
</html>
