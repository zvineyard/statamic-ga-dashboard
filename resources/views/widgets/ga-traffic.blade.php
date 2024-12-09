<div class="card p-8 content">
    <h1>Google Analytics Traffic</h1>
    <!-- Load plotly.js into the DOM -->
    <script src='https://cdn.plot.ly/plotly-2.35.2.min.js'></script>
    <div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>
    <style>
        .g-xtitle {
            padding-top:20px!important;
        }
    </style>
    <script>
        /*
        var trace1 = {
          x: {{ json_encode($x) }},
          y: {{ json_encode($y) }},
          mode: 'scatter',
          name: 'Active Users'
        };

        var trace2 = {
          x: {{ json_encode($x) }},
          y: {{ json_encode($y2) }},
          mode: 'scatter',
          name: 'Pageviews'
        };

        var data = [trace1,trace2];
        */

        var layout = {
            //title: 'Scroll and Zoom',
            showlegend: true,
            xaxis: {
                title: 'Past {{ $number_of_days }} Days',
                tickmode: 'linear',
                type: 'date',
                tickangle: -45,
                autorage: true,
                label: 'none',
                tickformat: '%d %b',
                range: {!! json_encode($range) !!}
            },
            yaxis: {
                title: 'Active Users / Pageviews'
            },
        };
        
        //Plotly.newPlot('myDiv', data, layout, {displayModeBar: true});

        var data = [
        {
            x: {!! json_encode($x) !!},
            y: {!! json_encode($y) !!},
            type: 'scatter',
            mode: 'lines+markers',
            name: 'Active Users',
            line: {color: '#7F7F7F'}
        },
        {
            x: {!! json_encode($x) !!},
            y: {!! json_encode($y2) !!},
            type: 'scatter',
            mode: 'lines+markers',
            name: 'Pageviews',
            line: {color: '#17BECF'}
        }
        ];

        Plotly.newPlot('myDiv', data, layout, {displayModeBar: false});

    </script>

</div>