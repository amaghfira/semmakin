<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Naskah Keluar</h1>
<br>
<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Daftar Naskah Keluar
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
        <div class="row" style="background-color: white;">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel-master">
                    <thead class="thead-dark">
                        <tr style="text-align: center;" class="bg-info">
                            <th>No</th>
                            <th>Tanggal Naskah</th>
                            <th>Nomor Naskah</th>
                            <th>Hal</th>
                            <th>Asal Naskah</th>
                            <th>Tujuan Internal</th>
                            <th>Tujuan Eksternal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($naskah) : ?>
                            <?php foreach ($naskah as $n) : ?>
                                <tr>
                                    <td><?php echo $n['id']; ?></td>
                                    <td><?php echo $n['tgl_naskah']; ?></td>
                                    <td><?php echo $n['nomor_naskah']; ?></td>
                                    <td><?php echo $n['hal']; ?></td>
                                    <td><?php echo $n['unit_kerja']; ?></td>
                                    <td><?php echo $n['tujuan_internal']; ?></td>
                                    <td><?php echo $n['tujuan_eksternal']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>/download-naskah-keluar/?id=<?= $n['id']; ?>" class="btn btn-success btn-sm" id="download-naskah">
                                            <i class="fa fa-file-download" aria-hidden="true"></i>
                                        </a>

                                        <a href="<?= base_url(); ?>/download-lampiran-keluar/?id=<?= $n['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                        </a>
                                        <?php if (session()->username == 'christin' or session()->role == '92610') : ?>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit" data-id="<?= $n['id']; ?>" data-unitkerja="<?= $n['unit_kerja']; ?>" data-jenis="<?= $n['jenis']; ?>" data-sifat="<?= $n['sifat']; ?>" data-urgensi="<?= $n['urgensi']; ?>" data-klasifikasi="<?= $n['klasifikasi']; ?>" data-nomor="<?= $n['nomor_naskah']; ?>" data-hal="<?= $n['hal']; ?>" data-ringkasan="<?= $n['ringkasan']; ?>" data-tujuaninternal="<?= $n['tujuan_internal']; ?>" data-tujuaneksternal="<?= $n['tujuan_eksternal']; ?>" data-tembusaninternal="<?= $n['tembusan_internal']; ?>" data-tembusaneksternal="<?= $n['tembusan_eksternal']; ?>" data-tglnaskah="<?= $n['tgl_naskah']; ?>" >
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
                            <th>No</th>
                            <th>Tanggal Naskah</th>
                            <th>Nomor Naskah</th>
                            <th>Hal</th>
                            <th>Asal Naskah</th>
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
<form action="<?= base_url() ?>/naskah/edit_naskah_keluar" method="post">
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
                        <label>unit kerja </label>
                        <input type="text" class="form-control unitkerja" name="unitkerja" placeholder="Pengirim">
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
                        <input type="text" class="form-control urgensi" name="urgensi" placeholder="urgensi" >
                    </div>
                    <div class="form-group">
                        <label>klasifikasi </label>
                        <input type="text" class="form-control klasifikasi" name="klasifikasi" placeholder="klasifikasi">
                    </div>
                    <div class="form-group">
                        <label>nomor </label>
                        <input type="text" class="form-control nomor" name="nomor" placeholder="nomor" readonly>
                    </div>
                    <div class="form-group">
                        <label>hal </label>
                        <input type="text" class="form-control hal" name="hal" placeholder="hal">
                    </div>
                    <div class="form-group">
                        <label>ringkasan </label>
                        <input type="text" class="form-control ringkasan" name="ringkasan" placeholder="ringkasan">
                    </div>
                    <div class="form-group">
                        <label>tujuaninternal </label>
                        <input type="text" class="form-control tujuaninternal" name="tujuaninternal" placeholder="tujuaninternal">
                    </div>
                    <div class="form-group">
                        <label>tujuaneksternal </label>
                        <input type="text" class="form-control tujuaneksternal" name="tujuaneksternal" placeholder="tujuaneksternal">
                    </div>
                    <div class="form-group">
                        <label>tembusaninternal </label>
                        <input type="text" class="form-control tembusaninternal" name="tembusaninternal" placeholder="tembusaninternal">
                    </div>
                    <div class="form-group">
                        <label>tembusaneksternal </label>
                        <input type="text" class="form-control tembusaneksternal" name="tembusaneksternal" placeholder="tembusaneksternal">
                    </div>
                    <div class="form-group">
                        <label>tglnaskah </label>
                        <input type="text" class="form-control tglnaskah" name="tglnaskah" placeholder="tglnaskah">
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
<form action="<?= base_url(); ?>/naskah/delete_naskah_keluar" method="post">
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

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const unitkerja = $(this).data('unitkerja');
            const klasifikasi = $(this).data('klasifikasi');
            const jenis = $(this).data('jenis');
            const sifat = $(this).data('sifat');
            const urgensi = $(this).data('urgensi');
            const nomor = $(this).data('nomor');
            const hal = $(this).data('hal');
            const ringkasan = $(this).data('ringkasan');
            const tujuaninternal = $(this).data('tujuaninternal');
            const tujuaneksternal = $(this).data('tujuaneksternal');
            const tembusaninternal = $(this).data('tembusaninternal');
            const tembusaneksternal = $(this).data('tembusaneksternal');
            const tglnaskah = $(this).data('tglnaskah');

            // Set data to Form Edit
            $('.id').val(id);
            $('.unitkerja').val(unitkerja);
            $('.klasifikasi').val(klasifikasi);
            $('.jenis').val(jenis);
            $('.sifat').val(sifat);
            $('.urgensi').val(urgensi);
            $('.nomor').val(nomor);
            $('.hal').val(hal);
            $('.ringkasan').val(ringkasan);
            $('.tujuaninternal').val(tujuaninternal);
            $('.tujuaneksternal').val(tujuaneksternal);
            $('.tembusaninternal').val(tembusaninternal);
            $('.tembusaneksternal').val(tembusaneksternal);
            $('.tglnaskah').val(tglnaskah);

            // Call Modal Edit
            $('#editModal').modal('show');
        });


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