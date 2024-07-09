@extends('layouts.app_dash')
@section('content2')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ajout Pénalité</h4>
            <form class="forms-sample" action="{{ route('insertPenalite.dash') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <select class="form-control" id="id_etape" name="id_etape" >
                        
                      <option><p>Choix étape </p></option>
                @foreach($nomEtape as $pt)

                      <option value="{{ $pt->id }}" >{{ $pt->nom }}</option>

                @endforeach

                    </select>
                    <br>
                    <select class="form-control" id="id_coureur" name="id_coureur" >
                        
                        <option><p>Choix equipe </p></option>
                  @foreach($nomEquipe as $pt)
  
                        <option value="{{ $pt->id }}" >{{ $pt->nom}}</option>
  
                  @endforeach
  
                      </select>
                  
                      <br>
                <div class="form-group">
                <div class="row">
                        
                        <div class="col-2">
                          <select class="form-control" id="heure_penalite" name="heure_penalite" value="01">
                              <?php
                              for ($i = 0; $i <= 24; $i++) {
                                  $hour = str_pad($i, 2, "0", STR_PAD_LEFT);
                                  echo "<option value=\"$hour\">$hour</option>";
                              }
                              ?>
                          </select>
                        </div>
                        :
                        <div class="col-2">
                          <select class="form-control" id="min_penalite" name="min_penalite" >
                              <?php
                              for ($i = 0; $i <= 60; $i++) {
                                  $hour = str_pad($i, 2, "0", STR_PAD_LEFT);
                                  echo "<option value=\"$hour\">$hour</option>";
                              }
                              ?>
                          </select>
                        </div>
                        :
                        <div class="col-2">
                          <select class="form-control" id="sec_penalite" name="sec_penalite" value="01">
                              <?php
                              for ($i = 0; $i <= 60; $i++) {
                                  $hour = str_pad($i, 2, "0", STR_PAD_LEFT);
                                  echo "<option value=\"$hour\">$hour</option>";
                              }
                              ?>
                          </select>
                        </div>
                    
                    @error('num_coureur')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <br>
              
                <button type="submit" class="btn btn-primary me-2">Valider</button>

            </form>
        </div>
        </div>
    </div>   
@stop
