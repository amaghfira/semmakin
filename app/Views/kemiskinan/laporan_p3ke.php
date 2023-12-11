<ul class="breadcrumb">
    <li><a href="<?= base_url(); ?>">Home</a></li>
    <li><a href="<?= base_url(); ?>/analisis">Analisis</a></li>
    <li>P3KE</li>
</ul>

<h5 class="card-title fw-semibold mb-4"> Analisis Kemiskinan Daerah Data P3KE</h5>
<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, ipsa. Voluptas dolorem tenetur rem voluptates sit deleniti dicta, temporibus ipsam, placeat possimus numquam, aut inventore. Architecto repellendus odit non eos?</p>
<br>
<div class="dropdownYearSelector">
    <label for="dropdownYearSelector" class="label">Pilih Jenis Data dan Tahun</label>
    <select id="dropdownDataSelector" class="form-select">
        <option value="pilih">Pilih Data...</option>
        <option value="2">Jumlah </option>
        <option value="3">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Pekerjaan</option>
    </select>
    <select id="dropdownYearSelector" class="form-select">
        <option value="pilih">Pilih Tahun...</option>
    </select>
</div>

<script>
    let dateDropdown = document.getElementById('dropdownYearSelector');

    let currentYear = new Date().getFullYear();
    let earliestYear = 2020;
    while (currentYear >= earliestYear) {
        let dateOption = document.createElement('option');
        dateOption.text = currentYear;
        dateOption.value = currentYear;
        dateOption.style = "display: none;"
        dateDropdown.add(dateOption);
        currentYear -= 1;
    }
</script>

<br>
<div class="card">
    <div class="card-body">


        <div id="dropdownContainer"></div>

    </div>
</div>


<script>
    $(document).ready(function() {
        $('#dropdownDataSelector').change(function() {
            $('#dropdownYearSelector').children('option:not(:first)').hide();
            var selectedData = $(this).val();
            if (selectedData) {
                if (selectedData != 'pilih') {
                    $('#dropdownYearSelector').show();
                    $('#dropdownYearSelector').children('option:not(:first)').show();
                    var dataAsNumber = parseInt(selectedData, 10);
                    // IF DATA IS SELECTED
                    if (!isNaN(dataAsNumber)) {
                        $('#dropdownYearSelector').change(function() {
                            var selectedYear = $(this).val();
                            if (selectedYear) {
                                var yearAsNumber = parseInt(selectedYear, 10);
                                // IF YEAR IS CHOSEN AND MORE THAN 2022
                                if (!isNaN(yearAsNumber) && yearAsNumber >= 2022) {
                                    var postData = {
                                        year: selectedYear,
                                        data: selectedData
                                    };
                                    // AJAX call with both selected year and data
                                    $.ajax({
                                        url: '<?= site_url('LaporanController/getData') ?>',
                                        method: 'POST',
                                        data: postData,
                                        success: function(response) {
                                            $('#dropdownContainer').html(response.form);
                                        }
                                    });
                                } else {
                                    $('#dropdownContainer').html('Data tidak tersedia.');
                                }
                            }
                        });
                    } else {
                        $('#dropdownContainer').html('Data tidak tersedia.');
                    }
                } else {
                    // If no data is selected, hide and reset the year select
                    $('#dropdownYearSelector').children('option:not(:first)').hide();
                    $('#dropdownYearSelector').val('pilih');
                }

            }
        });
    });
</script>