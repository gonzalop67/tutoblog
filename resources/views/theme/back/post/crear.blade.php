@extends('theme.back.app')
@section('titulo', 'Sistema Post')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/back/extra-libs/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/libs/quill/dist/quill.snow.css') }}">
@endsection

@section('scriptsPlugins')
    <script src="{{ asset('assets/back/extra-libs/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/back/extra-libs/bootstrap-fileinput/js/locales/es.js') }}"></script>
    <script src="{{ asset('assets/back/extra-libs/bootstrap-fileinput/themes/fa5/theme.js') }}"></script>
    <script src="{{ asset('assets/back/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/back/libs/select2/dist/js/i18n/es.js') }}"></script>
    <script src="{{ asset('assets/back/libs/quill/dist/quill.min.js') }}"></script>
@endsection

@section('scripts')
    <script src="{{ asset('assets/back/js/scripts/post/crear.js') }}"></script>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            @if ($mensaje = session('mensaje'))
                <x-alert tipo="success" :mensaje="$mensaje" />
            @endif
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            <div class="card">
                <div class="card-header bg-success">
                    <h5 class="text-white float-left">Crear post</h5>
                    <a href="{{ route('post') }}" class="btn btn-outline-light btn-sm float-right">Volver al listado</a>
                </div>
                <form action="{{ route('post.guardar') }}" id="form-general" class="form-horizontal" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @include('theme.back.post.form')
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
