@extends('adminlte::page')

@section('title', 'Detalles del Centro de Formación')

@section('content_header')
    <h1>Detalles del Centro de Formación</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-school"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $centro->NIS }}</p>
        <p><strong>Código:</strong> {{ $centro->Codigo }}</p>
        <p><strong>Denominación:</strong> {{ $centro->Denominacion }}</p>
        <p><strong>Observaciones:</strong> {{ $centro->Observaciones }}</p>
        <p><strong>Regional:</strong> {{ $centro->regional->Denominacion ?? 'Sin regional' }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('centrosformacion.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('centrosformacion.edit', $centro->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop
