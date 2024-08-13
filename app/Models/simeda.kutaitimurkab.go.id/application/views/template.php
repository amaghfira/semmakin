<?php 
$base = '';
$assets = $base.'/assets';
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIMEDA</title>
  <meta name="description" content="SIMEDA">
  <meta name="author" content="Diskominfo Kutim">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="icon" type="image/png" href="<?=$assets;?>/applogo.png">
  <link rel="stylesheet" href="<?=$assets;?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=$assets;?>/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=$assets;?>/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=$assets;?>/theme/css/AdminLTE.css">
  <link rel="stylesheet" href="<?=$assets;?>/theme/css/skins/skin-blue.min.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?=$assets;?>/jquery/jquery.min.js"></script>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url();?>" class="navbar-brand"><i class="fa fa-home"></i> <b>SIMEDA</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if($this->session->userdata('role')>=1) { // OPD ?>            
            <li <?php if($this->router->class=='ms_kegiatan') echo ' class="active"';?>><a href="<?=base_url('ms_kegiatan');?>">Kegiatan</a></li>
            <li <?php if($this->router->class=='ms_variabel') echo ' class="active"';?>><a href="<?=base_url('ms_variabel');?>">Variabel</a></li>
            <li <?php if($this->router->class=='ms_indikator') echo ' class="active"';?>><a href="<?=base_url('ms_indikator');?>">Indikator</a></li>
            <?php } ?>

            <?php if(in_array($this->session->userdata('role'), array(2,3,9))) { // BPS dan Diskominfo?>            
            <li class="dropdown <?php if(substr($this->router->class,0,2)=='v_') echo ' active';?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-commenting-o"></i> Verifikasi <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li<?php if($this->router->class=='v_kegiatan') echo ' class="active"';?>><a href="<?=base_url('v_kegiatan');?>">Kegiatan</a></li>
                <li<?php if($this->router->class=='v_variabel') echo ' class="active"';?>><a href="<?=base_url('v_variabel');?>">Variabel</a></li>
                <li<?php if($this->router->class=='v_indikator') echo ' class="active"';?>><a href="<?=base_url('v_indikator');?>">Indikator</a></li>
<?php if($this->session->userdata('role')=='2' && substr($this->session->userdata('id_wilayah'),2,2)=='00') { ?>
                <li<?php if($this->router->class=='v_provinsi') echo ' class="active"';?>><a href="<?=base_url('v_provinsi');?>">BPS PROVINSI</a></li>
<?php } ?>
              </ul>
            </li>
            <?php } ?>
            <?php if(in_array($this->session->userdata('role'), array(3,9))) { // Diskominfo ?>            
            <li <?php if($this->router->class=='approval') echo ' class="active"';?>><a href="<?=base_url('approval');?>"><i class="fa fa-check-square-o"></i> Approval</a></li>
<!--
            <li class="dropdown <?php if(substr($this->router->class,0,3)=='ap_') echo ' active';?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-check-square-o"></i> Approval <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li<?php if($this->router->class=='ap_kegiatan') echo ' class="active"';?>><a href="<?=base_url('ap_kegiatan');?>">Kegiatan</a></li>
                <li<?php if($this->router->class=='ap_variabel') echo ' class="active"';?>><a href="<?=base_url('ap_variabel');?>">Variabel</a></li>
                <li<?php if($this->router->class=='ap_indikator') echo ' class="active"';?>><a href="<?=base_url('ap_indikator');?>">Indikator</a></li>
              </ul>
            </li>
-->
            <?php } ?>

            <li class="dropdown <?php if($this->router->class=='kamus') echo ' active';?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i> Kamus <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li<?php if($this->router->method=='kegiatan') echo ' class="active"';?>><a href="<?=base_url('kamus/kegiatan');?>">Kamus Kegiatan</a></li>
                <li<?php if($this->router->method=='variabel') echo ' class="active"';?>><a href="<?=base_url('kamus/variabel');?>">Kamus Variabel</a></li>
                <li<?php if($this->router->method=='indikator') echo ' class="active"';?>><a href="<?=base_url('kamus/indikator');?>">Kamus Indikator</a></li>
              </ul>
            </li>

            <?php if(in_array($this->session->userdata('role'), array(2,3,9))) { // Admin ?>            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Report"><i class="fa fa-table"></i> Report <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
            <?php if(in_array($this->session->userdata('role'), array(2,9))) { // Admin ?>            
                <li><a href="<?=base_url('report/wilayah');?>"><i class="fa fa-map-o"></i> Rekap Menurut Wilayah</a></li>
                <li class="divider"></li>
            <?php } ?>
            <?php if($this->session->userdata('role')>1) { // Admin ?>            
                <li><a href="<?=base_url('report/instansi');?>"><i class="fa fa-chevron-right"></i> Rekap Menurut Instansi</a></li>
            <?php } ?>
                <li><a href="<?=base_url('report/pertanyaan');?>"><i class="fa fa-question"></i> Verifikasi Kegiatan Menurut Pertanyaan</a></li>
                <li><a href="<?=base_url('report/feedback_pertama');?>"><i class="fa fa-question"></i> Feedback Pertama Menurut Pertanyaan</a></li>
<!--                <li><a href="#"><i class="fa fa-chevron-right"></i> Verifikasi Variabel Menurut Status</a></li>
                <li><a href="#"><i class="fa fa-chevron-right"></i> Verifikasi Indikator Menurut Status</a></li>
-->
            <?php if($this->session->userdata('role')==2) { // BPS ?>            
                <li class="divider"></li>
                <li><a href="<?=base_url('admin/user');?>"><i class="fa fa-user-o"></i> Users / Instansi</a></li>
                <li><a href="<?=base_url('admin/delete');?>"><i class="fa fa-trash"></i> Manage Kegiatan</a></li>
            <?php } ?>
              </ul>
            </li>
            <?php } ?>

            <?php if(in_array($this->session->userdata('role'), array('9'))) { // BPS ?>            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Administrator"><i class="fa fa-gears"></i> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?=base_url('admin/user');?>"><i class="fa fa-user-o"></i> Users / Instansi</a></li>
                <li><a href="<?=base_url('backup');?>"><i class="fa fa-cloud"></i> Backup Database</a></li>
                <?php if(in_array($this->session->userdata('role'), array('9'))) { // Admin ?>            
                <li class="divider"></li>
                <li><a href="<?=base_url('admin/login_as');?>"><i class="fa fa-terminal"></i> Login As</a></li>
                <li><a href="<?=base_url('error_log');?>"><i class="fa fa-terminal"></i> Error Log</a></li>
                <li class="divider"></li>
                <li><a href="<?=base_url('admin/delete');?>"><i class="fa fa-trash"></i> Manage Kegiatan</a></li>
                <?php } ?>
              </ul>
            </li>
            <?php } ?>
<?php if($this->session->userdata('role')=='9' || ($this->session->userdata('role')=='2' && substr($this->session->userdata('id_wilayah'),2,2)=='00')) { ?>
            <li<?php if($this->router->class=='upload') echo ' class="active"';?>><a href="<?=base_url('upload');?>"><i class="fa fa-sign-out"></i> INDAH</a></li>
<?php } ?>
            <li><a href="<?=base_url('assets/PANDUAN SIMEDA Ver.1.pdf');?>" target="panduan_aplikasi_omae">
              <i class="fa fa-question-circle"></i> 
              Panduan Aplikasi
            </a></li>

          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">&nbsp;</span>
                <i class="fa fa-user-o"></i> <?=$this->session->userdata('username');?>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header" style="height:unset">
                  <p>
                    <?=$this->session->userdata('instansi');?>
                    <small><?=$this->session->userdata('username');?></small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?=$base;?>/profil" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?=$base;?>/logout" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php if(isset($_title)) echo $_title;?>
         </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
          <?php if(isset($_breadcrumbs)) foreach($_breadcrumbs as $k=>$e){
            if(is_string($k)) echo '<li>'.anchor($k,$e).'</li>';
            else echo '<li>'.$e.'</li>';
          }?>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
      <?php if(isset($_view)) include $_view.'.php';?>
      </section>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <?=anchor('https://www.kutaitimurkab.go.id/','Pemda Kutim');?> &copy; 2023
      <div class="pull-right">Versi 1.0.0</div>
    </div>
  </footer>
</div>

<script src="<?=$assets;?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=$assets;?>/theme/js/adminlte.min.js"></script>
<script src="<?=$assets;?>/theme/js/demo.js"></script>
<script>
  var author = $('meta[name=author]').attr('content');
  var description = $('meta[name=description]').attr('content');
  $('.navbar-brand').attr('title',description+' - '+author);
</script>
</body>
</html>
