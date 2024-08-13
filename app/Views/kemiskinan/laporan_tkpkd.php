<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Download Laporan TKPKD</h5>
            <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias eos laboriosam officiis hic provident. Incidunt odio est, voluptatum, rem autem veniam sapiente porro perspiciatis aspernatur, dignissimos eius similique fugiat. Illo.</p>
            <div class="row" style="background-color: white;">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tabel-master">
                        <thead class="thead-dark">
                            <tr style="text-align: center;" class="bg-info">
                                <th>ID</th>
                                <th>Tahun</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($laporan) : ?>
                                <?php foreach ($laporan as $n) : ?>
                                    <tr>
                                        <td><?php echo $n['id']; ?></td>
                                        <td><?php echo $n['tahun']; ?></td>
                                        <td><?php echo $n['nama']; ?></td>

                                        <td>
                                            <a href="<?= base_url(); ?>/download-tkpkd/?id=<?= $n['id']; ?>" class="btn btn-success btn-sm" id="download-naskah">
                                                <i class="ti ti-download" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tahun</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                    <br>
                </div>

            </div>
            <div id="container-map"></div>
        </div>
    </div>
</div>


<!-- script datatables -->
<script>
    $(document).ready(function() {

        $('#tabel-master tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        var tabel = $("#tabel-master").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "order": [[1,'desc']],
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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

    });
</script>