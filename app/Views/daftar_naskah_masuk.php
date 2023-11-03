<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Naskah Masuk</h1>
<br>
<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Daftar Naskah Masuk
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
        <?php if (session()->has('pesan_delete')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_delete') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('pesan_email')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_email') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tabel-master">
                <thead class="thead-dark">
                    <tr style="text-align: center;" class="bg-info">
                        <!-- <th>No</th> -->
                        <th>Tanggal Naskah</th>
                        <th>Nomor Naskah</th>
                        <th>Hal</th>
                        <th>Asal Naskah</th>
                        <th>Disposisi</th>
                        <th>Tingkat Urgensi</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($naskah) : ?>
                        <?php foreach ($naskah as $n) : ?>
                            <tr>
                                <!-- <td><?php echo $n['id']; ?></td> -->
                                <td><?php echo $n['tgl_naskah']; ?></td>
                                <td><?php echo $n['nomor_naskah']; ?></td>
                                <td><?php echo $n['hal']; ?></td>
                                <td><?php echo $n['pengirim'] . ' - ' . $n['jabatan'] . ' (' . $n['instansi'] . ')'; ?></td>
                                <td><?php echo $n['disposisi']; ?></td>
                                <td><?php echo $n['urgensi']; ?></td>
                                <td><?php echo $n['status_berkas']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>/download-naskah-masuk/?id=<?= $n['id']; ?>" class="btn btn-success btn-sm" id="download-naskah">
                                        <i class="fa fa-file-download" aria-hidden="true"></i>
                                    </a>

                                    <a href="<?= base_url(); ?>/download-lampiran-masuk/?id=<?= $n['id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <?php if (session()->username == 'christin' or session()->role == '92610') : ?>
                                    <a href="<?= base_url(); ?>/naskah/edit_naskah_masuk_form/?id=<?= $n['id']; ?>" class="btn btn-warning btn-sm btn-edit" >
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $n['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Tanggal Naskah</th>
                        <th>Nomor Naskah</th>
                        <th>Hal</th>
                        <th>Asal Naskah</th>
                        <th>Disposisi</th>
                        <th>Tingkat Urgensi</th>
                        <th>Status Berkas</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            <br>
        </div>

    </div>
</div>
</div>

<!-- Modal -->
<!-- Modal edit form -->
<form action="<?= base_url() ?>/naskah/edit_naskah_masuk" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Naskah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pengirim</label>
                        <input type="text" class="form-control pengirim" name="pengirim" placeholder="Pengirim">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control jabatan" name="jabatan" placeholder="Jabatan">
                    </div>
                    <div class="form-group">
                        <label>Instansi </label>
                        <input type="text" class="form-control instansi" name="instansi" placeholder="Instansi">
                    </div>
                    <div class="form-group">
                        <label>jenis </label>
                        <input type="text" class="form-control jenis" name="jenis" placeholder="jenis">
                    </div>
                    <div class="form-group">
                        <label>sifat </label>
                        <input type="text" class="form-control sifat" name="sifat" placeholder="sifat">
                    </div>
                    <div class="form-group">
                        <label>urgensi </label>
                        <input type="text" class="form-control urgensi" name="urgensi" placeholder="urgensi">
                    </div>
                    <div class="form-group">
                        <label>nomor </label>
                        <input type="text" class="form-control nomor" name="nomor" placeholder="nomor" readonly>
                    </div>
                    <div class="form-group">
                        <label>tglnaskah </label>
                        <input type="text" class="form-control tglnaskah" name="tglnaskah" placeholder="tglnaskah">
                    </div>
                    <div class="form-group">
                        <label>tglditerima </label>
                        <input type="text" class="form-control tglditerima" name="tglditerima" placeholder="tglditerima">
                    </div>
                    <div class="form-group">
                        <label>tujuan </label>
                        <input type="text" class="form-control tujuan" name="tujuan" placeholder="tujuan">
                    </div>
                    <div class="form-group">
                        <label>tembusan </label>
                        <input type="text" class="form-control tembusan" name="tembusan" placeholder="tembusan">
                    </div>
                    <div class="form-group">
                        <label>disposisi </label>
                        <input type="text" class="form-control disposisi" name="disposisi" placeholder="disposisi">
                    </div>
                    <div class="form-group">
                        <label>file naskah </label>
                        <input type="file" name="file_naskah" class="form-control-uniform-custom" data-show-upload="false" data-show-caption="true" data-show-preview="true" data-fouc>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End modal edit form -->

<!-- Modal delete form -->
<form action="<?= base_url(); ?>/naskah/delete_naskah_masuk" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Master Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah anda yakin akan menghapus dari master data? </h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End modal delete form -->


<!--Modal SCRIPT -->
<script>
    $(document).ready(function() {

        // // get Edit Product
        // $('.btn-edit').on('click', function() {
        //     // get data from button edit
        //     const id = $(this).data('id');
        //     const pengirim = $(this).data('pengirim');
        //     const jabatan = $(this).data('jabatan');
        //     const instansi = $(this).data('instansi');
        //     const jenis = $(this).data('jenis');
        //     const sifat = $(this).data('sifat');
        //     const urgensi = $(this).data('urgensi');
        //     const nomor = $(this).data('nomor');
        //     const tglnaskah = $(this).data('tglnaskah');
        //     const tglditerima = $(this).data('tglditerima');
        //     const tujuan = $(this).data('tujuan');
        //     const tembusan = $(this).data('tembusan');
        //     const disposisi = $(this).data('disposisi');

        //     // Set data to Form Edit
        //     $('.id').val(id);
        //     $('.pengirim').val(pengirim);
        //     $('.jabatan').val(jabatan);
        //     $('.instansi').val(instansi);
        //     $('.jenis').val(jenis);
        //     $('.sifat').val(sifat);
        //     $('.urgensi').val(urgensi);
        //     $('.nomor').val(nomor);
        //     $('.tglnaskah').val(tglnaskah);
        //     $('.tglditerima').val(tglditerima);
        //     $('.tujuan').val(tujuan);
        //     $('.tembusan').val(tembusan);
        //     $('.disposisi').val(disposisi);

        //     // Call Modal Edit
        //     $('#editModal').modal('show');
        // });


        // get Delete Product
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            console.log(id);
            // Set data to Form Edit
            $('.id').val(id);
            // Call Modal delete
            $('#deleteModal').modal('show');
        });
    });
</script>


<!-- other scripts -->
<!-- <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script> -->

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
            "order": [[0,'desc']],
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