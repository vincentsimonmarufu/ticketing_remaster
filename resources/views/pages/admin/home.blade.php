@extends('layouts.app')

@section('template_title')
    Welcome {{ Auth::user()->name }}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css')}}"> 
<style>

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
    .attending-head{
        padding: 0 15px;
        
    }
    .attending-head h3{
        font-weight: lighter;
        margin: 0;
        font-size: 1.4rem;
    }
    .users-head h4{
            font-size: 20px;
            font-weight: 600;
        }
        .users-head p{
            font-size: 13px;
            color: #919aa3;
        }
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css')}}">
@endsection

@section('content')

    <div class="container mb-4">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-2 mb-1">
                <div class="card bg-danger card_cat">
                    <div class="card-body">
                        <p class="text-white more">{{ $category->name }}</p>
                        <hr class="cat-divider">
                        <p class="more text-white "><a href="{{ url('/ticket_by_cat/ ' . $category->id . '/' . $category->name ) }}">More details</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row  layout-spacing">
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
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12">

                <div class="users-head">
                    <h4>Tickets in Progress </h4>
                    <p>Overview of tickets being resolved by other Users </p>
                </div>
        
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4">
                        <table id="default-ordering" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ref: no</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>User Attending</th>
                                    <th>Date raised</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets_attended as $item)
                                <tr>
                                    <td>{{ $item->key }}</td>
                                    <td>{{ $item->email}}</td>
                                    <td>{{ $item->subject}}</td>
                                    <td>{{ $item->description}}</td>
                                    <td>{{ $item->resolved_by}}</td>
                                    <td>{{ $item->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
    <script>        
        $('#default-ordering').DataTable( {
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "order": [[ 3, "desc" ]],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
	    } );
    </script>

@endsection
