@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/bicicleta/'.$bicicleta->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('bicicleta.form',['modo'=>'Editar'])
    </form>

</div>
@endsection