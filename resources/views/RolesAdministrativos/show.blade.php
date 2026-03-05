@extends('adminlte::page')

@section('title', 'Detalles del Rol Administrativo')

@section('content_header')
<h1>Detalles del Rol Administrativo</h1>
@stop

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-shield"></i> Información</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $rol->NIS }}</p>
        <p><strong>Descripción:</strong> {{ $rol->Descripcion }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <a href="{{ route('rolesadministrativos.edit', $rol->NIS) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>
</div>
@stop