<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Template Surat Dinas</h1>
<br>
<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Daftar Template
    </div> <!-- /.card-body -->
    <div class="card-body">
        <?php if (session()->has('pesan_add')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_add') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('pesan_find')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_find') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel-master">
                    <thead class="thead-dark">
                        <tr style="text-align: center;" class="bg-info">
                            <th>No</th>
                            <th>Nama Template</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($templates) : ?>
                            <?php foreach ($templates as $template) : ?>
                                <tr>
                                    <td><?php echo $template['id']; ?></td>
                                    <td><?php echo $template['nama']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>/Naskah/download_templates/?id=<?= $template['id']; ?>">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Template</th>
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