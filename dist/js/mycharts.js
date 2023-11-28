// BARCHART MISKIN EKSTREM BY PEKERJAAN

function createBarChart() {
    fetch('Home/miskinEkstremByPekerjaan')
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        const pekerjaanKategori = data.map(item => item.pekerjaan);
        const jml = data.map(item => item.jml);

        // console.log(pekerjaanKategori);
        // console.log(jml);

        Highcharts.chart('container-bar-pekerjaan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Penduduk Miskin Ekstrem Berdasarkan Jenis Pekerjaan Tahun 2022',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text:
                    'Source: Data P3KE',
                align: 'left'
            },
            xAxis: {
                categories: pekerjaanKategori,
                crosshair: true,
                accessibility: {
                    description: 'Jenis Pekerjaan'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (orang)'
                }
            },
            tooltip: {
                valueSuffix: ' (orang)'
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


// PIE CHART MISKIN EKSTREM BY JENIS KELAMIN
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
    
    
    fetch('Home/miskinEkstremByJk')
    .then(response => response.json())
    .then(data => {

        data2 = data.map(item => {
            item.y = parseFloat(item.y);
            return item;
        });

        console.log(data2);
        
        Highcharts.chart('container-pie-jk', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Persentase Penduduk Miskin Ekstrem Berdasarkan Jenis Kelamin',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text: 'Sumber: Data P3KE',
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
                        format: '<b>{point.name}</b><br>{point.percentage}%',
                        distance: 20
                    },
                    colors: ['#bf0025','#ffa99e']
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

// BAR CHART MISKIN EKSTREM BY PENDIDIKAN

function createBarChartPendidikan() {
    fetch('Home/miskinEkstremByPendidikan')
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        const pendidikanKategori = data.map(item => item.pendidikan);
        const jml = data.map(item => item.jml);

        // console.log(pendidikanKategori);
        // console.log(jml);

        Highcharts.chart('container-bar-pendidikan', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Jumlah Penduduk Miskin Ekstrem Berdasarkan Tingkat Pendidikan Tahun 2022',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text:
                    'Source: Data P3KE',
                align: 'left'
            },
            xAxis: {
                categories: pendidikanKategori,
                crosshair: true,
                accessibility: {
                    description: 'Tingkat Pendidikan'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (orang)'
                }
            },
            tooltip: {
                valueSuffix: ' (orang)'
            },
            plotOptions: {
                bar: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    color: '#9f0010'
                },
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

// PIE CHART BY KEPEMILIKAN RUMAH 

function createPieChartRumah() {
    
    
    fetch('Home/miskinEkstremByRumah')
    .then(response => response.json())
    .then(data => {

        data2 = data.map(item => {
            item.y = parseFloat(item.y);
            return item;
        });

        console.log(data2);
        
        Highcharts.chart('container-pie-rumah', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Persentase Penduduk Miskin Ekstrem Berdasarkan Kepemilikan Rumah',
                align: 'left',
                style: {
                    fontSize: '14' // Change this to your desired font size
                }
            },
            subtitle: {
                text: 'Sumber: Data P3KE',
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
                        format: '<b>{point.name}</b><br>{point.percentage}%',
                        distance: 20
                    },
                    color: ['#66CC99','#66CCCC','#66CCFF','#99CCFF','#99CCCC','#99CC99']
                    
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
createBarChart();
createPieChart();
createBarChartPendidikan();
createPieChartRumah();