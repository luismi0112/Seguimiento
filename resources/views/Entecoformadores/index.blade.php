@extends('adminlte::page')

@section('title', 'Entes Coformadores')

@section('content_header')
    <h1>Entes Coformadores</h1>
@stop

@section('content')

{{-- Hidden field to pass flash message safely without injecting Blade inside JS --}}
<input type="hidden" id="successMessage" value="{{ session('success') ?? '' }}">

<div class="card">
    <div class="card-header">
        <a href="{{ route('entecoformadores.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Ente
        </a>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead class="bg-primary text-white">
                <tr>
                    <th>NIS</th>
                    <th>Tipo Doc</th>
                    <th>Número Doc</th>
                    <th>Nombres</th>
                    <th>Razón Social</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Institucional</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datos as $ente)
                <tr>
                    <td>{{ $ente->NIS }}</td>
                    <td>{{ $ente->Tdoc }}</td>
                    <td>{{ $ente->Numdoc }}</td>
                    <td>{{ $ente->Nombres }}</td>
                    <td>{{ $ente->RazonSocial }}</td>
                    <td>{{ $ente->Direccion }}</td>
                    <td>{{ $ente->Telefono }}</td>
                    <td>{{ $ente->CorreoInstitucional }}</td>
                    <td class="text-center">

                        <a href="{{ route('entecoformadores.edit', $ente->NIS) }}"
                            class="btn btn-primary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form class="deleteForm"
                            action="{{ route('entecoformadores.destroy', $ente->NIS) }}"
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
                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">Sin registros</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($datos, 'links'))
        <div class="card-footer clearfix">
            {{ $datos->links() }}
        </div>
    @endif
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Read flash message from hidden input (no Blade inside JS)
    const successInput = document.getElementById('successMessage');
    const successMessage = successInput ? successInput.value.trim() : '';

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: successMessage,
            showConfirmButton: false,
            timer: 2000
        });
    }

    // Attach delete handlers
    document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el ente coformador definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const action = this.action;
                    const methodInput = this.querySelector('input[name="_method"]');
                    const method = methodInput ? methodInput.value : this.method;
                    const formData = new FormData(this);

                    fetch(action, {
                        method: method.toUpperCase(),
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                    })
                    .then(async response => {
                        const contentType = response.headers.get('content-type') || '';
                        if (contentType.includes('application/json')) {
                            return response.json();
                        }
                        return { success: response.ok };
                    })
                    .then(data => {
                        if (data && data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: data.message || 'El ente coformador se eliminó correctamente.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data && data.message ? data.message : 'No se pudo eliminar el ente.',
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
