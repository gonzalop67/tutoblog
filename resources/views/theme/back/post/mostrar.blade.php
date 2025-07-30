<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-success">
                <h5 class="text-white float-left">{{ $post->titulo }}</h5>
            </div>

            {{-- <form action="" id="form-general" class="form-horizontal" method="post"> --}}

                <div class="card-body">
                    <div class="form-group row">
                        <label for="categoria" class="col-sm-3 text-right control-label">Categorías:</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{ $post->categoria->implode('nombre', ' - ') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tags" class="col-sm-3 text-right control-label">Tags:</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{ $post->tag->implode('nombre', ' - ') }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-3 text-right control-label">Descripción:</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{ $post->descripcion }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contenido" class="col-sm-3 text-right control-label">Contenido:</label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{!! $post->contenido !!}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            @php
                                $imagen = $post->archivo ?? null;
                            @endphp
                            @if ($imagen)
                                <img src="{{ asset("storage/$imagen->ruta") }}" alt="Imagen del post" class="img-fluid"
                                    width="50%">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10"></div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary btn-sm"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- </form> --}}

        </div>
    </div>
</div>
