@extends('layouts.app')

@section('content')

<div class="container">

    @if(Session::has('mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('mensaje') }}
    </div>
    @endif

<a href="{{ url('cliente/create') }}" class="btn btn-success">Registrar nuevo cliente</a>
<br>
<table class="table table-ligth" >
    <thead class="thead-ligth">
        <tr>   
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Documento</th>
            <th>Direccion</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($clientes as $cliente)
            
            <tr>
                <td>{{ $cliente->id }}</td>

                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$cliente->Foto }}" width="100" alt="Error">
                </td>
                
                
                <td>{{ $cliente->Nombre }}</td>
                <td>{{ $cliente->Apellido }}</td>
                <td>{{ $cliente->Email }}</td>
                <td>{{ $cliente->Documento }}</td>
                <td>{{ $cliente->Direccion }}</td>
                <td>
                    <a href="{{ url('/cliente/'.$cliente->id.'/edit') }}" class="btn btn-warning">Editar </a>
                        |
                    <form action="{{ url('/cliente/'.$cliente->id )}}" class="d-inline" method="post">
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

{!! $clientes->links() !!}

</div>

@endsection