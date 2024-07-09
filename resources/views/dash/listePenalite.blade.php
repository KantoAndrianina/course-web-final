@extends('layouts.app_dash')
@section('content2')
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste Penalites</h4>
          <p class="card-description">
            <!-- Add class <code>.table-striped</code> -->
          </p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>
                    Etapes
                  </th>
                  
                  <th>
                    Equipe
                  </th>
                  <th>
                    Temps de pénalité
                  </th>
                </tr>
              </thead>
              <tbody>
              @foreach ($penalite as $pt)
                    <tr>
                      <td>
                      {{ $pt->etape_id }}
                      </td>
                      <td>
                      {{ $pt->equipe_id }}
                      </td>
                      <td>
                      {{ $pt->penalite }}
                      </td>
                      <td>
                        <a href="{{ route('afficherValidSuppPenal.dash',[ 'id'=>$pt->id ]) }}"class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                      </td>
                    </tr>
              @endforeach
              </tbody>
            </table>
          </div><br>
          <a type="submit" href="{{ route('afficherAjoutPenal.dash') }}" class="btn btn-primary">Ajouter Pénalité</a>
        </div>

       
     
    
      </div>
      
    </div>
@stop
