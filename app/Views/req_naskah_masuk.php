<style>
    .selectBox {
        position: relative;
    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
    }

    #checkboxes label {
        display: block;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }
</style>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Registrasi Naskah Masuk</h1>
<br>

<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Form Registrasi Naskah Masuk
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form action="<?= base_url(); ?>/submit-naskah-masuk" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="Q70fIDqXHasbqdo74fFfIqwGLGs4BAJQTcAIEAIF">
            <div class="card-body">
                <fieldset>
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        Identitas Pengirim Naskah
                    </legend>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama_pengirim">
                                    Nama Pengirim <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" placeholder="Masukkan nama pengirim..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="jabatan_pengirim">
                                    Jabatan Pengirim <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="jabatan_pengirim" id="jabatan_pengirim" class="form-control" placeholder="Masukkan nama pengirim..." value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="instansi_pengirim">
                                    Instansi Pengirim <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="instansi_pengirim" id="instansi_pengirim" class="form-control" placeholder="Masukkan instansi pengirim..." value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="font-weight-semibold text-uppercase font-size-sm">
                        Detail Isi Naskah
                    </legend>
                    <div class="row">
                        <div class="col-sm-6">
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
                            <div class="form-group">
                                <label for="nomor">
                                    Nomor Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nomor" id="nomor" class="form-control" placeholder="Masukkan nomor naskah..." value="" required>
                                </div>
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
                                <label for="tanggal">
                                    Tanggal Diterima <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="received_at" class="form-control" id="daterange-single2" value="" required>
                                </div>
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
                                <textarea name="ringkasan" rows="11" class="form-control" id="ringkasan" placeholder="Masukkan Isi ringkasan..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">
                                    File Naskah <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="file_naskah" class="form-control-uniform-custom" data-show-upload="false" data-show-caption="true" data-show-preview="true" data-fouc required>
                                <span class="text-muted form-text">
                                    Format yang didukung: .PDF
                                </span>
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
                                <b>Mohon memberikan nama file lampiran yang tepat dan benar, tidak
                                    menggunakan unsur (titik), (koma), symbol (!@#$%^&* ( ) ) </b>
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
                            <div class="form-group">
                                <label for="tujuan_id">
                                    Utama <span class="text-danger">*</span>
                                </label>
                                <textarea name="tujuan_id" rows="5" class="form-control" id="tujuan_id" placeholder="Masukkan tujuan" required></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                Tujuan Tembusan
                            </legend>
                            <div class="form-group">
                                <label for="tembusan_id">Tembusan</label>
                                <textarea name="tembusan_id" rows="5" class="form-control" id="tembusan_id" placeholder="Masukkan tembusan"></textarea>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset>
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                Disposisi
                            </legend>
                            <span class="text-muted form-text">
                                *Pilih nama dengan memberikan centang. Email notifikasi akan dikirim ke nama yang terpilih.
                            </span>
                            <br>
                            <div class="form-group" style="height:200px; overflow-y:scroll;">
                                <?php foreach ($pegawai as $p) : ?>
                                    <label><input type="checkbox" name="disposisi[]" value="<?= $p['email']; ?>" />&nbsp;&nbsp;<?= $p['nama']; ?></label><br>
                                <?php endforeach; ?>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left">
                    <b><i class="icon-floppy-disk"></i></b>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

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