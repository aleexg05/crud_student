@extends('layouts.master')

@section('title','Modificar estudiant')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center my-4">Modificar estudiant</h2>
        <form action="{{ route('update',$student->id) }}" method="POST">
            @csrf
            @method('PUT')

             <div>
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}"  required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
            </div>

            <div>
                <label for="address">Adreça:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $student->address }}" required>
            </div>

           
    <br>
            <div>
                <button type="submit">Modificar estudiant</button>
            </div>
        </form>
        </div>
    </div>
@endsection