@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
    </div>

    <div class="row">
        @include('layouts.components.card', [
            'textclass' => 'primary',
            'title' => 'Total Users',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $users->count(),
        ])
        @include('layouts.components.card', [
            'textclass' => 'info',
            'title' => 'Applicants',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $roles->where('name','=','applicant')->pluck('userCount')[0],
        ])
        @include('layouts.components.card', [
            'textclass' => 'warning',
            'title' => 'Moderators',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $roles->where('name','=','moderator')->pluck('userCount')[0],
        ])
        @include('layouts.components.card', [
            'textclass' => 'success',
            'title' => 'Monitors',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $roles->where('name','=','monitor')->pluck('userCount')[0],
        ])
    </div>

    <div class="row">
        @include('layouts.components.areachart', [
            'id' => 'regAreaChart',
            'heading' => 'Registration Status',
        ])
        @include('layouts.components.piechart', [
            'id' => 'userPieChart',
            'heading' => 'User Distribution',
            'items' => $roles->pluck('name')->toArray(),
        ])
    </div>

</div>

@endsection

@push('scripts')
<script>
    // Registrations Area Chart
    var ctx = document.getElementById("regAreaChart");
    var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
        label: "Registrations",
        lineTension: 0,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [
             {{ $userMonthCount[1] }}, {{ $userMonthCount[2] }}, {{ $userMonthCount[3] }},
             {{ $userMonthCount[4] }}, {{ $userMonthCount[5] }}, {{ $userMonthCount[6] }},
             {{ $userMonthCount[7] }}, {{ $userMonthCount[8] }}, {{ $userMonthCount[9]  }},
             {{ $userMonthCount[10] }}, {{ $userMonthCount[11] }}, {{ $userMonthCount[12] }},
            ],
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
        padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
        }
        },
        scales: {
        xAxes: [{
            time: {
            unit: 'date'
            },
            gridLines: {
            display: false,
            drawBorder: false
            },
            ticks: {
            maxTicksLimit: 7
            }
        }],
        yAxes: [{
            ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
                return number_format(value);
            }
            },
            gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
            }
        }],
        },
        legend: {
        display: false
        },
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
            label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
            }
        }
        }
    }
    });


    // User Roles Pie Chart
    var ctx = document.getElementById("userPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: @json($roles->pluck('name')->toArray()),
        datasets: [{
        data: @json($roles->pluck('userCount')->toArray()),
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>
@endpush


