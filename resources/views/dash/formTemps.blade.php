<?php
    use Carbon\Carbon;
?>
@extends('layouts.app_dash')
@section('content2')
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Affectation de temps</h4>
            <form class="forms-sample" action="{{ route('insertTemps.dash') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
            <h4 class="card-title"><label>Etape: </label> {{ $etapes_id[0]->nom }}</h4>
            <input type="hidden" id="id_etape" name="id_etape" value="{{ $etapes_id[0]->id }}">
                    <label>Numero coureur</label>
                    <select class="form-control" id="id_coureur" name="id_coureur">
                      <option>Selectionner un numero</option>
                             @foreach ($coureurs as $pt)
                      <option value="{{ $pt->id_coureur }}" >{{ $pt->nom_coureur }} {{ $pt->numero }}</option>
                             @endforeach

                    </select>
                    @error('num_coureur')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group ">
                    <label for="exampleInputCity1">Date et Heure Depart : {{ Carbon::parse($depart)->format('d/m/Y H:i:s') }} </label>
                    <input type="hidden" id="date_heure_depart" name="date_heure_depart" value="{{ $depart }}">
                </div>
                <div class="form-group ">
                    <label for="exampleInputCity1">Date et Heure Arrivée</label>
                    <div class="row">
                    @php
                        $depart = \Carbon\Carbon::parse($depart)->format('Y-m-d');
                    @endphp
                        <div class="col-5">
                            <input type="date" class="form-control" id="date_arrivee" name="date_arrivee" value="{{ $depart }}">
                        </div>
                        <div class="col-2">
                          <select class="form-control" id="heure_arrivee" name="heure_arrivee" value="01">
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
                          <select class="form-control" id="min_arrivee" name="min_arrivee" value="01">
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
                          <select class="form-control" id="sec_arrivee" name="sec_arrivee" value="01">
                              <?php
                              for ($i = 0; $i <= 60; $i++) {
                                  $hour = str_pad($i, 2, "0", STR_PAD_LEFT);
                                  echo "<option value=\"$hour\">$hour</option>";
                              }
                              ?>
                          </select>
                        </div>
                    </div>
                </div>
                
                @error('error')
                    <div class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <button type="submit" class="btn btn-primary me-2">Valider</button>

            </form>
        </div>
        </div>
    </div>   
@stop
