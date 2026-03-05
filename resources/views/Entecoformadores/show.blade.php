@extends('adminlte::page')

@section('title', 'Detalles del Ente Coformador')

@section('content_header')
<h1>Detalles del Ente Coformador</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-building"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $ente->NIS }}</p>
        <p><strong>Tipo de Documento:</strong> {{ $ente->Tdoc }}</p>
        <p><strong>Número de Documento:</strong> {{ $ente->Numdoc }}</p>
        <p><strong>Nombres:</strong> {{ $ente->Nombres }}</p>
        <p><strong>Razón Social:</strong> {{ $ente->RazonSocial }}</p>
        <p><strong>Dirección:</strong> {{ $ente->Direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $ente->Telefono }}</p>
        <p><strong>Correo Institucional:</strong> {{ $ente->CorreoInstitucional }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('entecoformadores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('entecoformadores.edit', $ente->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop