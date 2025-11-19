@extends('layouts.master')
@section('title','Crear estudiant')
@section('content')
<style>
        div+div {
            
            margin-bottom: 10px;
        }
         label {
            width: 80px; 
            margin-bottom: 10px;
          
        }
        input {
            flex: 1;
            padding: 5px;
        }
</style>

<h1>Alta de estudiant </h1>
<form action="{{ route('store') }}" method="GET">
<div class="form-grup">
<label for="name" >Nom:</label>
<input type="text" id="name" name="name" required>
</div>

<div class="form-grup">
<label for="email">Correu electrónic:</label>
<input type="email" id="email" name="email" required>
</div>
  
<div class="form-grup">
<label for="address">Adreça:</label>
<input type="text" id="address" name="address" required>
</div>

<button type="submit">Afegir estudiant</button>

</form>
@stop