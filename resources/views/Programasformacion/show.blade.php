@extends('adminlte::page')

@section('title', 'Detalles del Programa de Formación')

@section('content_header')
    <h1>Detalles del Programa de Formación</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-book"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $programa->NIS }}</p>
        <p><strong>Código:</strong> {{ $programa->Codigo }}</p>
        <p><strong>Denominación:</strong> {{ $programa->Denominacion }}</p>
        <p><strong>Duración:</strong> {{ $programa->Duracion }} semestres</p>
        <p><strong>Observaciones:</strong> {{ $programa->Observaciones }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('programasformacion.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('programasformacion.edit', $programa->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop
