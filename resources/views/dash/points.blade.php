@extends('layouts.app_dash')
@section('content2')
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste Etapes</h4>
          <p class="card-description">
            <!-- Add class <code>.table-striped</code> -->
          </p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                  id_coureur
                  </th>
                  
                  <th>
                  id_etape
                  </th>

                  <th>
                  duree
                  </th> <th>
                  points
                  </th>

                  
                </tr>
              </thead>
              <tbody>
              @foreach ($results as $pt)
                    <tr>
                      <td>
                      {{ $pt->id_coureur }}
                      </td>
                     <td> {{ $pt->id_etape }}</td>
                      <td>{{ $pt->duree }}</td>
                      <td>{{ $pt->points }}</td>
                     
                    </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
       
      </div>
     
    </div>
@stop
