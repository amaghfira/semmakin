const highchartsScript = document.createElement('script');
highchartsScript.src = 'https://code.highcharts.com/maps/highmaps.js';
document.head.appendChild(highchartsScript);

function createMapDtks() {
    (async () => {

        const mapData = await fetch(
            'Kemiskinan/petaDesa'
        ).then(response => response.json());
    
        const data = await fetch(
            'Kemiskinan/miskinEkstremByDesa'
        ).then(response => response.json());
    
        // Initialize the chart
        Highcharts.mapChart('container-map-dtks', {
            title: {
                text: ''
            },
            subtitle: {
                text: 'sumber data: DTKS'
            },
    
            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },
    
            mapView: {
                projection: {
                    name: 'WebMercator'
                },
                center: [117.2, 0.8],
                zoom: 8
            },
    
            colorAxis: {
                min: 1,
                max: 150,
                type: 'logarithmic'
            },
    
            legend: {
                title: {
                    text: 'Jumlah miskin ekstrem'
                }
            },
    
            series: [{
                data,
                mapData,
                joinBy: ['name', 'desa'],
                name: 'Jumalah miskin ekstrem',
                tooltip: {
                    pointFormat: '{point.value} ORANG <br> DESA {point.properties.name}, <br> KEC. {point.properties.nmkec}',
    
                }
            }]
        });
    })();
}

// PANGGGIL PETA
// createMapP3ke();
createMapDtks();