/**
 * Created by karen on 1/24/16.
 */
$(function () {
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        $.each(data1, function (season, seasonValue) {
            $.each(seasonValue, function (city, value) {
                var pieData = [['Task','Header']];
                $.each(value,function(k,v){
                    pieData.push([v.label, v.value]);
                });
                id = season+'-'+city;

                var data = google.visualization.arrayToDataTable(pieData);
                var options = {
                    title: '',
                    colors: ['#7bb6e8','#f2465d','#5ac1da','#00629d','#db5b28','#8286e3','#f9b5b7','#e6d54c','#71d572','#2a2a2f','#ccd1d4'],
                    chartArea: {left: 0, top: 0, width: "100%", height: '100%'},
                    enableInteractivity: true,
                    legend: {position: 'left', textStyle: {color: '#00629d', bold: true, fontSize: 11, fontName: "Open Sans"}},
                    pieSliceText: 'percentage',
                    reverseCategories: false,
                    width: 350,
                    background: 'white'
                };

                var chart = new google.visualization.PieChart(document.getElementById(id));
                chart.draw(data, options);
            });
        });


        $.each(totals, function (season, value) {
            var pieData = [['Task','Header']];
            $.each(value,function(k,v){
                pieData.push([v.label, v.value]);
            });
            id = season+'-main';

            var data = google.visualization.arrayToDataTable(pieData);
            var options = {
                title: '',
                colors: ['#7bb6e8','#f2465d','#5ac1da','#00629d','#db5b28','#8286e3','#f9b5b7','#e6d54c','#71d572','#2a2a2f','#ccd1d4'],
                chartArea: {left: 0, top: 0, width: "100%", height: '80%'},
                enableInteractivity: true,
                legend: {position: 'left', textStyle: {color: '#00629d', bold: true, fontSize: 11, fontName: "Open Sans"}},
                pieSliceText: 'percentage',
                reverseCategories: false,
                width: 500,
                background: 'white'
            };

            var chart = new google.visualization.PieChart(document.getElementById(id));
            chart.draw(data, options);
        });


        $.each(totalsKG, function (season, value) {
            var pieData = [['Task','Header']];
            $.each(value,function(k,v){
                pieData.push([v.label, v.value]);
            });
            id = season+'-main-kg';

            var data = google.visualization.arrayToDataTable(pieData);
            var options = {
                title: '',
                colors: ['#7bb6e8','#f2465d','#5ac1da','#00629d','#db5b28','#8286e3','#f9b5b7','#e6d54c','#71d572','#2a2a2f','#ccd1d4'],
                chartArea: {left: 0, top: 0, width: "100%", height: '80%'},
                enableInteractivity: true,
                legend: {position: 'left', textStyle: {color: '#00629d', bold: true, fontSize: 11, fontName: "Open Sans"}},
                pieSliceText: 'percentage',
                reverseCategories: false,
                width: 500,
                background: 'white'
            };

            var chart = new google.visualization.PieChart(document.getElementById(id));
            chart.draw(data, options);
        });

        var pieData = [['Task','Header']];
        $.each(recycleTotal,function(k,v){
            pieData.push([v.label, v.value]);
        });
        id = 'recycle-main';
        var data = google.visualization.arrayToDataTable(pieData);
        var options = {
            title: '',
            colors: ['#7bb6e8','#f2465d','#5ac1da','#00629d','#db5b28','#8286e3','#f9b5b7','#e6d54c','#71d572','#2a2a2f','#ccd1d4'],
            chartArea: {left: 0, top: 0, width: "100%", height: '80%'},
            enableInteractivity: true,
            legend: {position: 'left', textStyle: {color: '#00629d', bold: true, fontSize: 11, fontName: "Open Sans"}},
            pieSliceText: 'percentage',
            reverseCategories: false,
            width: 500,
            background: 'white'
        };

        var chart = new google.visualization.PieChart(document.getElementById(id));
        chart.draw(data, options);


        $.each(recycle, function (city, value) {
            var pieData = [['Task','Header']];
            $.each(value,function(k,v){
                pieData.push([v.label, v.value]);
            });
            id = 'recycle-main-'+city;

            var data = google.visualization.arrayToDataTable(pieData);
            var options = {
                title: '',
                colors: ['#7bb6e8','#f2465d','#5ac1da','#00629d','#db5b28','#8286e3','#f9b5b7','#e6d54c','#71d572','#2a2a2f','#ccd1d4'],
                chartArea: {left: 0, top: 0, width: "100%", height: '80%'},
                enableInteractivity: true,
                legend: {position: 'left', textStyle: {color: '#00629d', bold: true, fontSize: 11, fontName: "Open Sans"}},
                pieSliceText: 'percentage',
                reverseCategories: false,
                width: 350,
                background: 'white'
            };

            var chart = new google.visualization.PieChart(document.getElementById(id));
            chart.draw(data, options);
        });

    }
});
