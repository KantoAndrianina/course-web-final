@extends('layouts.app_dash')
@section('content2')
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Importation de données</h4>
                <form class="forms-sample" action="{{ route('import.etape') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Etapes</label>
                        <input type="file" class="form-control form-control-lg" id="csvfile1" name="csvfile1" value="{{ old('csvfile1') }}">
                        @error('csvfile1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Résultats</label>
                        <input type="file" class="form-control form-control-lg" id="csvfile2" name="csvfile2" value="{{ old('csvfile2') }}">
                        @error('csvfile2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @error('error')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary me-2">Importer</button>
                </form>
            </div>
            </div>
        </div>
        
@stop