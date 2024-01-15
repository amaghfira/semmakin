<ul class="breadcrumb">
    <li><a href="<?= base_url(); ?>">Home</a></li>
    <li><a href="<?= base_url(); ?>/analisis">Analisis</a></li>
    <li>Podes</li>
</ul>

<h5 class="card-title fw-semibold mb-4"> Analisis Kemiskinan Daerah Data POdes 2021</h5>
<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, ipsa. Voluptas dolorem tenetur rem voluptates sit deleniti dicta, temporibus ipsam, placeat possimus numquam, aut inventore. Architecto repellendus odit non eos?</p>
<br>

<!-- <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Choropleth Map Kemiskinan Ekstrem di Kutai Timur</h5>
            <p class="mb-0">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias eos laboriosam officiis hic provident. Incidunt odio est, voluptatum, rem autem veniam sapiente porro perspiciatis aspernatur, dignissimos eius similique fugiat. Illo.</p>

            <div id="container-map"></div>
        </div>
    </div>
</div> -->

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
        let earliestYear = 2021;

        $("#dropdownDataSelector").change(function() {
            let currentYear = new Date().getFullYear(); // Reset currentYear on each change
            var val = $(this).val();
            let options = `<option value='0'>Pilih Tahun...</option>`;;
            switch (val) {
                case "37":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "38":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "39":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "40":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "41":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "42":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "43":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "44":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "45":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "46":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "47":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "48":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "49":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "50":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "51":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "52":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "53":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "54":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                case "55":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                case "56":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                case "57":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                case "58":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                case "59":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "60":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "61":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "62":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "63":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "64":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "65":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "66":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "67":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "68":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "69":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "70":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "71":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "72":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "73":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "74":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "75":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "76":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    case "77":
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
                                // IF YEAR IS CHOSEN AND = 2021
                                if (!isNaN(yearAsNumber) && yearAsNumber == 2021) {
                                    var postData = {
                                        year: selectedYear,
                                        data: selectedData
                                    };
                                    // AJAX call with both selected year and data
                                    $.ajax({
                                        url: '<?= site_url('LaporanController/getDataPodes') ?>',
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

<!-- <script src="<?= base_url(); ?>/dist/js/visualisasichart.js"></script> -->