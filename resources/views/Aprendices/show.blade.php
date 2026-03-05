@extends('adminlte::page')

@section('title', 'Detalles del Aprendiz')

@section('content_header')
<h1>Detalles del Aprendiz</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user"></i> Información del Aprendiz
        </h3>
    </div>

    <div class="card-body">
        <p><strong>ID:</strong> {{ $aprendiz->NIS }}</p>
        <p><strong>Tipo de Documento:</strong> {{ $aprendiz->tipoDocumento->Denominacion ?? 'N/A' }}</p>
        <p><strong>Número de Documento:</strong> {{ $aprendiz->Numdoc }}</p>
        <p><strong>Nombres:</strong> {{ $aprendiz->Nombres }}</p>
        <p><strong>Apellidos:</strong> {{ $aprendiz->Apellidos }}</p>
        <p><strong>Dirección:</strong> {{ $aprendiz->Direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $aprendiz->Telefono }}</p>
        <p><strong>Correo Institucional:</strong> {{ $aprendiz->CorreoInstitucional }}</p>
        <p><strong>Correo Personal:</strong> {{ $aprendiz->CorreoPersonal }}</p>
        <p><strong>Sexo:</strong>
            @if($aprendiz->Sexo == 1) Masculino
            @elseif($aprendiz->Sexo == 2) Femenino
            @else N/A
            @endif
        </p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $aprendiz->FechaNacimiento }}</p>
        <p><strong>EPS:</strong> {{ $aprendiz->eps->Denominacion ?? 'N/A' }}</p>
        <p><strong>Ficha:</strong> {{ $aprendiz->ficha->Codigo ?? 'N/A' }}</p>
    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('aprendices.edit', $aprendiz->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop