<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Registrasi Naskah Keluar</h1>
<br>

<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Form Registrasi Naskah Keluar
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form action="<?= base_url(); ?>/submit-naskah-keluar" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="lWoWsyPbUoQSYqvwu07PGQKnUOurVu80FZ1QYY4I">
            <div class="card-body">
                <fieldset>
                    <legend class="font-weight-semibold text-uppercase font-size-sm">Detail Isi Naskah
                    </legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sender_user_id">
                                    Dikirimkan melalui <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="sender_user_id" id="sender_user_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <script>
                                    $(function() {
                                        $('#datepicker').datepicker();
                                    });
                                </script>
                                <label for="tanggal">
                                    Tanggal Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="date" class="form-control" id="daterange-single1" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_naskah_id">
                                    Jenis Naskah <span class="text-danger">*</span>
                                </label>
                                <select name="jenis_naskah_id" id="jenis" class="form-control select2" data-placeholder="Pilih Jenis Naskah..." required>
                                    <?php if ($jenis) : ?>
                                        <?php foreach ($jenis as $j) : ?>
                                            <option value="<?= $j['jenis'] ?>">
                                                <?= $j['jenis'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sifat_naskah_id">
                                    Sifat Naskah <span class="text-danger">*</span>
                                </label>
                                <select name="sifat_naskah_id" id="sifat" class="form-control select2" data-placeholder="Pilih Sifat Naskah..." required>
                                    <?php if ($sifat) : ?>
                                        <?php foreach ($sifat as $sif) : ?>
                                            <option value="<?= $sif['sifat'] ?>">
                                                <?= $sif['sifat'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="urgensi_naskah_id">
                                    Tingkat Urgensi <span class="text-danger">*</span>
                                </label>
                                <select name="urgensi_naskah_id" id="urgensi" class="form-control select2" data-placeholder="Pilih Tingkat Urgensi..." required>
                                    <?php if ($urgensi) : ?>
                                        <?php foreach ($urgensi as $urg) : ?>
                                            <option value="<?= $urg['urgensi'] ?>">
                                                <?= $urg['urgensi'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="klasifikasi_id">
                                    Klasifikasi <span class="text-danger">*</span>
                                    <input type="text" class="text" name="klasifikasi_naskah_id" value="klasifikasi">
                                </label>
                                
                            </div> -->
                            <div class="form-group">
                                <label for="nomor" id="jenis_naskah_nomor">
                                    Nomor Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nomor" id="nomor" class="form-control" placeholder="Masukkan nomor naskah atau ambil nomor" required>
                                    <span class="input-group-append">
                                        <button class="btn bg-pink" data-toggle="modal" data-target="#modalForm" type="button">
                                            <i class="icon-info22 pr-1"></i>
                                            Ambil Nomor
                                        </button>
                                    </span>
                                </div>
                                <span class="form-text text-muted">
                                    <!-- INFO: Nomor diatas bersifat sementara, guna untuk penyesuaian file
                                    digital. -->
                                </span>
                            </div>
                            <div class="form-group">
                                <select hidden name="reply_id" class="form-control select2" id="reply_id" data-placeholder="Pilih Nomor Naskah">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="hal">
                                    Hal <span class="text-danger">*</span>
                                </label>
                                <textarea name="hal" rows="7" class="form-control" id="hal" placeholder="Masukkan hal..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ringkasan">
                                    Isi Ringkas <span class="text-danger">*</span>
                                </label>
                                <textarea name="ringkasan" rows="11" class="form-control" id="ringkasan" placeholder="Masukkan Isi ringkas..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">
                                    File Naskah <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="file_naskah" class="form-control-uniform-custom" data-show-upload="false" data-show-caption="true" data-show-preview="true" data-fouc required>
                                
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="font-weight-semibold text-uppercase font-size-sm">Lampiran Naskah
                    </legend>
                    <div class="form-group">
                        <label for="lampiran">
                            <span class="text-muted form-text">
                                Format yang didukung: .JPG .JPEG .PNG .DOC .DOCX .PDF .XLS .XLSX .PPT
                                .PPTX .MP4 .WAV
                            </span>
                            <span class="text-muted form-text">
                                Mohon memberikan nama file lampiran yang tepat dan benar, tidak
                                menggunakan unsur (titik), (koma), symbol (!@#$%^&* ( ) ) dan maksimal
                                <b>10 file</b>
                            </span>
                        </label>
                        <input type="file" name="lampiran" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" data-fouc>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                Tujuan Utama
                            </legend>
                        </fieldset>
                        <div class="form-group">
                            <label for="tujuan_internal_id">
                                Utama Internal <span class="text-danger">*</span>
                            </label>
                            <textarea type="text" name="tujuan_internal_id" id="tujuan_internal_id" class="form-control" required>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="tujuan_eksternal_id">
                                Utama Eksternal <span class="text-danger">*</span>
                            </label>
                            <textarea name="tujuan_eksternal_id" id="tujuan_eksternal_id" multiple="multiple" class="form-control" required>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                Tujuan Tembusan
                            </legend>
                        </fieldset>
                        <div class="form-group">
                            <label for="tembusan_internal_id">
                                Tembusan (Internal)
                            </label>
                            <textarea name="tembusan_internal_id" id="tembusan_internal_id" multiple="multiple" class="form-control">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="tembusan_eksternal_id">
                                Tembusan Eksternal
                            </label>
                            <textarea name="tembusan_eksternal_id" id="tembusan_eksternal_id" multiple="multiple" class="form-control">
                            </textarea>
                        </div>
                    </div>
                </div>
                <fieldset>
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        Verifikator dan Penandatangan Naskah
                    </legend>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="verifikator">
                                    Verifikator <span class="text-danger">*</span>
                                </label>
                                <textarea name="verifikator" rows="4" class="form-control" id="verifikator" placeholder="Masukkan verifikator..." required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="penandatanganan">
                                    Penandatangan <span class="text-danger">*</span>
                                </label>
                                <textarea name="penandatangan" rows="4" class="form-control" id="penandatangan" placeholder="Masukkan penandatangan..." required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-3 mb-md-2">
                                <label class="d-block">
                                    Tipe Tanda Tangan <span class="text-danger">*</span>
                                </label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="ttd" value="TTE" id="TTE" checked>
                                    <label class="custom-control-label" for="TTE">
                                        TTE
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="ttd" value="KONVENSIONAL" id="KONVENSIONAL">
                                    <label class="custom-control-label" for="KONVENSIONAL">
                                        KONVENSIONAL
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left">
                    <b><i class="icon-floppy-disk"></i></b>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title">Ambil Nomor Surat</h5>
                <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-image" style="background-image: url()">
                <form id="inputs" class="needs-validation" novalidate="">
                    <div class="form-group mx-2 mb-3">
                        <label for="ambil_sifat">Sifat</label>
                        <select name="" id="ambil_sifat" class="form-control select2" data-placeholder="Pilih Sifat Naskah..." required>
                            <?php foreach ($sifat as $s) : ?>
                                <option value="<?= $s['kode']; ?>"><?= $s['sifat']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-3">
                        <label for="ambil_indeks">Indeks Org</label>
                        <select name="ambil_indeks" id="ambil_indeks" class="form-control select2" data-placeholder="Pilih Sifat Naskah..." required onchange="showNomor(this.value)">
                            <?php foreach ($indeks as $s) : ?>
                                <option value="<?= $s['kode_seksi']; ?>"><?= $s['kode_seksi']; ?> <?= $s['deskripsi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-3">
                        <label for="ambil_nomor">Nomor Surat</label>
                        <!-- <input name="ambil_nomor" type="text" class="form-control" id="ambil_nomor" placeholder="" required=""> -->
                        <p id="ambil_nomor" class="form-control"></p>
                    </div>
                    
                    <script>
                        function showNomor(str) {
                            if (str == "") {
                                document.getElementById("ambil_nomor").innerHTML = "";
                                return;
                            }
                            const xhttp = new XMLHttpRequest();
                            xhttp.onload = function() {
                                document.getElementById("ambil_nomor").innerHTML = this.responseText;
                            }
                            xhttp.open("GET", "<?= base_url(); ?>/getnomor/" + str);
                            xhttp.send();
                        }
                    </script>

                    <div class="form-group mx-2 mb-3">
                        <label for="ambil_klasifikasi">Klasifikasi</label>
                        <select name="" id="ambil_klasifikasi" class="form-control select2" data-placeholder="Pilih Sifat Naskah..." required>
                            <?php foreach ($klasifikasi as $s) : ?>
                                <option value="<?= $s['kode']; ?>.<?= $s['klasifikasi2']; ?>"><?= $s['kode']; ?>.<?= $s['klasifikasi2']; ?> <?= $s['klasifikasi3']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-3">
                        <label for="ambil_bulan">Bulan</label>
                        <input type="text" class="form-control" id="ambil_bulan" placeholder="Masukkan bulan dalam angka" required="">
                    </div>
                    <div class="form-group mx-2">
                        <label for="ambil_tahun">Tahun</label>
                        <input type="text" class="form-control" id="ambil_tahun" placeholder="Masukkan tahun" required="">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify text-14">
                <button id="submit" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Submit</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#submit, #close").click(function() {
            // Validation
            var form = $("#inputs")

            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.addClass('was-validated')

            //Declare and initialize variable for display inputs in div
            var code = "";
            $("#inputs").each(function() {
                var text1 = $(this).find("#ambil_sifat").val();
                var text2 = $(this).find("#ambil_nomor").html();
                var text3 = $(this).find("#ambil_indeks").val();
                var text4 = $(this).find("#ambil_klasifikasi").val();
                var text5 = $(this).find("#ambil_bulan").val();
                var text6 = $(this).find("#ambil_tahun").val();
                code += text1 + "-" + text2 + "/" + text3 + "/" + text4 + "/" + text5 + "/" + text6;
            });

            // $("#results").html(code);
            $('input[name=nomor]').val(code);

        });
    });
</script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.select2class').select2();
        $('#daterange-single1, #daterange-single2').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD',
                "weekLabel": "M",
                "daysOfWeek": [
                    "Min",
                    "Sen",
                    "Sel",
                    "Rab",
                    "Kam",
                    "Jum",
                    "Sab"
                ],
                "monthNames": [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Augustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ],
            },
        });
    });
</script>