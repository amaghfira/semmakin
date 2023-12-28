<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Kelola Pengguna</h5>
        <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#addModal">Tambah Pengguna</button>

        <?php if (session()->has('pesan_add')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_add') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ti ti-square-x"></i></span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('pesan_update')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_update') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ti ti-square-x"></i></span>
                </button>
            </div>
        <?php endif; ?>
        <?php if (session()->has('pesan_delete')) : ?>
            <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                <?= session()->getFlashdata('pesan_delete') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ti ti-square-x"></i></span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- TABEL -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel-master">
                    <thead>
                        <tr>
                            <?php foreach (array_keys($users[0]) as $key) : ?>
                                <th><?= htmlspecialchars($key); ?></th>
                            <?php endforeach; ?>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $row) : ?>
                            <tr>
                                <?php foreach ($row as $column) : ?>
                                    <td><?= htmlspecialchars($column); ?></td>
                                <?php endforeach; ?>
                                <td><a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $row['userid']; ?>" data-username="<?= $row['username']; ?>" data-role="<?= $row['role']; ?>"><i class="ti ti-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['userid']; ?>"><i class="ti ti-trash-x"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add form-->
<form action="<?= base_url() ?>/user/add" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti ti-square-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username_baru" placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control" name="role_baru" placeholder="Masukkan role" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password_baru" placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group">
                        <label>Verifikasi Password</label>
                        <input type="password" class="form-control" name="password_verif" placeholder="Masukkan password yg sudah dibuat sebelumnya" required>
                    </div>
                    <div class="form-group">
                        <label>Instansi</label>
                        <input type="text" class="form-control" name="instansi_baru" placeholder="Masukkan nama instansi" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat_baru" placeholder="Masukkan alamat" required>
                    </div>
                    <div class="form-group">
                        <label>No Telepon/HP</label>
                        <input type="text" class="form-control" name="telp_baru" placeholder="Masukkan nomor HP atau telepon">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email_baru" placeholder="Masukkan email" required>
                    </div>
                    <div class="form-group">
                        <label>Faksimile</label>
                        <input type="text" class="form-control" name="faksimile_baru" placeholder="Masukkan faksimile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add form-->

<!-- Modal edit form -->
<form action="<?= base_url() ?>/user/edit" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control username" name="username" placeholder="username">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" class="form-control role" name="role" placeholder="role">
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="text" class="form-control password_baru" name="password_baru" placeholder="password_baru">
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
<form action="<?= base_url(); ?>/user/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Apakah anda yakin akan menghapus pengguna dari master data?</h4>

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

<!-- script modal -->
<script>
    $(document).ready(function() {

        // get Edit form
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const username = $(this).data('username');
            const role = $(this).data('role');

            // Set data to Form Edit
            $('.id').val(id);
            $('.username').val(username);
            $('.role').val(role);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete form
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.id').val(id);
            // Call Modal Edit
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
            "order": [
                [0, 'desc']
            ],
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