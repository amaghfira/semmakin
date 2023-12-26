document.getElementById('container').innerHTML = "";
document.getElementById('container-treemap').innerHTML = "";

// const highchartsScript = document.createElement('script');
// highchartsScript.src = 'https://code.highcharts.com/highcharts.js';
// document.head.appendChild(highchartsScript);

// const heatmapScript = document.createElement('script');
// heatmapScript.src = 'https://code.highcharts.com/modules/heatmap.js';
// document.head.appendChild(heatmapScript);

// const treemapScript = document.createElement('script');
// treemapScript.src = 'https://code.highcharts.com/modules/treemap.js';
// document.head.appendChild(treemapScript);

// const exportingScript = document.createElement('script');
// exportingScript.src = 'https://code.highcharts.com/modules/exporting.js';
// document.head.appendChild(exportingScript);

// const accessibilityScript = document.createElement('script');
// accessibilityScript.src = 'https://code.highcharts.com/modules/accessibility.js';
// document.head.appendChild(accessibilityScript);

(async () => {

    const data = await fetch(
        'LaporanController/getTreemap'
    ).then(response => response.json());

    let regionP,
        regionVal,
        regionI = 0,
        countryP,
        countryI,
        causeP,
        causeI,
        region,
        country,
        cause;

    const points = [],
        causeName = {};

    // Loop through the data to derive the causeName dynamically
    for (region in data) {
        for (country in data[region]) {
            for (cause in data[region][country]) {
                causeName[cause] = cause; // Use the keys directly from the JSON
            }
        }
    }

    for (region in data) {
        if (Object.hasOwnProperty.call(data, region)) {
            regionVal = 0;
            regionP = {
                id: 'id_' + regionI,
                name: region,
                color: Highcharts.getOptions().colors[regionI]
            };
            countryI = 0;
            for (country in data[region]) {
                if (Object.hasOwnProperty.call(data[region], country)) {
                    countryP = {
                        id: regionP.id + '_' + countryI,
                        name: country,
                        parent: regionP.id
                    };
                    points.push(countryP);
                    causeI = 0;
                    for (cause in data[region][country]) {
                        if (Object.hasOwnProperty.call(
                            data[region][country], cause
                        )) {
                            causeP = {
                                id: countryP.id + '_' + causeI,
                                name: causeName[cause],
                                parent: countryP.id,
                                value: Math.round(+data[region][country][cause])
                            };
                            regionVal += causeP.value;
                            points.push(causeP);
                            causeI = causeI + 1;
                        }
                    }
                    countryI = countryI + 1;
                }
            }
            regionP.value = Math.round(regionVal / countryI);
            points.push(regionP);
            regionI = regionI + 1;
        }
    }

    Highcharts.chart('container-treemap', {
        series: [{
            name: 'Kecamatan',
            type: 'treemap',
            layoutAlgorithm: 'squarified',
            allowDrillToNode: true,
            animationLimit: 1000,
            dataLabels: {
                enabled: false
            },
            levels: [{
                level: 1,
                dataLabels: {
                    enabled: true
                },
                borderWidth: 3,
                levelIsConstant: false
            }, {
                level: 1,
                dataLabels: {
                    style: {
                        fontSize: '14px'
                    }
                }
            }, {
                level: 1,
                colorByPoint: true
            }, {
                level: 3,
                colorVariation: {
                    key: 'brightness',
                    to: 0.8
                }
            }],
            accessibility: {
                exposeAsGroupOnly: true
            },
            data: points
        }],
        subtitle: {
            text: 'Klik kotak pada treemap untuk masuk lebih detail. Sumber: P3KE',
            align: 'left'
        },
        title: {
            text: '',
            align: 'left'
        }
    });
})();
