@extends('adminlte::page')

@section('title', 'Centros de Formación')

@section('content_header')
<h1>Centros de Formación</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('centrosformacion.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Centro
        </a>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NIS</th>
                    <th>Código</th>
                    <th>Denominación</th>
                    <th>Observaciones</th>
                    <th>Regional</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($centros as $centro)
                <tr>
                    <td>{{ $centro->NIS }}</td>
                    <td>{{ $centro->Codigo }}</td>
                    <td>{{ $centro->Denominacion }}</td>
                    <td>{{ $centro->Observaciones }}</td>
                    <td>{{ $centro->regional->Denominacion ?? 'Sin regional' }}</td>
                    <td class="text-center">

                        <a href="{{ route('centrosformacion.edit', $centro->NIS) }}"
                            class="btn btn-primary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form class="deleteForm"
                            action="{{ route('centrosformacion.destroy', $centro->NIS) }}"
                            method="POST"
                            style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(method_exists($centros, 'links'))
    <div class="card-footer clearfix">
        {{ $centros->links() }}
    </div>
    @endif
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción eliminará el centro de formación definitivamente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(this.action, {
                                method: this.querySelector('input[name="_method"]') ? this.querySelector('input[name="_method"]').value : this.method,
                                body: new FormData(this),
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                            })
                            .then(async response => {
                                const contentType = response.headers.get('content-type') || '';
                                if (contentType.includes('application/json')) {
                                    return response.json();
                                }
                                return {
                                    success: response.ok
                                };
                            })
                            .then(data => {
                                if (data && data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Eliminado!',
                                        text: data.message || 'El centro de formación se eliminó correctamente.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data && data.message ? data.message : 'No se pudo eliminar el centro.',
                                    });
                                }
                            })
                            .catch(error => {
                                console.error(error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un problema al procesar la solicitud.',
                                });
                            });
                    }
                });
            });
        });
    });
</script>
@stop