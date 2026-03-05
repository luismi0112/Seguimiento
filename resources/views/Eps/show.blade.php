@extends('adminlte::page')

@section('title', 'Detalles de la EPS')

@section('content_header')
<h1>Detalles de la EPS</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-hospital"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $eps->NIS }}</p>
        <p><strong>Documento:</strong> {{ $eps->Numdoc }}</p>
        <p><strong>Denominación:</strong> {{ $eps->Denominacion }}</p>
        <p><strong>Observaciones:</strong> {{ $eps->Observaciones }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('eps.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('eps.edit', $eps->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop