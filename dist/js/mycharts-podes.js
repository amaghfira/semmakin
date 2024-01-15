// BARCHART MISKIN EKSTREM BY PEKERJAAN

function createBarChart() {
    fetch('Home/jmlBalaiPengobatanByKec')
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        const kecKategori = data.map(item => item['nama kecamatan']);
        const jml = data.map(item => item['jumlah poliklinik']);

        // console.log(kecKategori);
        // console.log(jml);

        Highcharts.chart('container-bar-pengobatan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Balai Pengobatan Berdasarkan Kecamatan Tahun 2021',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text:
                    'Source: Data Podes',
                align: 'left'
            },
            xAxis: {
                categories: kecKategori,
                crosshair: true,
                accessibility: {
                    description: 'Kecamatan'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (fasilitas)'
                }
            },
            tooltip: {
                valueSuffix: ' (fasilitas)'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    color: '#ff6f6a'
                }
            },
            series: [
                {
                    name: 'jumlah',
                    data: jml.map(Number)
                }
            ]
        });
    })
    .catch(error => {
        console.error('Error fetching data: ' , error);
    })
}


function createStackedBarChart() {
    fetch('Home/desaMenurutSumberAirMinum')
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        const kecKategori = data.map(item => item['nama desa']);
        const jml_1 = data.map(item => item['jumlah dokter umum\/spesialis']);
        const jml_2 = data.map(item => item['jumlah dokter spesialis gigi']);
        const jml_3 = data.map(item => item['jumlah bidan']);
        const jml_4 = data.map(item => item['jumlah tenaga kesehatan lainnya']);
        const jml_5 = data.map(item => item['dukun bayi']);

        // console.log(kecKategori);
        // console.log(jml);

        Highcharts.chart('container-bar-air', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Jumlah Balai Pengobatan Berdasarkan Kecamatan Tahun 2021',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text:
                    'Source: Data Podes',
                align: 'left'
            },
            xAxis: {
                categories: kecKategori
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            legend: {
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [
                {
                    name: 'jumlah dokter umum\/spesialis',
                    data: jml_1.map(Number)
                },
                {
                    name: 'jumlah dokter spesialis gigi',
                    data: jml_2.map(Number)
                },
                {
                    name: 'jumlah bidan',
                    data: jml_3.map(Number)
                },
                {
                    name: 'jumlah tenaga kesehatan lainnya',
                    data: jml_4.map(Number)
                },
                {
                    name: 'dukun bayi',
                    data: jml_5.map(Number)
                }
            ]
        });
    })
    .catch(error => {
        console.error('Error fetching data: ' , error);
    })
}

// CALL CHARTS 
createBarChart();
createStackedBarChart();

