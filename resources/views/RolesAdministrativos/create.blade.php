@extends('adminlte::page')

@section('title', 'Agregar Rol Administrativo')

@section('content_header')
<h1>Agregar Rol Administrativo</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus"></i> Nuevo Rol</h3>
    </div>
    <form action="{{ route('rolesadministrativos.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="Descripcion" maxlength="200" required>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('rolesadministrativos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
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
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@stop