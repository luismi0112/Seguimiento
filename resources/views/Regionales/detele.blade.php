@extends('adminlte::page')

@section('title', 'Eliminar Instructor')

@section('content_header')
<h1>Eliminar Instructor</h1>
@stop

@section('content')
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-trash"></i> Confirmar Eliminación</h3>
    </div>
    <div class="card-body">
        <p>¿Estás seguro de que deseas eliminar al instructor
            <strong>{{ $instructor->Nombres }} {{ $instructor->Apellidos }}</strong>?
        </p>
        <form id="deleteForm" action="{{ route('instructores.destroy',$instructor->NIS) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-between">
                <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('deleteForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará al instructor definitivamente.",
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