@extends('layouts.master')
@section('title','Llista estudiants')
@section('content')





<body>
    <h1>Llista estudiants</h1>
    <div class="row">
  
    <style>
    #boto{
        padding: 8px;
    }

</style>
<div class="col-sm-8">
    <table border="1">
        <tr>
           
            <th>Nom:</th>
            <th>Email:</th>
            <th>Adreça:</th>
           
        </tr>

        @foreach ($students as $student)
       
        <tr>
            
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->address }}</td>
           
            <td><a href="{{route('edit',$student->id)}}" method="POST" class="btn btn-success">Editar</td></a>
            
           

            <td><form action="{{ route('delete', $student->id) }}" method="POST" onsubmit="return confirm('Aquesta acció esborrarà aquest estudiant')">
            @csrf
            <button type="submit" id="boto"  class="btn btn-danger btn-sm">Eliminar</button></form></td>
            
            
              
                
                
        </tr>
        @endforeach
    </table>
</div>

@stop