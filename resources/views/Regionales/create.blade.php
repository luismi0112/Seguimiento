@extends('adminlte::page')

@section('title', 'Agregar Nueva Regional')

@section('content_header')
<h1>Agregar Nueva Regional</h1>
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus"></i> Nueva Regional</h3>
    </div>
    <form action="{{ route('regionales.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="Codigo" required>
            </div>
            <div class="form-group">
                <label for="denominacion">Denominación</label>
                <input type="text" class="form-control" id="denominacion" name="Denominacion" required>
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" name="Observaciones">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('regionales.index') }}" class="btn btn-secondary">
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