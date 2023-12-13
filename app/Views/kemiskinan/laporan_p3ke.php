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
        <option value="2">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Kelamin</option>
        <option value="3">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Pekerjaan</option>
        <option value="4">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Pendidikan</option>
        <option value="5">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Status Kepemilikan Rumah</option>
        <option value="6">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Simpanan</option>
        <option value="7">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Atap</option>
        <option value="8">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Dinding</option>
        <option value="9">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Jenis Lantai</option>
        <option value="10">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Sumber Penerangan</option>
        <option value="11">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Bahan Bakar Memasak</option>
        <option value="12">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Sumber Air Minum</option>
        <option value="13">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Fasilitas BAB</option>
        <option value="14">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima BNP</option>
        <option value="15">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima BPU</option>
        <option value="16">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima BST</option>
        <option value="17">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima PKH</option>
        <option value="18">Jumlah Penduduk Miskin Ekstrem Berdasarkan Kecamatan dan Penerima Sembako</option>
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
                case "2":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "3":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "4":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "5":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "6":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "7":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "8":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "9":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "10":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "11":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "12":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "13":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "14":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "15":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "16":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "17":
                    while (currentYear >= earliestYear) {
                        options += `<option value='${currentYear}'>${currentYear}</option>`;
                        currentYear -= 1;
                    }
                    break;
                case "18":
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
                                if (!isNaN(yearAsNumber) && yearAsNumber == 2022) {
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