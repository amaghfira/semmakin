document.getElementById('container-treemap').innerHTML = ""; 
document.getElementById('container').innerHTML = ""; 


function loadHighcharts() {
    // const highchartsScript = document.createElement('script');
    // highchartsScript.src = 'https://code.highcharts.com/highcharts.js';
    // document.head.appendChild(highchartsScript);

    // const exportingScript = document.createElement('script');
    // exportingScript.src = 'https://code.highcharts.com/maps/modules/exporting.js';
    // document.head.appendChild(exportingScript);

    // const accessibilityScript = document.createElement('script');
    // accessibilityScript.src = 'https://code.highcharts.com/modules/accessibility.js';
    // document.head.appendChild(accessibilityScript);
}

async function createGrafik() {
    fetch('LaporanController/getGrafik')
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // IF DATA IS NULL 
            if (!data || !Array.isArray(data) || data.length === 0) {
                Highcharts.chart('container', {
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

                Highcharts.chart('container', {
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
loadHighcharts();
createGrafik();