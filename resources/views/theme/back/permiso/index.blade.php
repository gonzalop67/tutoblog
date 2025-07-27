@extends('theme.back.app')
@section('titulo')
    Permisos
@endsection

@section('scripts')
    <script src="{{ asset('assets/back/js/pages/scripts/permiso/index.js') }}"></script>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-lg-12">
            @if ($mensaje = session('mensaje'))
                <x-alert tipo="success" :mensaje="$mensaje" />
            @endif
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="text-white float-left">Permisos</h5>
                    <a href="{{ route('permiso.crear') }}" class="btn btn-outline-light btn-sm float-right">
                        Crear Permiso
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Slug</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td>{{ $permiso->nombre }}</td>
                                        <td>{{ $permiso->slug }}</td>
                                        <td>
                                            <a href="{{ route("permiso.editar", $permiso->id) }}" data-toggle="tooltip" title="Editar este registro"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route("permiso.eliminar", $permiso->id) }}" class="form-eliminar d-inline" method="post">
                                                @csrf @method('delete')
                                                <button type="button" class="btn-accion-tabla boton-eliminar bg-white" title="Eliminar este registro"><i class="text-danger fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
