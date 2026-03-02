@extends('adminlte::page')

@section('title', 'Programas de Formación')

@section('content_header')
<h1>Programas de Formación</h1>
@stop

@section('content')
<a href="{{ route('programasformacion.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Agregar Programa
</a>

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

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Duración</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programas as $programa)
                <tr>
                    <td>{{ $programa->NIS }}</td>
                    <td>{{ $programa->Codigo }}</td>
                    <td>{{ $programa->Denominacion }}</td>
                    <td>{{ $programa->Duracion }} semestres</td>
                    <td>{{ $programa->Observaciones }}</td>
                    <td>
                        <a href="{{ route('programasformacion.edit',$programa->NIS) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('programasformacion.destroy',$programa->NIS) }}" method="POST" class="deleteForm" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btnDelete">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <strong>Total de programas: {{ $programas->count() }}</strong>
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
    });
</script>
@stop