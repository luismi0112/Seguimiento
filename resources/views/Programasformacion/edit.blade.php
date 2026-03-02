@extends('adminlte::page')

@section('title', 'Editar Programa de Formación')

@section('content_header')
<h1>Editar Programa de Formación</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit"></i> Modificar Programa</h3>
    </div>
    <form action="{{ route('programasformacion.update', $programa->NIS) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="Codigo">Código</label>
                <input type="text" class="form-control" id="Codigo" name="Codigo" value="{{ $programa->Codigo }}" required>
            </div>
            <div class="form-group">
                <label for="Denominacion">Denominación</label>
                <input type="text" class="form-control" id="Denominacion" name="Denominacion" value="{{ $programa->Denominacion }}" required>
            </div>
            <div class="form-group">
                <label for="Observaciones">Observaciones</label>
                <input type="text" class="form-control" id="Observaciones" name="Observaciones" value="{{ $programa->Observaciones }}">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('programasformacion.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Actualizar
            </button>
        </div>
    </form>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif
@stop