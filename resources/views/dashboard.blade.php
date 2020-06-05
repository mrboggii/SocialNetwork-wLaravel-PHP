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
            @foreach($posts as $post)

            
            <article class="post">
            <p>{{ $post->body }}</p>
                <div class="info">
                    Publicado por {{ $post->user->first_name }} el {{ $post->created_at }}
                </div>
                <div class="interaction">
                    <a href="#">Me encanta!</a> |
                    <a href="#">Vaya chorrada</a> |
                    <a href="#">Edit</a> |
                    <a href="#">Eliminar</a>
                </div>
            </article>

            @endforeach
        </div>
    </section>
@endsection