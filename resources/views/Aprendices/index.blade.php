@extends('adminlte::page')

@section('title', 'Aprendices')

@section('content_header')
<h1>Aprendices</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('aprendices.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Aprendiz
        </a>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NIS</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo Institucional</th>
                    <th>Correo Personal</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aprendices as $aprendiz)
                <tr>
                    <td>{{ $aprendiz->NIS }}</td>
                    <td>{{ $aprendiz->Numdoc }}</td>
                    <td>{{ $aprendiz->Nombres }}</td>
                    <td>{{ $aprendiz->Apellidos }}</td>
                    <td>{{ $aprendiz->CorreoInstitucional }}</td>
                    <td>{{ $aprendiz->CorreoPersonal }}</td>
                    <td class="text-center">

                        <a href="{{ route('aprendices.edit',$aprendiz->NIS) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form class="deleteForm"
                            action="{{ route('aprendices.destroy', $aprendiz->NIS) }}"
                            method="POST"
                            style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop


@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el aprendiz definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    fetch(this.action, {
                            method: this.method,
                            body: new FormData(this),
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: 'El aprendiz se eliminó correctamente.',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'No se pudo eliminar el aprendiz.',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un problema al procesar la solicitud.',
                            });
                            console.error(error);
                        });

                }
            });
        });
    });
</script>
@stop