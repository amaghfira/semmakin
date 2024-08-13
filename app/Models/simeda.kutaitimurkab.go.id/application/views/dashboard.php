<section class="content">
	<div class="alert alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<div class="user-block">
		  <img class="img-circle img-bordered-sm" src="<?=base_url();?>/assets/theme/img/user7-128x128.jpg">
		  <span class="username">Selamat datang di SIMEDA (Sistem Informasi Meta Data)</span>
		  <span class="description">Administrator</span>
		</div>
		<p>
			SIMEDA adalah rumah metadata statistik sektoral. 
			Aplikasi berbasis website ini digunakan untuk pengelolaan metadata secara elektronik dengan user OPD, BPS dan Diskominfo.
		</p>
		<p>
			SIMEDA digunakan untuk entri kuesioner oleh OPD, pemeriksaan oleh BPS/Diskominfo, serta approval oleh Diskominfo. Proses pemeriksaan dilengkapi dengan tahap pemberian respon dan feedback dari OPD.
		</p>
		<p>
			Metadata yang dikumpulkan adalah metadata kegiatan (ms-keg), metadata variabel (ms-var), dan metadata indikator (ms-ind). 
			Tabulasi output SIMEDA bisa digunakan sebagai acuan dalam melakukan pembinaan statistik sektoral dalam pengumpulan metadata.
		</p>
	</div>

  <div class="row">
	<div class="col-md-4">
		<div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">MS Kegiatan</h3>
            </div>
            <div class="box-body">
              <div class="row">
	              <div class="chart-responsive">
	                <canvas id="chartKegiatan" height="160"></canvas>
	              </div>
              </div>
            </div>
        </div>
    </div>

	<div class="col-md-4">
		<div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">MS Variabel</h3>
            </div>
            <div class="box-body">
              <div class="row">
	              <div class="chart-responsive">
	                <canvas id="chartVariabel" height="160"></canvas>
	              </div>
              </div>
            </div>
        </div>
    </div>

	<div class="col-md-4">
		<div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">MS Indikator</h3>
            </div>
            <div class="box-body">
              <div class="row">
	              <div class="chart-responsive">
	                <canvas id="chartIndikator" height="160"></canvas>
	              </div>
              </div>
            </div>
        </div>
    </div>
  </div>
</section>

<style>
.alert {background: white; border: 1px solid #1ac6f1;}
.user-block {
    border-bottom: 1px solid #eee;
    padding-bottom: 5px;
    margin-bottom: 5px		
}
</style>

<script src="<?=base_url('assets/chart.js/Chart.js');?>"></script>
<script>
	var pieOptions = {
	    percentageInnerCutout: 50, // This is 0 for Pie charts
	    animateRotate: false,
	    responsive: true,
	    maintainAspectRatio: false,
	    tooltipTemplate: '<%=value %> <%=label%>'
	};

<!-- kegiatan -->
	<?php $dKeg = $this->mskegiatan_model->dashboard($this->session->userdata('id_wilayah'));?>
	var pieKegiatanCanvas = $('#chartKegiatan').get(0).getContext('2d');
	var pieKegiatan = new Chart(pieKegiatanCanvas);
	var kegiatanData = [
	    { value: <?=$dKeg['0'];?>, color: '#d2d6de', highlight: '#d2d6de', label: 'Belum verifikasi' },
	    { value: <?=$dKeg['1'];?>, color: '#00a65a', highlight: '#00a65a', label: 'Terisi, sesuai' },
	    { value: <?=$dKeg['2'];?>, color: '#f39c12', highlight: '#f39c12', label: 'Terisi, tidak sesuai' },
		{ value: <?=$dKeg['3'];?>, color: '#f56954', highlight: '#f56954', label: 'Tidak/belum terisi' },
	];
	pieKegiatan.Doughnut(kegiatanData, pieOptions);
	$('#chartKegiatan').closest('.box').find('.box-header').append('<span class="pull-right">[ <?=$dKeg['kegiatan'];?> ]</span>');

<!-- variabel -->
	<?php $dVar = $this->mskegiatan_model->dashboard_variabel($this->session->userdata('id_wilayah'));?>
	var pieVariabelCanvas = $('#chartVariabel').get(0).getContext('2d');
	var pieVariabel = new Chart(pieVariabelCanvas);
	var variabelData = [
	    { value: <?=$dVar['0'];?>, color: '#d2d6de', highlight: '#d2d6de', label: 'Belum verifikasi' },
	    { value: <?=$dVar['1'];?>, color: '#00a65a', highlight: '#00a65a', label: 'Terisi, sesuai' },
	    { value: <?=$dVar['2'];?>, color: '#f39c12', highlight: '#f39c12', label: 'Terisi, tidak sesuai' },
		{ value: <?=$dVar['3'];?>, color: '#f56954', highlight: '#f56954', label: 'Tidak/belum terisi' },
	];
	pieVariabel.Doughnut(variabelData, pieOptions);
	$('#chartVariabel').closest('.box').find('.box-header').append('<span class="pull-right">[ <?=$dVar['variabel'];?> ]</span>');

<!-- indikator -->
	<?php $dInd = $this->mskegiatan_model->dashboard_indikator($this->session->userdata('id_wilayah'));?>
	var pieIndikatorCanvas = $('#chartIndikator').get(0).getContext('2d');
	var pieIndikator = new Chart(pieIndikatorCanvas);
	var indikatorData = [
	    { value: <?=$dInd['0'];?>, color: '#d2d6de', highlight: '#d2d6de', label: 'Belum verifikasi' },
	    { value: <?=$dInd['1'];?>, color: '#00a65a', highlight: '#00a65a', label: 'Terisi, sesuai' },
	    { value: <?=$dInd['2'];?>, color: '#f39c12', highlight: '#f39c12', label: 'Terisi, tidak sesuai' },
		{ value: <?=$dInd['3'];?>, color: '#f56954', highlight: '#f56954', label: 'Tidak/belum terisi' },
	];
	pieIndikator.Doughnut(indikatorData, pieOptions);
	$('#chartIndikator').closest('.box').find('.box-header').append('<span class="pull-right">[ <?=$dInd['indikator'];?> ]</span>');
</script>