
function createGrafik3() {
    fetch('LaporanController/getGrafik')
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // IF DATA IS NULL 
            if (!data || data.length === 0) {
                Highcharts.chart('container-tabel3', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: ''
                    },
                    series: [{
                        // If fetchedData is empty, set the series data as null
                        data: data.length === 0 ? null : data,
                        // Other series configurations
                    }],
                    // noData options to display a message when data is empty or null
                    noData: {
                        style: {
                            fontWeight: 'bold',
                            fontSize: '15px',
                            color: '#303030'
                        },
                        position: {
                            align: 'center',
                            verticalAlign: 'middle'
                        },
                        text: 'No data available'
                    }
                });
            } else { //IF NOT NULL SHOW CHART
                const categories = data.map(item => item.kec);

                var seriesData = Object.keys(data[0]).filter(function (key) {
                    return key !== 'kec'; // Exclude 'kec' from series keys
                }).map(function (key) {
                    return {
                        name: key,
                        data: data.map(function (item) {
                            return parseInt(item[key]);
                        })
                    };
                });

                Highcharts.chart('container-tabel3', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        categories: categories,
                        crosshair: true,
                        accessibility: {
                            description: 'Regions'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Number of People'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' people'
                    },
                    series: seriesData
                });
            }
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
        })
}


// CALL FUNCTIONS
createGrafik3();