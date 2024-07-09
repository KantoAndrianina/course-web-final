@extends('layouts.app_dash')
@section('content2')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <form class="forms-sample" action="{{ route('afficherClassementEtapeCat.dash') }}" method="get" enctype="multipart/form-data">
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
<div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Classement Etapes Catégorie {{ $classeG[0]->nom_categorie }}</h4>
          <p class="card-description">
            <!-- Add class <code>.table-striped</code> -->
          </p>
          <div class="table-responsive">
            <table class="table table-striped">
            <thead>
    <thead>
    <tr>
     <th scope="col">nom_etape</th>   
     <th scope="col">nom_coureur</th>   
     <th scope="col">nom_equipe</th>   
     <th scope="col">duree</th>   
     <th scope="col">points</th>     
    </tr>
  </thead>
  <tbody>
  @foreach ($classeG as $pt)

    <tr>
      <td>{{ $pt->nom_etape }}</td>
      <td>{{ $pt->nom_coureur }}</td>
      <td>{{ $pt->nom_equipe }}</td>
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