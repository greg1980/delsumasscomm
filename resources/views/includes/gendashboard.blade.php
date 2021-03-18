<div class="alert alert-light border-warning">
    <div class="row">
        <div class="col-lg-4 ">
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="mysPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                      <i class="fas fa-circle text-success"></i> Pass
                                    </span>
                    <span class="mr-2">
                                      <i class="fas fa-circle text-danger"></i> Failed
                                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-body">
                <div class="chart-area pt-4 pb-2">
                    <canvas id="mChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-body">
                <div class="chart-bar pt-4 pb-2">

                </div>
            </div>
        </div>
    </div>
</div>

<?php

        $failCount = DB::table('enrollments')->select('enrollment.*')->where('grades', '<=', 46)->count();
        $passCounts = DB::table('enrollments')->select('enrollment.*')->where('grades', '>=', 47)->count();

?>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
<!-- Page level custom scripts -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("mysPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Pass", "Failed"],
            datasets: [{
                data: [ {{$passCounts}}, {{$failCount}}],
                backgroundColor: [ '#1cc88a', '#e2074b'],
                hoverBackgroundColor: [ '#17a673', '#fc042c'],
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
<script>
    var ctx = document.getElementById('mChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Failed', 'Pass'],
            datasets: [{
                label: '# of Results',
                data: [100, 19],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>
