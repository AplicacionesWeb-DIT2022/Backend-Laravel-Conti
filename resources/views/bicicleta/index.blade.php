@extends('layouts.app')

@section('content')

<div class="container">

    @if(Session::has('mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('mensaje') }}
    </div>
    @endif

<a href="{{ url('bicicleta/create') }}" class="btn btn-success">Registrar nuevo bicicleta</a>
<br>
<table class="table table-ligth" >
    <thead class="thead-ligth">
        <tr>   
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Modelo</th>
            <th>Tipo</th>
            <th>Terreno</th>
            <th>Edad</th>
            <th>Marca</th>
            <th>Detalle de Equipamiento</th>
            <th>Anio</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($bicicletas as $bicicleta)
            <tr>
                <td>{{ $bicicleta->id }}</td>
                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$bicicleta->Foto }}" width="100" alt="Error">
                </td>
                <td>{{ $bicicleta->Nombre }}</td>
                <td>{{ $bicicleta->Modelo }}</td>
                <td>{{ $bicicleta->Tipo }}</td>
                <td>{{ $bicicleta->Terreno }}</td>
                <td>{{ $bicicleta->Edad }}</td>
                <td>{{ $bicicleta->Marca }}</td>
                <td>{{ $bicicleta->DetalleEquipamiento }}</td>
                <td>{{ $bicicleta->Anio }}</td>
                <td>{{ $bicicleta->Precio }}</td>
                <td>
                    <a href="{{ url('/bicicleta/'.$bicicleta->id.'/edit') }}" class="btn btn-warning">Editar </a>
                        |
                    <form action="{{ url('/bicicleta/'.$bicicleta->id )}}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres Borrar?')" value="Borrar">  
                    </form>
                </td>
            </tr>
        
        @endforeach
        <tr>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

{!! $bicicletas->links() !!}

</div>

@endsection