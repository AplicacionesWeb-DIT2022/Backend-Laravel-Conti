@extends('layouts.app')
@section('content')
<div class="container">
    
    <form action="{{ url('/bicicleta') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('bicicleta.form',['modo'=>'Crear'])
    </form>    

</div>
@endsection