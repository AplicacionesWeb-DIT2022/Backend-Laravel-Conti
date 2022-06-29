@extends('layouts.app')
@section('content')
<div class="container">
    
    <form action="{{ url('/equipamiento') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('equipamiento.form',['modo'=>'Crear'])
    </form>    

</div>
@endsection