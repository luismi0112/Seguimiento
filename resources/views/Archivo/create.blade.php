@extends('adminlte::page')

@section('title', 'Subir Archivo')

@section('content_header')
<h1>Subir Archivo</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la bitacora</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="archivo" class="form-label">Seleccionar Bitacora</label>
                <input type="file" name="archivo" id="archivo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo de notificación</label>
                <input type="email" name="correo" id="correo" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-upload"></i> Subir
            </button>
        </form>
    </div>
</div>
@stop