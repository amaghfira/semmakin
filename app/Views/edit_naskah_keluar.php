<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Naskah Keluar</h1>
<br>

<div class="card card-primary card-outline" style="border-top: 3px solid #001f3f;">
    <div class="card-header">
        Form Edit Naskah Keluar
    </div> <!-- /.card-body -->
    <div class="card-body">
        <form action="<?= base_url(); ?>/naskah/edit_naskah_keluar" method="post" enctype="multipart/form-data">
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
                                <input type="text" name="sender_user_id" id="sender_user_id" class="form-control" value="<?= $naskah->unit_kerja; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">
                                    Tanggal Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="date" class="form-control" id="daterange-single1" value="<?= $naskah->tgl_naskah; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenis_naskah_id">
                                    Jenis Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="jenis_naskah_id" class="form-control" id="jenis" value="<?= $naskah->jenis; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sifat_naskah_id">
                                    Sifat Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="sifat_naskah_id" class="form-control" id="sifat" value="<?= $naskah->sifat; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="urgensi_naskah_id">
                                    Tingkat Urgensi <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="urgensi_naskah_id" class="form-control" id="urgensi" value="<?= $naskah->urgensi; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nomor" id="jenis_naskah_nomor">
                                    Nomor Naskah <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" name="nomor" id="nomor" class="form-control" value="<?= $naskah->nomor_naskah; ?>"placeholder="Masukkan nomor naskah atau ambil nomor" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="hal">
                                    Hal <span class="text-danger">*</span>
                                </label>
                                <textarea name="hal" rows="7" class="form-control" id="hal" placeholder="Masukkan hal..." required><?= $naskah->hal; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ringkasan">
                                    Isi Ringkas <span class="text-danger">*</span>
                                </label>
                                <textarea name="ringkasan" rows="11" class="form-control" id="ringkasan" placeholder="Masukkan Isi ringkas..." required><?= $naskah->ringkasan; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">
                                    File Naskah <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="file_naskah" class="form-control-uniform-custom" data-show-upload="false" data-show-caption="true" data-show-preview="true" data-fouc>
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
                            <textarea type="text" name="tujuan_internal_id" id="tujuan_internal_id" class="form-control" required><?= $naskah->tujuan_internal; ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="tujuan_eksternal_id">
                                Utama Eksternal <span class="text-danger">*</span>
                            </label>
                            <textarea name="tujuan_eksternal_id" id="tujuan_eksternal_id" multiple="multiple" class="form-control" required><?= $naskah->tujuan_eksternal; ?>
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
                            <textarea name="tembusan_internal_id" id="tembusan_internal_id" multiple="multiple" class="form-control"><?= $naskah->tembusan_internal; ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="tembusan_eksternal_id">
                                Tembusan Eksternal
                            </label>
                            <textarea name="tembusan_eksternal_id" id="tembusan_eksternal_id" multiple="multiple" class="form-control"><?= $naskah->tembusan_eksternal; ?>
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
                                <textarea name="verifikator" rows="4" class="form-control" id="verifikator" placeholder="Masukkan verifikator..." required><?= $naskah->verifikator; ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="penandatanganan">
                                    Penandatangan <span class="text-danger">*</span>
                                </label>
                                <textarea name="penandatangan" rows="4" class="form-control" id="penandatangan" placeholder="Masukkan penandatangan..." required><?= $naskah->penandatangan; ?></textarea>
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
            <input type="hidden" name="id" value="<?= $naskah->id; ?>" />
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success btn-labeled btn-labeled-left">
                    <b><i class="icon-floppy-disk"></i></b>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
