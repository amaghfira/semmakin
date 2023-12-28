<link rel="stylesheet" href="<?= base_url(); ?>/dist/css/mychartcss.css">
<h5 style="font-weight: bold ;">Dashboard Kemiskinan Daerah</h5>
<!-- Row 0 -->
<div class="row">
    <div class="col-lg-8"></div>
    <div class="col-lg-4">
        <div>
            <b><label for="form-select">Pilih Sumber Data:</label></b>
            <select name="formSelector" id="formSelector" class="form-control form-select">
                <option value="1">P3KE</option>
                <option value="2">DTKS</option>
                <option value="3">PODES</option>
            </select>
        </div>
    </div>
</div>
<br>
<div class="row" id="formContainer"></div>

<script>
    $(document).ready(function() {
        $('#formSelector').change(function() {
            var selectedForm = $(this).val();
            if (selectedForm) {
                if (selectedForm === "1") {
                    $.ajax({
                        url: '<?= site_url('Home/getP3keHome') ?>',
                        method: 'GET',
                        success: function(response) {
                            console.log(response);
                            $('#formContainer').html(response.form);
                        }
                    });
                } else if (selectedForm === "2") {
                    $.ajax({
                        url: '<?= site_url('Home/getDtksHome') ?>',
                        method: 'GET',
                        success: function(response) {
                            $('#formContainer').html(response.form);
                        }
                    });
                } else {
                    $.ajax({
                        url: '<?= site_url('Home/getPodesHome') ?>',
                        method: 'GET',
                        success: function(response) {
                            $('#formContainer').html(response.form);
                        }
                    });
                }
            } else { //if not selected show p3ke home 
                $.ajax({
                    url: '<?= site_url('Home/getP3keHome') ?>',
                    method: 'GET',
                    success: function(response) {
                        $('#formContainer').html(response.form);
                    }
                });
            }
        });

        // Load P3KE Home initially when the page loads
        $.ajax({
            url: '<?= site_url('Home/getP3keHome') ?>',
            method: 'GET',
            success: function(response) {
                $('#formContainer').html(response.form);
            }
        });
    });
</script>