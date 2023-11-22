<div class="table-responsive">
    <table class="table table-bordered table-striped" id="tabel-master">
        <thead class="thead-dark">
            <tr style="text-align: center;" class="bg-info">
                <!-- <th>No</th> -->
                <th>Tahun</th>
                <th>ID Keluarga</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>desil</th>
                <th>alamat</th>
                <th>kk</th>
                <th>nik</th>
                <th>padan_dukcapil</th>
                <th>jk</th>
                <th>tgl_lahir</th>
                <th>pekerjaan</th>
                <th>pendidikan</th>
                <th>kepemilikan_rumah</th>
                <th>simpanan</th>
                <th>jenis_atap</th>
                <th>jenis_dinding</th>
                <th>jenis_lantai</th>
                <th>sumber_penerangan</th>
                <th>bahan_bakar_memasak</th>
                <th>sumber_air_minum</th>
                <th>fasilitas_bab</th>
                <th>penerima_bnpt</th>
                <th>penerima_bpum</th>
                <th>penerima_bst</th>
                <th>penerima_pkh</th>
                <th>penerima_sembako</th>
                <th>userid</th>
                <th>created_at</th>
                <th>modified_at</th>
                <th>deleted_at</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($master) : ?>
                <?php foreach ($master as $n) : ?>
                    <tr>
                        <td><?php echo $n['tahun']; ?></td>
                        <td><?php echo $n['id_keluarga']; ?></td>
                        <td><?php echo $n['prov']; ?></td>
                        <td><?php echo $n['kab']; ?></td>
                        <td><?php echo $n['kec']; ?></td>
                        <td><?php echo $n['desa']; ?></td>
                        <td><?php echo $n['desil']; ?></td>
                        <td><?php echo $n['alamat']; ?></td>
                        <td><?php echo $n['kk']; ?></td>
                        <td><?php echo $n['nik']; ?></td>
                        <td><?php echo $n['padan_dukcapil']; ?></td>
                        <td><?php echo $n['jk']; ?></td>
                        <td><?php echo $n['tgl_lahir']; ?></td>
                        <td><?php echo $n['pekerjaan']; ?></td>
                        <td><?php echo $n['pendidikan']; ?></td>
                        <td><?php echo $n['kepemilikan_rumah']; ?></td>
                        <td><?php echo $n['simpanan']; ?></td>
                        <td><?php echo $n['jenis_atap']; ?></td>
                        <td><?php echo $n['jenis_dinding']; ?></td>
                        <td><?php echo $n['jenis_lantai']; ?></td>
                        <td><?php echo $n['sumber_penerangan']; ?></td>
                        <td><?php echo $n['bahan_bakar_memasak']; ?></td>
                        <td><?php echo $n['sumber_air_minum']; ?></td>
                        <td><?php echo $n['fasilitas_bab']; ?></td>
                        <td><?php echo $n['penerima_bnpt']; ?></td>
                        <td><?php echo $n['penerima_bpum']; ?></td>
                        <td><?php echo $n['penerima_bst']; ?></td>
                        <td><?php echo $n['penerima_pkh']; ?></td>
                        <td><?php echo $n['penerima_sembako']; ?></td>
                        <td><?php echo $n['userid']; ?></td>
                        <td><?php echo $n['created_at']; ?></td>
                        <td><?php echo $n['modified_at']; ?></td>
                        <td><?php echo $n['deleted_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <!-- <th>No</th> -->
                <th>Tahun</th>
                <th>ID Keluarga</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>desil</th>
                <th>alamat</th>
                <th>kk</th>
                <th>nik</th>
                <th>padan_dukcapil</th>
                <th>jk</th>
                <th>tgl_lahir</th>
                <th>pekerjaan</th>
                <th>pendidikan</th>
                <th>kepemilikan_rumah</th>
                <th>simpanan</th>
                <th>jenis_atap</th>
                <th>jenis_dinding</th>
                <th>jenis_lantai</th>
                <th>sumber_penerangan</th>
                <th>bahan_bakar_memasak</th>
                <th>sumber_air_minum</th>
                <th>fasilitas_bab</th>
                <th>penerima_bnpt</th>
                <th>penerima_bpum</th>
                <th>penerima_bst</th>
                <th>penerima_pkh</th>
                <th>penerima_sembako</th>
                <th>userid</th>
                <th>created_at</th>
                <th>modified_at</th>
                <th>deleted_at</th>
            </tr>
        </tfoot>
    </table>
    <br>
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