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
    fetch('LaporanController/getData')
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            // IF DATA IS NOT NULL 
            if (data && data.newData && typeof data.newData === 'object') {
                const newData = data.newData;
                const categories = newData.map(item => item.kec);

                var seriesData = Object.keys(newData[0]).filter(function (key) {
                    return key !== 'kec'; // Exclude 'kec' from series keys
                }).map(function (key) {
                    return {
                        name: key,
                        data: newData.map(function (item) {
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
            } else { //IF NOT NULL SHOW CHART
                console.error("No valid data in the response.");
            }
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
        })
}


// CALL FUNCTIONS
loadHighcharts();
createGrafik();