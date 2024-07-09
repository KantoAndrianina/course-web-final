@extends('layouts.app_dash')
@section('content2')
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Importation de données</h4>
                <form class="forms-sample"  action="{{ route('import.point') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label>Point</label>
                    <input type="file" class="form-control form-control-lg" id="csvfile3" name="csvfile3">
                </div>
                <button type="submit" class="btn btn-primary me-2">Importer</button>
                </form>
            </div>
            </div>
        </div>
@stop