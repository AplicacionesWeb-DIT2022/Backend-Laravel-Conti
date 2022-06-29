<h1>{{ $modo }} bicicleta</h1>

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
    <input type="text" class="form-control" name="Nombre" value="{{ isset($bicicleta->Nombre)?$bicicleta->Nombre:old('Nombre') }}" id="Nombre"> 
    <br>
</div>

<div class="form-group">
  <label for="Modelo"> Modelo </label>
  <input type="text" class="form-control" name="Modelo" value="{{ isset($bicicleta->Modelo)?$bicicleta->Modelo:old('Modelo') }}" id="Modelo">
  <br>
</div>

<div class="form-group">
  <label for="Tipo"> Tipo </label>
  <input type="text" class="form-control" name="Tipo" value="{{ isset($bicicleta->Tipo)?$bicicleta->Tipo:old('Tipo') }}" id="Tipo">
  <br>
</div>

<div class="form-group">
  <label for="Terreno"> Terreno </label>
  <input type="text" class="form-control" name="Terreno" value="{{ isset($bicicleta->Terreno)?$bicicleta->Terreno:old('Terreno') }}" id="Terreno">
  <br>
</div>

<div class="form-group">
  <label for="Edad"> Edad </label>
  <input type="text" class="form-control" name="Edad" value="{{ isset($bicicleta->Edad)?$bicicleta->Edad:old('Edad') }}" id="Edad">
  <br>
</div>

<div class="form-group">
  <label for="Marca"> Marca </label>
  <input type="text" class="form-control" name="Marca" value="{{ isset($bicicleta->Marca)?$bicicleta->Marca:old('Marca') }}" id="Marca">
  <br>
</div>

<div class="form-group">
  <label for="DetalleEquipamiento"> DetalleEquipamiento </label>
  <input type="text" class="form-control" name="DetalleEquipamiento" value="{{ isset($bicicleta->DetalleEquipamiento)?$bicicleta->DetalleEquipamiento:old('DetalleEquipamiento') }}" id="DetalleEquipamiento">
  <br>
</div>

<div class="form-group">
  <label for="Anio"> Anio </label>
  <input type="text" class="form-control" name="Anio" value="{{ isset($bicicleta->Anio)?$bicicleta->Anio:old('Anio') }}" id="Anio">
  <br>
</div>

<div class="form-group">
  <label for="Precio"> Precio </label>
  <input type="text" class="form-control" name="Precio" value="{{ isset($bicicleta->Precio)?$bicicleta->Precio:old('Precio') }}" id="Precio">
  <br>
</div>

<div class="form-group">
  <label for="Foto"> Foto </label>
  @if (isset($bicicleta->Foto))
  <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$bicicleta->Foto }}" width="100" alt="Error">
  @endif
</div>

<div class="form-group">
  <input type="file" class="form-control" name="Foto" id="Foto">   
  <br>
</div>

<div class="form-group">
  <input class="btn btn-success" type="submit" value="{{ $modo }} Datos">
  <a class="btn btn-primary" href="{{ url('bicicleta') }}">Regresar</a>
</div>