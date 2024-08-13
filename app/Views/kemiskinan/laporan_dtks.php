<ul class="breadcrumb">
    <li><a href="<?= base_url(); ?>">Home</a></li>
    <li><a href="<?= base_url(); ?>/analisis">Analisis</a></li>
    <li>DTKS</li>
</ul>

<h5 class="card-title fw-semibold mb-4"> Analisis Kemiskinan Daerah Data DTKS</h5>
<p class="mb-0"></p>
<br>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Peta Kemiskinan Ekstrem di Kutai Timur</h5>
            <div id="container-map"></div>
        </div>
    </div>
</div>

<br>
<div class="dropdownYearSelector">
    <label for="dropdownYearSelector" class="label">Pilih Jenis Data dan Tahun</label>
    <select id="dropdownDataSelector" class="form-select">
        <option value="pilih">Pilih Data...</option>
        <?php foreach ($menus as $menu) : ?>
            <option value="<?= $menu['id']; ?>"><?= $menu['nama']; ?></option>
        <?php endforeach; ?>
    </select>
    <select id="dropdownYearSelector" class="form-select">
        <option value="0">Pilih Tahun...</option>
    </select>
</div>

<script>
    $(document).ready(function() {
        let earliestYear = 2020;

        $("#dropdownDataSelector").change(function() {
            let currentYear = new Date().getFullYear(); // Reset currentYear on each change
            var val = $(this).val();
            let options = `<option value='0'>Pilih Tahun...</option>`;;
            switch (val) {
                case "78":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "79":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "80":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "81":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "82":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "83":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "84":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "85":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "86":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "87":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "88":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "89":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "90":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "91":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "92":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "93":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                default:
                    break;
            }
            $("#dropdownYearSelector").html(options);
        });
    });
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
                                // IF YEAR IS CHOSEN AND = 2022
                                if (!isNaN(yearAsNumber) && yearAsNumber == 2020) {
                                    var postData = {
                                        year: selectedYear,
                                        data: selectedData
                                    };
                                    // AJAX call with both selected year and data
                                    $.ajax({
                                        url: '<?= site_url('LaporanController/getDataDtks') ?>',
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

<script src="<?= base_url(); ?>/dist/js/p3kemaps.js"></script>
