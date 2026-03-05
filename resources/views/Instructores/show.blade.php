@extends('adminlte::page')

@section('title', 'Detalles del Instructor')

@section('content_header')
<h1>Detalles del Instructor</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $instructor->NIS }}</p>
        <p><strong>Documento:</strong> {{ $instructor->Numdoc }}</p>
        <p><strong>Nombres:</strong> {{ $instructor->Nombres }}</p>
        <p><strong>Apellidos:</strong> {{ $instructor->Apellidos }}</p>
        <p><strong>Dirección:</strong> {{ $instructor->Direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $instructor->Telefono }}</p>
        <p><strong>Correo Institucional:</strong> {{ $instructor->CorreoInstitucional }}</p>
        <p><strong>Correo Personal:</strong> {{ $instructor->CorreoPersonal }}</p>
        <p><strong>Sexo:</strong> {{ $instructor->Sexo == 1 ? 'Masculino' : 'Femenino' }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $instructor->FechaNacimiento }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('instructores.edit', $instructor->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop