@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .legend-box {
            display: flex;
            flex-direction: column;
            margin-right: 40px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            margin-right: 8px;
            border-radius: 3px;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-top: 50px;
        }

        h3 {
            margin-left: 50px;
        }
    </style>
</head>
<body>

    <h3>Pie Chart</h3>

    <div class="chart-container">
        <div class="legend-box">
            <div class="legend-item"><div class="legend-color" style="background-color:#f44336;"></div>Laptop</div>
            <div class="legend-item"><div class="legend-color" style="background-color:#4caf50;"></div>Tablet</div>
            <div class="legend-item"><div class="legend-color" style="background-color:#2196f3;"></div>Mobile</div>
            <div class="legend-item"><div class="legend-color" style="background-color:#ffc107;"></div>Others</div>
            <div class="legend-item"><div class="legend-color" style="background-color:#3f51b5;"></div>Desktop</div>
        </div>

        <div>
            <canvas id="devicePieChart" width="300" height="300"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('devicePieChart').getContext('2d');

        const data = {
            labels: ['Laptop', 'Tablet', 'Mobile', 'Others', 'Desktop'],
            datasets: [{
                data: [15, 10, 10, 5, 60],
                backgroundColor: [
                    '#f44336', // Laptop
                    '#4caf50', // Tablet
                    '#2196f3', // Mobile
                    '#ffc107', // Others
                    '#3f51b5'  // Desktop
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>

</body>
</html>

 {{-- <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Pie Chart</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="pie-chart" data-colors='["#fd625e", "#2ab57d", "#4ba6ef", "#ffbf53", "#5156be"]' class="e-charts"></div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col --> --}}

 <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Table Rank</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

   <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Daftar Kategori</h4>
                                        </p>
                                    </div>
                                    <div class="card-body">
        
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                            </tr>
                                            <tr>
                                                <td>Cedric Kelly</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2012/03/29</td>
                                                <td>$433,060</td>
                                            </tr>    
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
@endsection