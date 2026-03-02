@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Panel Principal</h1>
@stop

@section('content')
<div class="row g-3">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                <h5 class="card-title">Regionales</h5>
                <p class="card-text">{{ $regionalesCount ?? 0 }} registrados</p>
                <a href="{{ route('regionales.index') }}" class="btn btn-light btn-sm">Ver más</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="fas fa-university fa-2x mb-2"></i>
                <h5 class="card-title">Centros</h5>
                <p class="card-text">{{ $centrosCount ?? 0 }} registrados</p>
                <a href="{{ route('centrosformacion.index') }}" class="btn btn-light btn-sm">Ver más</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                <i class="fas fa-book fa-2x mb-2"></i>
                <h5 class="card-title">Programas</h5>
                <p class="card-text">{{ $programasCount ?? 0 }} registrados</p>
                <a href="{{ route('programasformacion.index') }}" class="btn btn-light btn-sm">Ver más</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body text-center">
                <i class="fas fa-folder fa-2x mb-2"></i>
                <h5 class="card-title">Archivos</h5>
                <p class="card-text">{{ $archivosCount ?? 0 }} almacenados</p>
                <a href="{{ route('archivos.index') }}" class="btn btn-dark btn-sm">Ver más</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-4">
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-body text-center">
                <i class="fas fa-user-graduate fa-2x mb-2"></i>
                <h5 class="card-title">Aprendices</h5>
                <p class="card-text">{{ $aprendicesCount ?? 0 }} registrados</p>
                <a href="{{ route('aprendices.index') }}" class="btn btn-light btn-sm">Ver más</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-dark text-white">
            <div class="card-body text-center">
                <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                <h5 class="card-title">Instructores</h5>
                <p class="card-text">{{ $instructoresCount ?? 0 }} registrados</p>
                <a href="{{ route('instructores.index') }}" class="btn btn-light btn-sm">Ver más</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <i class="fas fa-hospital fa-2x mb-2"></i>
                <h5 class="card-title">EPS</h5>
                <p class="card-text">{{ $epsCount ?? 0 }} registradas</p>
                <a href="{{ route('eps.index') }}" class="btn btn-light btn-sm">Ver más</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-light text-dark">
            <div class="card-body text-center">
                <i class="fas fa-user-shield fa-2x mb-2"></i>
                <h5 class="card-title">Roles</h5>
                <p class="card-text">{{ $rolesCount ?? 0 }} definidos</p>
                <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-dark btn-sm">Ver más</a>
            </div>
        </div>
    </div>
</div>
@stop