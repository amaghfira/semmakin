<!--  Row 1 -->
<div class="row"></div>
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div>
                        <div id="container-bar-pekerjaan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- pie chart by jk -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <figure class="highcharts-figure">
                                    <div id="container-pie-jk"></div>
                                </figure>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div id="breakup"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Jumlah penduduk Miskini ekstrem -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <p style="font-size: 14;" class="card-title mb-9 fw-semibold"> Jumlah Penduduk Miskin Ekstrem </p>
                                <h5 class="fw-semibold mb-3"> <?= $jmltot->jmltotal; ?> Orang</h5>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-user fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- row 2  -->
<div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div>
                        <div id="container-bar-pendidikan"></div>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- pie chart miskin ekstrem by kelompok umur -->
        <div class="card overflow-hidden">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-8">
                        <figure class="highcharts-figure">
                            <div id="container-pie-rumah"></div>
                        </figure>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <div id="breakup"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- highcharts script -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="<?= base_url(); ?>/dist/js/mycharts.js"></script>