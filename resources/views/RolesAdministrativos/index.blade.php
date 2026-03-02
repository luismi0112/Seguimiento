@extends('adminlte::page')

@section('title', 'Roles Administrativos')

@section('content_header')
<h1>Roles Administrativos</h1>
@stop

@section('content')
@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
@endif

<a href="{{ route('rolesadministrativos.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Agregar Rol
</a>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datos as $rol)
                <tr>
                    <td>{{ $rol->NIS }}</td>
                    <td>{{ $rol->Descripcion }}</td>
                    <td>
                        <a href="{{ route('rolesadministrativos.edit', ['rolesadministrativo' => $rol->NIS]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('rolesadministrativos.destroy', ['rolesadministrativo' => $rol->NIS]) }}" method="POST" class="d-inline deleteForm">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btnDelete">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No hay registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.btnDelete');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará el rol administrativo definitivamente.",
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
    });
</script>
@stop