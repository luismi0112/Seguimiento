@extends('adminlte::page')

@section('title', 'Lista de Regiones')

@section('content_header')
<h1>Lista de Regiones</h1>
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

<a href="{{ route('regionales.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Agregar Nueva Regional
</a>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($regionales) && $regionales->count() > 0)
                @foreach($regionales as $regional)
                <tr>
                    <td>{{ $regional->NIS }}</td>
                    <td>{{ $regional->Codigo }}</td>
                    <td>{{ $regional->Denominacion }}</td>
                    <td>{{ $regional->Observaciones }}</td>
                    <td>
                        <a href="{{ route('regionales.edit', $regional->NIS) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('regionales.destroy', $regional->NIS) }}" method="POST" class="deleteForm" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btnDelete">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No hay registros</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <strong>Total de regionales: {{ $regionales->count() }}</strong>
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
                    text: "Esta acción eliminará la regional definitivamente.",
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