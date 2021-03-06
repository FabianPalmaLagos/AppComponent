@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        img {
            position: static;
            box-shadow: #1b1f24;
            border-block: inherit;
            border-color: whitesmoke;
            padding: 10%;
            max-height: 14rem;
            color: #fff;
        }

        p {
            margin-top: 15px;
            font-size: 1.1rem;
            line-height: 1.4;
            text-align: center;
            font-style: italic;
        }

        h4 {
            color: turquoise;
            font-style: italic;
            font-weight: 600;
            height: 3rem;
        }

        .card-img {
            min-height: 240px;
        }

        .headcomp {
            color: #989797;
            text-shadow: 1px 2px 0 #7D6666;
        }

        .card-body {
            height: 10rem;
        }

        .contenedor {
            min-height: 300px;
            border-radius: 20px;
            background-color: white;
            box-shadow: 8px 10px 16px -4px rgba(0, 0, 0, 0.78);
            -webkit-box-shadow: 8px 10px 16px -4px rgba(0, 0, 0, 0.78);
            -moz-box-shadow: 8px 10px 16px -4px rgba(0, 0, 0, 0.78);
        }

        .contenedor:hover {
            transform: translateY(-15px);
            transition: transform .3s;
        }
    </style>
    <div class="container">
        <div class="row py-5 ">
            <div class="col-lg-5 m-auto text-center">
                <h1 class="headcomp">SUCURSAL {{$sucursal->nombre}} </h1>
            </div>
        </div>
        @if(isset($messageError))
        <div class="alert alert-danger">
            {{ $messageError }}
        </div>
        @elseif(isset($messageAdd))
        <div class="alert alert-success">
            {{ $messageAdd }}
        </div>
        @elseif(isset($messageEdit))
        <div class="alert alert-primary">
            {{ $messageEdit }}
        </div>
        @endif
        <div class="row justify-content-center">

            <div class="d-flex justify-content-end">
                <a class="btn btn-sm btn-success" href="{{ url('agregarComponenteSucursal/'.$sucursal->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg> Agregar componente</a>
            </div>
            @if(isset($componentesSucursal))

            @foreach($componentesSucursal as $componentes)
            <div class="col-3 text-center mt-4 mb-4">
                <div class="contenedor">
                    <div class="card-img">
                        @if(Storage::disk('imagenes')->has($componentes->componente->imagen))
                        <img src="{{ url('miniatura/'.$componentes->componente->imagen) }}" class="img-fluid rounded-start" width="400" height="450" alt="...">
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h4>{{ $componentes->componente->nombre }}</h4>
                            <p class="card-text"><b>Stock: {{$componentes->stock}}</b></p>
                        </div>
                    </div>
                    <div class="card-footer" style="min-height: 49px;">
                        <a href="#eliminarModal{{$componentes->id}}" role="button" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>
                        <a href="#editarModal{{$componentes->id}}" role="button" class="btn btn-sm btn-warning" data-toggle="modal">Editar</a>
                    </div>
                </div>
                <div id="eliminarModal{{$componentes->id}}" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title ">??Est??s seguro?</h4>
                            </div>
                            <div class="modal-body">
                                <p>??Seguro que quieres borrar el componente {{ $componentes->componente->nombre }}?</p>
                                <p><small>Si lo borras, nunca podr??s recuperarlo.</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <a href="{{ route('eliminarComponenteSucursal', ['idS' => $componentes->id_sucursal, 'id' => $componentes->id]) }}" type="button" class="btn btn-danger">Eliminar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="editarModal{{$componentes->id}}" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">??Est??s seguro?</h4>
                            </div>
                            <div class="modal-body">
                                <p>??Seguro que quieres editar el componente {{ $componentes->componente->nombre }}?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <a href="{{ route('editarComponenteSucursal', ['idS' => $componentes->id_sucursal, 'idC' => $componentes->id_componente]) }}" type="button" class="btn btn-warning">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @else

            @endif

        </div>
    </div>
</div>
@endsection