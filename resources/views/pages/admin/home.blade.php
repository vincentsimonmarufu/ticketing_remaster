@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css')}}"> 
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
    .ticket-count{
        font-weight: bold;
        color: red;
    }
</style>
@endsection

@section('content')

    <div class="container mb-4">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-2 mb-1">
                <div class="card bg-danger card_cat">
                    <div class="card-body">
                        <h3 class="category-heading text-white">12</h3>
                        <p class="text-white more">{{ $category->name }}</p>
                        <hr class="cat-divider">
                        <p class="more text-white text-center"><a href="{{ url('/ticket_by_cat/ ' . $category->id . '/' . $category->name ) }}">More details</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container layout-spacing">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 mb-2">

                <div id="myChart"></div>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="widget-four">
                    <div class="widget-heading">
                        <h5 class="">Tickets Status <span class="float-right "> {{ $tickets_total_count }} total</span></h5>
                    </div>
                    <div class="widget-content">
                        <div class="vistorsBrowser">
                            <div class="browser-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                </div>
                                <div class="w-browser-details">
                                    <div class="w-browser-info">
                                    <h6><a href="{{ url('ticket_by_status/0/Unattended')}}">Unattended (<span class="ticket-count" > {{ $unattended_count }} </span>)</a></h6>
                                        <p class="browser-count">{{ $unattended_percent }}%</p>
                                    </div>
                                    <div class="w-browser-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $unattended_percent }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="browser-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                </div>
                                <div class="w-browser-details">
                                    
                                    <div class="w-browser-info">
                                        <h6><a href="{{ url('ticket_by_status/1/Pending')}}">Pending (<span class="ticket-count"> {{ $pending_count }} </span>) </a></h6>
                                    <p class="browser-count">{{ $pending_percent }}%</p>
                                    </div>

                                    <div class="w-browser-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: {{ $pending_percent }}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="browser-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                </div>
                                <div class="w-browser-details">
                                    
                                    <div class="w-browser-info">
                                        <h6><a href="{{ url('ticket_by_status/2/Resolved')}}">Resolved (<span class="ticket-count" > {{ $resolved_count }} </span>)</a> </h6>
                                    <p class="browser-count">{{ $resolved_percent }}%</p>
                                    </div>

                                    <div class="w-browser-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{ $resolved_percent }}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="browser-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                </div>
                                <div class="w-browser-details">
                                    
                                    <div class="w-browser-info">
                                        <h6><a href="{{ url('ticket_by_status/3/Escalated')}}">Escalated (<span class="ticket-count" > {{ $escalated_count }} </span>)</a> </h6>
                                    <p class="browser-count">{{ $escalated_percent }}%</p>
                                    </div>

                                    <div class="w-browser-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{ $escalated_percent }}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="{{ asset('assets/js/widgets/modules-widgets.js')}}"></script>

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

            name: 'Tickets',

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
