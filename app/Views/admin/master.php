<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title fw-semibold mb-4">Raw data P3KE</h6>
            <p>Data di bawah ini hanya sampel. Untuk mendapatkan raw data silakan mengunduh file excel.</p>
            <a type="button" class="btn btn-success" href="<?= base_url(); ?>/unduh-p3ke"><i class="ti ti-download"></i> Unduh data p3ke</a>
        </div>
    </div>
</div>
<div id="formContainer">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabel-master">
            <?php if (!empty($p3ke) && is_array($p3ke) && count($p3ke) > 0) : ?>
                <thead>
                    <tr>
                        <?php foreach (array_keys($p3ke[0]) as $key) : ?>
                            <th><?= htmlspecialchars($key); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($p3ke as $row) : ?>
                        <tr>
                            <?php foreach ($row as $column) : ?>
                                <td><?= htmlspecialchars($column); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else : ?>
                <thead>
                    <tr>
                        <th>No data available</th>
                    </tr>
                </thead>
            <?php endif; ?>

        </table>
        <br>
    </div>
</div>
<br>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title fw-semibold mb-4">Raw data Podes</h6>
            <p>Data di bawah ini hanya sampel. Untuk mendapatkan raw data silakan mengunduh file excel. <b>Penjelasan:</b> Data Podes terbagi menjadi podes desa dan podes kecamatan. Silakan unduh semua data untuk memperoleh data yang lengkap.</p>
            <a type="button" class="btn btn-success" href="<?= base_url(); ?>/unduh-podes0"><i class="ti ti-download"></i> Podes kecamatan</a>
            <a type="button" class="btn btn-success" href="<?= base_url(); ?>/unduh-podes1"><i class="ti ti-download"></i> Podes desa 1</a>
            <a type="button" class="btn btn-success" href="<?= base_url(); ?>/unduh-podes2"><i class="ti ti-download"></i> Podes desa 2</a>
            <a type="button" class="btn btn-success" href="<?= base_url(); ?>/unduh-podes3"><i class="ti ti-download"></i> Podes desa 3</a>
            <a type="button" class="btn btn-success" href="<?= base_url(); ?>/unduh-podes4"><i class="ti ti-download"></i> Podes desa 4</a>
        </div>
    </div>
</div>
<div id="formContainer">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tabel-master2">
            <?php if (!empty($podes) && is_array($podes) && count($podes) > 0) : ?>
                <thead>
                    <tr>
                        <?php foreach (array_keys($podes[0]) as $key) : ?>
                            <th><?= htmlspecialchars($key); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($podes as $row) : ?>
                        <tr>
                            <?php foreach ($row as $column) : ?>
                                <td><?= htmlspecialchars($column); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else : ?>
                <thead>
                    <tr>
                        <th>No data available</th>
                    </tr>
                </thead>
            <?php endif; ?>

        </table>
        <br>
    </div>
</div>

<!-- script datatables -->
<script>
    $(document).ready(function() {

        $('#tabel-master #tabel-master2 tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        var tabel = $("#tabel-master").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "order": [
                [0, 'desc']
            ],
            "buttons": ["copy", "csv", "excel", "pdf", "colvis"],
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });

        tabel.buttons().container()
            .appendTo('#tabel-master_wrapper .col-md-6:eq(0)');

        var tabel2 = $("#tabel-master2").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "order": [
                [0, 'desc']
            ],
            "buttons": ["copy", "csv", "excel", "pdf", "colvis"],
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });

        tabel2.buttons().container()
            .appendTo('#tabel-master_wrapper .col-md-6:eq(0)');

    });
</script>