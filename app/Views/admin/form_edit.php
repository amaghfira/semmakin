<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Interpretasi Data</h5>
        <p class="mb-0">Silakan menambahkan interpretasi data melalui form berikut: </p>
        <br>
        <!-- FORM STARTS HERE -->

        <form action="<?= base_url(); ?>/AdminController/update" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="data" class="form-label">Pilih data</label>
                <select name="data" id="data" class="form-control form-select" required>
                    <option value="" selected>Pilih data...</option>
                    <?php foreach ($menus as $s) : ?>
                        <option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-control form-select" required>
                    <option value="" selected>Pilih Tahun...</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="deskripsi">Masukkan Interpretasi Data</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Saya yakin data yang diisikan sudah benar dan dapat dipertanggung jawabkan.</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- FORM ENDS HERE -->
    </div>
</div>