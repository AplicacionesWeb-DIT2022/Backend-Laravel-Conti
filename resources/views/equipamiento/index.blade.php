@extends('layouts.app')

@section('content')

<div class="container">

    @if(Session::has('mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('mensaje') }}
    </div>
    @endif

<a href="{{ url('equipamiento/create') }}" class="btn btn-success">Registrar nuevo equipamiento</a>
<br>
<table class="table table-ligth" >
    <thead class="thead-ligth">
        <tr>   
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($equipamientos as $equipamiento)
            
            <tr>
                <td>{{ $equipamiento->id }}</td>

                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$equipamiento->Foto }}" width="100" alt="Error">
                </td>
                
                
                <td>{{ $equipamiento->Nombre }}</td>
                <td>{{ $equipamiento->Apellido }}</td>
                <td>{{ $equipamiento->Email }}</td>
                <td>
                    <a href="{{ url('/equipamiento/'.$equipamiento->id.'/edit') }}" class="btn btn-warning">Editar </a>
                        |
                    <form action="{{ url('/equipamiento/'.$equipamiento->id )}}" class="d-inline" method="post">
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

{!! $equipamientos->links() !!}

</div>

@endsection