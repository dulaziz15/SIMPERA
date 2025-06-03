@extends('layout.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>

 <div class="container mt-5">
  <div class="row">

    <div class="col-xl-6 d-flex justify-content-center align-items-center">
      <div style="width: 320px; height: 320px;">
        <h4 class="card-title">Jumlah Kerusakan</h4>
        <canvas id="devicePieChart1"></canvas>
      </div>
    </div>


    <div class="col-xl-6 d-flex justify-content-center align-items-center">
      <div style="width: 320px; height: 320px;">
        <h4 class="card-title">Jumlah Kerusakan 2</h4>
        <canvas id="devicePieChart2"></canvas>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const data1 = [15, 10, 10, 5, 60]; 
  const data2 = [20, 5, 25, 10, 40]; 

  const config = (canvasId, dataValues) => {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Laptop', 'Tablet', 'Mobile', 'Others', 'Desktop'],
        datasets: [{
          data: dataValues,
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
  };

  config('devicePieChart1', data1);
  config('devicePieChart2', data2);
</script>


   <div class="row">

  <div class="col-xl-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Kategori</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>First Nama Kategori</th>
                <th>Gedung</th>
                <th>Ruangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

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
                <td>Alice</td>
                <td>Aktif</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Bob</td>
                <td>Nonaktif</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Charlie</td>
                <td>Aktif</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection