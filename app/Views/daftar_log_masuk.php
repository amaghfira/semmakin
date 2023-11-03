<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Log Naskah Masuk</h1>
<br>
<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Daftar Log Naskah Masuk
    </div> <!-- /.card-body -->
    <div class="card-body">
        <div class="row" style="background-color: white;">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel-master">
                    <thead class="thead-dark">
                        <tr style="text-align: center;" class="bg-info">
                            <th>Timestamp</th>
                            <th>Nomor Naskah</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($logmasuk) : ?>
                            <?php foreach ($logmasuk as $log) : ?>
                                <tr>
                                    <td><?php echo $log['created_at']; ?></td>
                                    <td><?php echo $log['nomor_naskah']; ?></td>
                                    <td><?php echo $log['nama']; ?></td>
                                    <td><?php echo $log['aksi']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Timestamp</th>
                            <th>Nomor Naskah</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                <br>
            </div>

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
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
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