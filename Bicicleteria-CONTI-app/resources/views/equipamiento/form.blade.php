<h1>{{ $modo }} equipamiento</h1>

@if (count($errors)>0)

    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif

<div class="form-group">
    <br>
    <label for="Nombre"> Nombre </label>
    <input type="text" class="form-control" name="Nombre" value="{{ isset($equipamiento->Nombre)?$equipamiento->Nombre:old('Nombre') }}" id="Nombre"> 
    <br>
</div>

<div class="form-group">
  <label for="Apellido"> Apellido </label>
  <input type="text" class="form-control" name="Apellido" value="{{ isset($equipamiento->Apellido)?$equipamiento->Apellido:old('Apellido') }}" id="Apellido">
  <br>
</div>

<div class="form-group">
  <label for="Email"> Email </label>
  <input type="text" class="form-control" name="Email" value="{{ isset($equipamiento->Email)?$equipamiento->Email:old('Email') }}" id="Email">
  <br>
</div>

<div class="form-group">
  <label for="Foto"> Foto </label>
  @if (isset($equipamiento->Foto))
  <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$equipamiento->Foto }}" width="100" alt="Error">
  @endif
</div>

<div class="form-group">
  <input type="file" class="form-control" name="Foto" id="Foto">   
  <br>
</div>

<div class="form-group">
  <input class="btn btn-success" type="submit" value="{{ $modo }} Datos">
  <a class="btn btn-primary" href="{{ url('equipamiento') }}">Regresar</a>
</div>