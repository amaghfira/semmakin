<div class="card">
    <?php if (session()->has('pesan')) : ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?> alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <script>
            setTimeout(function() {
                document.querySelector('.alert').remove();
            }, 5000); // Adjust the time in milliseconds (e.g., 5000 = 5 seconds)
        </script>
    <?php endif; ?>

    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Interpretasi Data</h5>
        <p class="mb-0">Silakan menambahkan interpretasi data melalui form berikut: </p>
        <br>
        <!-- FORM STARTS HERE -->

        <form action="<?= base_url(); ?>/AdminController/update" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tabel" class="form-label">Pilih tabel</label>
                <select name="tabel" id="tabel" class="form-control form-select" required>
                    <option value="" selected>Pilih tabel...</option>
                    <?php foreach ($menus as $s) : ?>
                        <option value="<?= $s['id'] ?>"><?= $s['id'] ?>. [ <?= $s['sumber'] ?> ] <?= $s['nama'] ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-control form-select" required>
                    <option value="" selected>Pilih Tahun...</option>
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

<script>
    $(document).ready(function() {
        let earliestYear = 2020;

        $('#tabel').change(function() {
            let currentYear = new Date().getFullYear(); // Reset currentYear on each change
            var val = $(this).val();
            let options = `<option value='0'>Pilih Tahun...</option>`;

            while (currentYear >= earliestYear) {
                options += `<option value='${currentYear}'>${currentYear}</option>`;
                currentYear -= 1;
            }
            $("#tahun").html(options);
        });
    });
</script>