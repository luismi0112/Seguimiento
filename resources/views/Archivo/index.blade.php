@extends('adminlte::page')

@section('title', 'Archivos')

@section('content_header')
<h1>Archivos</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ route('archivos.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Subir Bitacora
        </a>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de subida</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($archivos as $archivo)
                <tr>
                    <td>{{ $archivo['name'] }}</td>
                    <td>{{ $archivo['created_at'] }}</td>
                    <td class="text-center">
                        <a href="{{ $archivo['url'] }}" target="_blank" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>

                        <form action="{{ route('archivos.destroy', basename($archivo['path'])) }}"
                            method="POST" style="display:inline-block">
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
                    <td colspan="3" class="text-center">No hay archivos disponibles</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop