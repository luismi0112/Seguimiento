@extends('adminlte::page')

@section('title', 'Detalles de la Regional')

@section('content_header')
<h1>Detalles de la Regional</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-map-marker-alt"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $regional->NIS }}</p>
        <p><strong>Código:</strong> {{ $regional->Codigo }}</p>
        <p><strong>Denominación:</strong> {{ $regional->Denominacion }}</p>
        <p><strong>Observaciones:</strong> {{ $regional->Observaciones }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('regionales.edit', $regional->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop