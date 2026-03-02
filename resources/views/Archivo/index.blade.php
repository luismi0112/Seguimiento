@extends('adminlte::page')

@section('title', 'Archivos')

@section('content_header')
<h1>Gestión de Archivos</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-folder"></i> Subir nuevo archivo</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre personalizado</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe un nombre para el archivo" required>
            </div>
            <div class="form-group">
                <label for="archivo">Seleccionar archivo</label>
                <input type="file" class="form-control" id="archivo" name="archivo" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo destino (opcional)</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@gmail.com">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Subir
            </button>
        </form>
    </div>
</div>

<div class="card card-info mt-4">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list"></i> Archivos almacenados</h3>
    </div>

    <div class="card-body">
        @if(empty($files))
        <p>No hay archivos disponibles.</p>
        @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de subida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr>
                    <td>{{ $file['name'] }}</td>
                    <td>{{ $file['created_at'] }}</td>
                    <td>
                        <a href="{{ $file['url'] }}" target="_blank" class="btn btn-info btn-sm">
                            <i class="fas fa-download"></i> Ver
                        </a>
                        <form action="{{ route('archivos.destroy', basename($file['path'])) }}" method="POST" style="display:inline-block">
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
        @endif
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Operación Exitosa!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
    });
</script>
@endif
@stop