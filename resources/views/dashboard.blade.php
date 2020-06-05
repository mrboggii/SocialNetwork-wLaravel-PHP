@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Tienes algo que ocultar?</h3></header>
        <form action="{{ route('post.create') }}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Tu publicación"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Lo que ocultan los demás usuarios de Faceless</h3></header>
            <article class="post">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam ullam iure assumenda, alias voluptates ea quas nemo a debitis, maxime laboriosam voluptatum numquam doloribus, autem deleniti doloremque sunt exercitationem consequatur!</p>
                <div class="info">
                    Publicado por: User el 13 de Feb de 2016
                </div>
                <div class="interaction">
                    <a href="#">Me encanta!</a> |
                    <a href="#">Vaya chorrada</a> |
                    <a href="#">Edit</a> |
                    <a href="#">Eliminar</a>
                </div>
            </article>
            <article class="post">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam ullam iure assumenda, alias voluptates ea quas nemo a debitis, maxime laboriosam voluptatum numquam doloribus, autem deleniti doloremque sunt exercitationem consequatur!</p>
                <div class="info">
                    Publicado por: User el 13 de Feb de 2016
                </div>
                <div class="interaction">
                    <a href="#">Me encanta!</a> |
                    <a href="#">Vaya chorrada</a> |
                    <a href="#">Editar</a> |
                    <a href="#">Eliminar</a>
                </div>
            </article>
        </div>
    </section>
@endsection