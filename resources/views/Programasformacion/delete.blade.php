@extends('adminlte::page')

@section('title', 'Eliminar Programa de Formación')

@section('content_header')
<h1>Eliminar Programa de Formación</h1>
@stop

@section('content')
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar Eliminación</h3>
    </div>
    <div class="card-body">
        <p>¿Estás seguro de que deseas eliminar el siguiente programa?</p>
        <ul>
            <li><strong>Código:</strong> {{ $programa->Codigo }}</li>
            <li><strong>Denominación:</strong> {{ $programa->Denominacion }}</li>
            <li><strong>Observaciones:</strong> {{ $programa->Observaciones }}</li>
        </ul>
        <p class="text-danger">Esta acción no se puede deshacer.</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('programasformacion.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Cancelar
        </a>
        <form id="deleteForm" action="{{ route('programasformacion.destroy', $programa->NIS) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" id="btnDelete" class="btn btn-danger">
                <i class="fas fa-trash"></i> Eliminar
            </button>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnDelete = document.getElementById('btnDelete');
        const form = document.getElementById('deleteForm');

        btnDelete.addEventListener('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el programa de formación definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Eliminado!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif
@stop