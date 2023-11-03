<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Klasifikasi Naskah</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php if (session()->has('pesan_add')) : ?>
    <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
        <?= session()->getFlashdata('pesan_add') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#addModal">Tambah Data</button>
    </div> <!-- /.card-body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tabel-master">
                <thead class="thead-dark">
                    <tr style="text-align: center;" class="bg-info">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Klasifikasi1</th>
                        <th>Klasifikasi2</th>
                        <th>Klasifikasi3</th>
                        <th>Klasifikasi4</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($klasifikasi) : ?>
                        <?php foreach ($klasifikasi as $j) : ?>
                            <tr>
                                <td><?php echo $j['id']; ?></td>
                                <td><?php echo $j['kode']; ?></td>
                                <td><?php echo $j['klasifikasi1']; ?></td>
                                <td><?php echo $j['klasifikasi2']; ?></td>
                                <td><?php echo $j['klasifikasi3']; ?></td>
                                <td><?php echo $j['klasifikasi4']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm btn-edit" data-id="<?= $j['id']; ?>" data-kode="<?= $j['kode']; ?>" data-klasifikasi1="<?= $j['klasifikasi1']; ?>" data-klasifikasi2="<?= $j['klasifikasi2']; ?>" data-klasifikasi3="<?= $j['klasifikasi3']; ?>" data-klasifikasi4="<?= $j['klasifikasi4']; ?>">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $j['id']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Klasifikasi1</th>
                        <th>Klasifikasi2</th>
                        <th>Klasifikasi3</th>
                        <th>Klasifikasi4</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
            <br>
        </div>
    </div><!-- /.card-body -->
</div>
<hr>

<!-- Modal Add Product-->
<form action="<?= base_url() ?>/klasifikasi/add" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode_baru" placeholder="Masukkan kode" required>
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi1</label>
                        <input type="text" class="form-control" name="klasifikasi1" placeholder="Masukkan klasifikasi" required>
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi2</label>
                        <input type="text" class="form-control" name="klasifikasi2" placeholder="Masukkan klasifikasi" required>
                    </div>
                    <div class="form-group">
                        <label>klasifikasi3</label>
                        <input type="text" class="form-control" name="klasifikasi3" placeholder="Masukkan klasifikasi" required>
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
<!-- End Modal Add Product-->

<!-- Modal edit form -->
<form action="<?= base_url() ?>/klasifikasi/edit" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Master klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" class="form-control kode" name="kode" placeholder="kode">
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi1</label>
                        <input type="text" class="form-control klasifikasi1" name="klasifikasi1" placeholder="klasifikasi1">
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi2</label>
                        <input type="text" class="form-control klasifikasi2" name="klasifikasi2" placeholder="klasifikasi2">
                    </div>
                    <div class="form-group">
                        <label>Klasifikasi3</label>
                        <input type="text" class="form-control klasifikasi3" name="klasifikasi3" placeholder="klasifikasi3">
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
<form action="<?= base_url(); ?>/klasifikasi/delete" method="post">
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
         
           <h4>Apakah anda yakin akan menghapus dari master data?</h4>
         
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
$(document).ready(function(){
 
    // get Edit Product
    $('.btn-edit').on('click',function(){
        // get data from button edit
        const id = $(this).data('id');
        const kode = $(this).data('kode');
        const klasifikasi1 = $(this).data('klasifikasi1');
        const klasifikasi2 = $(this).data('klasifikasi2');
        const klasifikasi3 = $(this).data('klasifikasi3');
        
        // Set data to Form Edit
        $('.id').val(id);
        $('.kode').val(kode);
        $('.klasifikasi1').val(klasifikasi1);
        $('.klasifikasi2').val(klasifikasi2);
        $('.klasifikasi3').val(klasifikasi3);
        
        // Call Modal Edit
        $('#editModal').modal('show');
    });

    // get Delete Product
    $('.btn-delete').on('click',function(){
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