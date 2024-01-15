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
<iframe src=https://ee.kobotoolbox.org/x/dOFHc1Ci width="1000" height="900"></iframe>

<!-- ini buat testing aja  -->
<!-- <form action="<?= base_url(); ?>/submit-podes" method="post">
    <label for="">Nama prov</label>
    <input type="text" name="_Provinsi" value="Kaltim">
    <label for="">Nama Kab</label>
    <input type="text" name="_102_Kabupaten_Kota" value="Kutim">
    <button type="submit">Submit</button>
</form> -->