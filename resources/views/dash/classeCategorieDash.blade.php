<?php
  $duplicatePoints = collect($duplicatePoints);
?>
@extends('layouts.app_dash')
@section('content2')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <form class="forms-sample" action="{{ route('afficherClassementCat.dash') }}" method="get" enctype="multipart/form-data">
              @csrf
              <div class="form-group col-6">
                  <br>
                  <select class="form-control" id="id_categorie" name="id_categorie" >
                      <option value="0"><p>Toutes catégories </p></option>
                      @foreach($categories as $pt)
                      <option value="{{ $pt->id }}" >{{ $pt->nom }}</option>
                      @endforeach
                    </select>
              </div>
              <button type="submit" class="btn btn-primary me-2">Choisir</button>
          </form>
      </div>
    </div>
</div>

<div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pie chart</h4>
                  <canvas id="pieChart"></canvas>
                </div>
              </div>   
        </div>   

<div class="col-lg-12 grid-margin stretch-card">
            
      <div class="card">
        <div class="card-body">
        
            <br>
          <h4 class="card-title">Classement Equipes Catégorie {{ $classeG[0]->nom_categorie }}</h4>
          <p class="card-description">
            <!-- Add class <code>.table-striped</code> -->
          </p>
          <div class="table-responsive">
            <table class="table table-striped">
            <thead>
    <tr>
     <th scope="col">nom_equipe</th>   
     <th scope="col">points</th>     
    </tr>
  </thead>
  <tbody>
  @foreach ($classeG as $pt)

    <tr>
      <td>{{ $pt->nom_equipe }}</td>
      <td>
          @if($duplicatePoints->contains($pt->points))
              <span style="color: red;">{{ $pt->points }}</span>
          @else
              {{ $pt->points }}
          @endif
      </td>
    </tr>
    @endforeach
   
  </tbody>
    </table>

    </div><br>
    <a href="{{ route('equipe.certificat.categorie', ['id_cat' => $classeG[0]->id_categorie]) }}"  class="btn btn-success btn-lg">PDF</a>

        </div>
      </div>
     
    </div>
    
    <?php
$url = config('app.url');
?>

 
        <script src="<?php echo $url ?>/assets_dash/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?php echo $url ?>/assets_dash/vendors/chart.js/Chart.min.js"></script>
  <script src="<?php echo $url ?>/assets_dash/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo $url ?>/assets_dash/vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo $url ?>/assets_dash/js/off-canvas.js"></script>
  <script src="<?php echo $url ?>/assets_dash/js/hoverable-collapse.js"></script>
  <script src="<?php echo $url ?>/assets_dash/js/template.js"></script>
  <script src="<?php echo $url ?>/assets_dash/js/settings.js"></script>
  <script src="<?php echo $url ?>/assets_dash/js/todolist.js"></script>

  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo $url ?>/assets_dash/js/dashboard.js"></script>
  <script src="<?php echo $url ?>/assets_dash/js/Chart.roundedBarCharts.js"></script>

  <script src="<?php echo $url ?>/assets_dash/js/chart.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const doughnutPieData = {
            labels:  <?php echo $dataString2 ?>,
            // labels: ["A", "D", "E", "C", "B"],
            datasets: [{
                label: '# of Votes',
                data : {{ $dataString1 }},
                // data: [10, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
            }]
        };

        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: doughnutPieData,
            options: {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
</script>
    
@stop