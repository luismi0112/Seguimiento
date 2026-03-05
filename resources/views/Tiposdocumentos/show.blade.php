@extends('adminlte::page')

@section('title', 'Detalles del Tipo de Documento')

@section('content_header')
<h1>Detalles del Tipo de Documento</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-file-alt"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $tipo->NIS }}</p>
        <p><strong>Denominación:</strong> {{ $tipo->Denominacion }}</p>
        <p><strong>Observaciones:</strong> {{ $tipo->Observaciones }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('tiposdocumentos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('tiposdocumentos.edit', $tipo->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop