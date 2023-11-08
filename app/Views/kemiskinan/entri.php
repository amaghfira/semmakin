<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Pilih jenis form</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis quas exercitationem cupiditate alias hic accusantium. Itaque id dolore dignissimos atque aperiam illum assumenda ea? Tenetur distinctio cupiditate sequi voluptate fugiat.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, a. Minima perspiciatis blanditiis quibusdam perferendis cumque? Quasi, dolor labore? Autem nostrum maxime facere minima deserunt neque, inventore labore odit molestias!</p>
                <br>
                <hr>
                <div class="mb-3">
                    <label for="formSelector" class="form-label">Jenis Form</label>
                    <select name="formSelector" id="formSelector" class="form-control form-select">
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
                } else {
                    $('#formContainer').html('');
                }
            } else {
                $('#formContainer').html('');
            }
        });
    });
</script>