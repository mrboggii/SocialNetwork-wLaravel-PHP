@extends('layouts.master')

@section('title')
    Faceless
@endsection

@section('content')
    @if(count($errors) > 0)
    <div class="row">
        <div class="col-md-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h3>Registrarse</h3>
        <form action="{{ route('signup') }}" method="post">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <input class="form-control" type="text" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">
                    Registrarse
                </button>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col-md-6">
            <h3>Entrar</h3>
        <form action="{{ route('signin') }}" method="post">
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-primary">
                    Entrar
                </button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            
        </div>            
    </div>
@endsection