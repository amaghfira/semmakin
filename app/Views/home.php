<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div> -->

<!-- Content Row -->
<!-- <div class="row">
</div> -->

<h3>Dashboard</h3>
<br>

<!-- Load css dan js -->
<link rel="stylesheet" href="<?= base_url() ?>/dist/css/style.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div style="background-color: #1F1D36; height:3px"></div>
<div class="row" style="background-color: white;">
    <br>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <a href="<?= base_url(); ?>/naskah-masuk">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Naskah Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_naskah_masuk; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class=" fas fa-solid fa-newspaper fa-2x"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <a href="<?= base_url(); ?>/naskah-keluar">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Naskah Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_naskah_keluar; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa fa-paper-plane fa-2x" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>