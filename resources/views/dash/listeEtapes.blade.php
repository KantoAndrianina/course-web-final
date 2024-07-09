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
                    Lieu
                  </th>
                  
                  <th>
                    Temps
                  </th>

                  <th>
                    Résultats
                  </th>
                </tr>
              </thead>
              <tbody>
              @foreach ($etapes as $pt)
                    <tr>
                      <td>
                      {{ $pt->nom }}
                      </td>
                      <td>
                        <a href="{{ route('afficherformTemps.dash',[ 'id'=>$pt->id ]) }}">temps</a>
                      </td>
                      <td>
                        <a href="{{ route('afficherResultatEtape.dash',[ 'id'=>$pt->id ]) }}">resultats</a>
                      </td>
                      <td>
                        <!-- <form action="{{ route('confirmer.classement') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_etape" value="{{ $pt->id }}">
                            <button type="submit" class="btn btn-primary">Confirmer Classement</button>
                        </form> -->
                      </td>
                    </tr>
              @endforeach
              </tbody>
            </table>
          </div><br>
        </div>

         @error('error')
          <div class="alert alert-danger">
              <strong>{{ $message }}</strong>
          </div>
      @enderror
      </div>
      
    </div>
@stop
