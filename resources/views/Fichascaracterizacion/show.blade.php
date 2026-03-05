@extends('adminlte::page')

@section('title', 'Detalles de la Ficha')

@section('content_header')
<h1>Detalles de la Ficha</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-id-card"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $ficha->NIS }}</p>
        <p><strong>Código:</strong> {{ $ficha->Codigo }}</p>
        <p><strong>Denominación:</strong> {{ $ficha->Denominacion }}</p>
        <p><strong>Cupo:</strong> {{ $ficha->Cupo }}</p>
        <p><strong>Fecha Inicio:</strong> {{ $ficha->Fechainicio }}</p>
        <p><strong>Fecha Fin:</strong> {{ $ficha->Fechafin }}</p>
        <p><strong>Observaciones:</strong> {{ $ficha->Observaciones }}</p>
        <p><strong>Programa:</strong> {{ $ficha->programa->Denominacion ?? 'Sin programa' }}</p>
        <p><strong>Centro:</strong> {{ $ficha->centro->Denominacion ?? 'Sin centro' }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('fichas.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('fichas.edit', $ficha->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop