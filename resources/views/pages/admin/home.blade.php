@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('template_linked_css')
<style>
    .category-heading{
        margin: 0;
        padding: 0;
        letter-spacing: .3rem
    }
    .more{
        padding-bottom: 0;
        margin-bottom: 0;
    }

    hr.cat-divider {
        margin-top: 10px;
        margin-bottom: 5px;
    }
    p.more a{
        font-size: 12px;
        color: white;
    }
    .card-body{
        padding-bottom: .7rem;
    }
</style>
@endsection

@section('content')

    <div class="container mb-4">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-3">
                <div class="card bg-danger card_cat">
                    <div class="card-body">
                        <h3 class="category-heading text-white">12</h3>
                        <p class="text-white more">{{ $category->name }}</p>
                        <hr class="cat-divider">
                        <p class="more text-white text-center"><a href="{{ url('/ticket_by_cat/ ' . $category->id . '/' . $category->name ) }}">View More details</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container layout-spacing">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div id="myChart"></div>

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">

    var users =  <?php echo json_encode($tickets) ?>;

   

    Highcharts.chart('myChart', {

        title: {

            text: 'Tickets Resolved Status 2021'

        },

        subtitle: {

            text: 'Source: whelson.co.zw@ticketing'

        },

         xAxis: {

            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

        },

        yAxis: {

            title: {

                text: 'Number of Tickets'

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

            name: 'New Tickets',

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

@endsection
