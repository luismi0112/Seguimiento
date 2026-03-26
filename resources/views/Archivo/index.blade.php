@extends('adminlte::page')

@section('title', 'Archivos')

@section('content_header')
<h1>Archivos</h1>
@stop

@section('content')
<div class="row">
    <!-- Columna izquierda: formulario -->
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Subir Archivo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre del archivo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Seleccionar archivo</label>
                        <input type="file" name="archivo" id="archivo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo de notificación (opcional)</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-upload"></i> Subir
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Columna derecha: listado -->
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Archivos Subidos</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($archivos as $archivo)
                        <tr>
                            <td>
                                @php
                                $ext = pathinfo($archivo->nombre, PATHINFO_EXTENSION);
                                @endphp

                                @if($ext === 'pdf')
                                <i class="fas fa-file-pdf text-danger"></i>
                                @elseif(in_array($ext, ['doc','docx']))
                                <i class="fas fa-file-word text-primary"></i>
                                @elseif(in_array($ext, ['xls','xlsx']))
                                <i class="fas fa-file-excel text-success"></i>
                                @elseif(in_array($ext, ['jpg','jpeg','png','gif']))
                                <i class="fas fa-file-image text-warning"></i>
                                @else
                                <i class="fas fa-file text-secondary"></i>
                                @endif

                                {{ $archivo->nombre }}
                            </td>
                            <td>{{ $archivo->fecha }}</td>
                            <td>{{ $archivo->hora }}</td>
                            <td class="text-center">
                                <a href="{{ asset('storage/archivos/' . $archivo->nombre) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay archivos disponibles</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop