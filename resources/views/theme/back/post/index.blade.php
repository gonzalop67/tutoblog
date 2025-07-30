@extends('theme.back.app')
@section('titulo')
    Posts
@endsection

@section('contenido')
    <div class="row">
        @csrf
        <div class="col-lg-12">
            @if ($mensaje = session('mensaje'))
                <x-alert tipo="success" :mensaje="$mensaje" />
            @endif
            <div class="card">
                <div class="card-header bg-info">
                    <h5 class="text-white float-left">Posts</h5>
                    <a href="{{ route('post.crear') }}" class="btn btn-outline-light btn-sm float-right">
                        Crear Post
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="no-sort no-search" style="width:30px">Id</th>
                                    <th class="no-sort no-search" style="width:40px"></th>
                                    <th>Título</th>
                                    <th>Categoría</th>
                                    <th>Tags</th>
                                    <th class="no-sort no-search" style="width: 60px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    @php
                                        $imagen = $post->archivo->ruta ?? null;
                                    @endphp
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            @if ($imagen)
                                                <img src="{{ asset("storage/$imagen") }}" alt="" width="30px">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('post.mostrar', $post) }}" class="mostrar-registro"
                                                data-toggle="tooltip">{{ $post->titulo }}</a>
                                        </td>
                                        <td>{{ $post->categoria->implode('nombre', ' - ') }}</td>
                                        <td>{{ $post->tag->implode('nombre', ' - ') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route("post.editar", $post) }}" data-toggle="tooltip" title="Editar este registro"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route("post.eliminar", $post) }}" class="form-eliminar d-inline" method="post">
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
    {{-- Modal --}}
    <div class="modal fade" id="show-post" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/back/js/scripts/post/index.js') }}"></script>
@endsection
