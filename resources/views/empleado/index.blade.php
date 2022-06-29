@extends('layouts.app')

@section('content')

<div class="container">

    @if(Session::has('mensaje'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('mensaje') }}
    </div>
    @endif

<a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
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
        @foreach($empleados as $empleado)
            
            <tr>
                <td>{{ $empleado->id }}</td>

                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt="Error">
                </td>
                
                
                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->Apellido }}</td>
                <td>{{ $empleado->Email }}</td>
                <td>
                    <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">Editar </a>
                        |
                    <form action="{{ url('/empleado/'.$empleado->id )}}" class="d-inline" method="post">
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

{!! $empleados->links() !!}

</div>

@endsection