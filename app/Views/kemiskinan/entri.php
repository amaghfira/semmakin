<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Pilih jenis form</h5>
                <p>
                    Form dibawah ini untuk melakukan updating data DTKS maupun data P3KE hasil pelaksanaan verifikasi lapangan untuk mendapatkan data rumah tangga miskin terbaru. <br>
                </p>
                <p>
                    <b>Updating Data DTKS</b>
                <ol>
                    <li>Verifikasi dan Validasi DTKS dilakukan di dalam aplikasi SIKS NG oleh Operator SIKS-NG</li>
                    <li>Verifikasi dan Validasi DTKS dilakukan melalui akun pejabat yang berwenang, akun pejabat kabupaten yang memiliki hak akses akun pendamping petugas wilayah yang memiliki hak akses (Petugas Operator Desa/Kelurahan)</li>
                    <li>Data yang diVerifikasi dan Validasi DTKS berupa data penerima bantuan sosial seperti PKH, sembako/BPNT dan PBI secara berkala (1 bulan sekali)</li>
                    <li>Adapun dalam DTKS yang dinyatakan tidak layak/dikeluarkan antara lain : Alamat tidak ditemukan, meninggal dunia, memiliki pekerja sebagai TNI/POLRI PNS atau ASN anggota keluarga TNI/POLRI PNS, sudah mampu, tidak memiliki komponen sesuai dengan kriteria program bansos</li>
                    <li>Proses Updating dilakukan secara berkala ( 1 bulan) sekali) dan wajib untuk melakukan proses finalisasi dan pengesahan.</li>
                </ol>
                </p>
                <p>
                    <b>Updating Data P3KE</b>
                </p>
                <p>
                    Percepatan Penghapusan Kemiskinan Ekstrem (PPKE) adalah upaya yang terarah, terpadu, dan berkelanjutan yang dilakukan pemerintah, pemerintah daerah, dan/atau masyarakat dalam bentuk kebijakan, program dan kegiatan pemberdayaan, pendampingan, serta fasilitasi untuk memenuhi kebutuhan dasar setiap warga negara.
                    Data Pensasaran Percepatan Penghapusan Kemiskinan Ekstrem (P3KE) adalah kumpulan informasi dan data keluarga serta individu anggota keluarga hasil pemutakhiran Basis Data Keluarga Indonesia (Pendataan Keluarga Badan Kependudukan dan Keluarga Berencana Nasional/PK-BKKBN 2021) di setiap wilayah pemutakhiran (RT/Dusun/RW) dan setiap tingkatan wilayah administrasi (desa/kelurahan, kecamatan, kabupaten/kota, provinsi dan pusat) yang tersimpan dalam file elektronik dan sudah divalidasi NIK oleh DUKCAPIL serta memiliki status kesejahteraan (Desil).
                </p>
                <br>
                <?php if (session()->has('insert_message')) : ?>
                    <div class="alert <?= session()->getFlashdata('alert-class') ?>" role="alert">
                        <?= session()->getFlashdata('insert_message') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <hr>
                <div class="mb-3">
                    <label for="formSelector" class="form-label">Jenis Form</label>
                    <select name="formSelector" id="formSelector" class="form-control form-select">
                        <option value="">Pilih Form...</option>
                        <option value="dtks">DTKS</option>
                        <option value="p3ke">P3KE</option>
                    </select>
                </div>
            </div>
            <div id="formContainer"></div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#formSelector').change(function() {
            var selectedForm = $(this).val();
            if (selectedForm) {
                if (selectedForm === "p3ke") {
                    $.ajax({
                        url: '<?= site_url('FormController/getFormP3KE') ?>',
                        method: 'GET',
                        success: function(response) {
                            $('#formContainer').html(response.form);
                        }
                    });
                } else if (selectedForm === "dtks") {
                    $.ajax({
                        url: '<?= site_url('FormController/getFormDtks') ?>',
                        method: 'GET',
                        success: function(response) {
                            $('#formContainer').html(response.form);
                        }
                    });
                } else {
                    $('#formContainer').html('');
                }
            } else {
                $('#formContainer').html('');
            }
        });
    });
</script>