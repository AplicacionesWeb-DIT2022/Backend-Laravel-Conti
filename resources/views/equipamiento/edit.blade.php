@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/equipamiento/'.$equipamiento->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('equipamiento.form',['modo'=>'Editar'])
    </form>

</div>
@endsection