<!DOCTYPE html>

<html>

<head>

    <title>Laravel 8 Highcharts Example - ItSolutionStuff.com</title>

</head>

   

<body>

<h1>Laravel 8 Highcharts Example - ItSolutionStuff.com</h1>

<div id="container"></div>

</body>

  

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">

    var users =  <?php echo json_encode($users) ?>;

   

    Highcharts.chart('container', {

        title: {

            text: 'New User Growth, 2019'

        },

        subtitle: {

            text: 'Source: itsolutionstuff.com.com'

        },

         xAxis: {

            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

        },

        yAxis: {

            title: {

                text: 'Number of New Users'

            }

        },

        legend: {

            layout: 'vertical',

            align: 'right',

            verticalAlign: 'middle'

        },

        plotOptions: {

            series: {

                allowPointSelect: true

            }

        },

        series: [{

            name: 'New Users',

            data: users

        }],

        responsive: {

            rules: [{

                condition: {

                    maxWidth: 500

                },

                chartOptions: {

                    legend: {

                        layout: 'horizontal',

                        align: 'center',

                        verticalAlign: 'bottom'

                    }

                }

            }]

        }

});

</script>

</html>