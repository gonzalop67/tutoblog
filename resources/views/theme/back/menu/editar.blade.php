@extends('theme.back.app')
@section('titulo')
    Sistema Menús
@endsection

@section('contenido')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <x-alert tipo="danger" :mensaje="$errors" />
            @endif
            <div class="card">
                <div class="card-header bg-success">
                    <h5 class="text-white float-left">Editar Menu {{$data->nombre}}</h5>
                    <a href="{{route('menu')}}" class="btn btn-outline-light btn-sm float-right">Volver al listado</a>
                </div>
                <form action="{{ route('menu.actualizar', $data->id) }}" id="form-general" class="form-horizontal" method="post">
                    @csrf @method('put')
                    <div class="card-body">
                        @include('theme.back.menu.form')
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

@section('scripts')
    <script src="{{ asset('assets/back/js/scripts/menu/crear.js') }}"></script>
@endsection
