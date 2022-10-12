@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>{{$tag->name}}</h1>
    @if (count($tag->posts))
      <h3>Ci sono n° {{count($tag->posts)}} post di questo tag</h3>
      <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Slug</th>
            </tr>
          </thead>
          <tbody class="table-light text-dark">
              @foreach ($tag->posts as $post)
              <tr>
                  <th scope="row">{{$post->id}}</th>
                  <td>{{$post->title}}</td>
                  <td>{{$post->slug}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
    @else 
        <h3>Non ci sono post per questa Categoria</h3>
    @endif
    <a href="{{route('admin.tags.index')}}" class="btn btn-primary mt-3">Vai a tutti i tag</a>
  </div>
@endsection