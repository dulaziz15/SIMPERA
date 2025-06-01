@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>

  <div class="container mt-5">
  <div class="row">
    <div class="col-xl-6 d-flex justify-content-center align-items-center">
      <div style="width: 320px; height: 320px;">
        <h4 class="card-title">Pie Chart</h4>
        <canvas id="devicePieChart"></canvas>
      </div>
    </div>

    <div class="col-xl-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Table Rank</h4>
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Rank</th>
              </tr>
            </thead>
            <tbody>
              <tr><th scope="row">1</th><td>Mark</td><td>Otto</td></tr>
              <tr><th scope="row">2</th><td>Jacob</td><td>Thornton</td></tr>
              <tr><th scope="row">3</th><td>Larry</td><td>the Bird</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('devicePieChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Laptop', 'Tablet', 'Mobile', 'Others', 'Desktop'],
      datasets: [{
        data: [15, 10, 10, 5, 60],
        backgroundColor: [
          '#f44336', '#4caf50', '#2196f3', '#ffc107', '#3f51b5'
        ],
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'right'
        }
      }
    }
  });
</script>

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
                                                <th>No</th>
                                                <th>Nama Kategori</th>
                                                <th>Gedung</th>
                                                <th>Ruangan</th>
                                            </tr>
                                            </thead>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
@endsection