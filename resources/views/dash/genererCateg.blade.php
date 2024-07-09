@extends('layouts.app_dash')
@section('content2')
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste Categorie coureurs</h4>
          <p class="card-description">
            <!-- Add class <code>.table-striped</code> -->
          </p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Numero</th>
                  <th>Catégorie</th>

                </tr>
              </thead>
              <tbody>
              @foreach ($generer as $pt)
                    <tr>
                      <td>{{ $pt->nom_coureur }}</td>
                      <td>{{ $pt->numero }}</td>
                      <td>{{ $pt->nom_categorie }}</td>
                    </tr>
              @endforeach
              </tbody>
            </table>
          </div><br>

        </div>

       
      </div>
     
    </div>
@stop
