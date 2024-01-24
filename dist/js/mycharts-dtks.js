// BARCHART MISKIN EKSTREM BY PEKERJAAN

function createColumnChart() {
    fetch('Home/rutaMenurutStatus')
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

                Highcharts.chart('container-column', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Banyaknya rumah tangga menurut kecamatan dan status kesejahteraan',
                        align: 'left',
                        style: {
                            fontSize: '14' // Change this to your desired font size
                        }
                    },
                    subtitle: {
                        text: 'Sumber: Data DTKS',
                        align: 'left'
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
                            text: 'Jumlah RUTA'
                        }
                    },
                    tooltip: {
                        valueSuffix: 'Ruta'
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

// PIE CHART
(function (H) {
    H.seriesTypes.pie.prototype.animate = function (init) {
        const series = this,
            chart = series.chart,
            points = series.points,
            {
                animation
            } = series.options,
            {
                startAngleRad
            } = series;

        function fanAnimate(point, startAngleRad) {
            const graphic = point.graphic,
                args = point.shapeArgs;

            if (graphic && args) {

                graphic
                    // Set inital animation values
                    .attr({
                        start: startAngleRad,
                        end: startAngleRad,
                        opacity: 1
                    })
                    // Animate to the final position
                    .animate({
                        start: args.start,
                        end: args.end
                    }, {
                        duration: animation.duration / points.length
                    }, function () {
                        // On complete, start animating the next point
                        if (points[point.index + 1]) {
                            fanAnimate(points[point.index + 1], args.end);
                        }
                        // On the last point, fade in the data labels, then
                        // apply the inner size
                        if (point.index === series.points.length - 1) {
                            series.dataLabelsGroup.animate({
                                opacity: 1
                            },
                            void 0,
                            function () {
                                points.forEach(point => {
                                    point.opacity = 1;
                                });
                                series.update({
                                    enableMouseTracking: true
                                }, false);
                                chart.update({
                                    plotOptions: {
                                        pie: {
                                            innerSize: '30%',
                                            borderRadius: 8
                                        }
                                    }
                                });
                            });
                        }
                    });
            }
        }

        if (init) {
            // Hide points on init
            points.forEach(point => {
                point.opacity = 0;
            });
        } else {
            fanAnimate(points[0], startAngleRad);
        }
    };
}(Highcharts));

function createPieChart() {
    
    
    fetch('Home/rutaMenurutSumberAir')
    .then(response => response.json())
    .then(data => {

        data2 = data.map(item => {
            item.y = parseFloat(item.y);
            return item;
        });

        console.log(data2);
        
        Highcharts.chart('container-pie', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Banyaknya ruta berdasarkan sumber air minum',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text: 'Sumber: Data DTKS',
                align: 'left'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    borderWidth: 2,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage: .1f}%',
                        distance: 20
                    },
                    colors: ['#f2cc8f','#babf95','#81b29a','#5f797b','#3d405b','#8f5d5d','#e07a5f','#f4f1de','#013a63']
                }
            },
            series: [{
                // Disable mouse tracking on load, enable after custom animation
                enableMouseTracking: false,
                animation: {
                    duration: 2000
                },
                colorByPoint: true,
                data: data2
            }]
        });
    })
    
}

// CALL CHARTS 
createColumnChart();
createPieChart();