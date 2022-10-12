@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="d-flex justify-content-between">
          <a href="{{route('admin.categories.create')}}" class="btn btn-success mb-3">Crea Nuova Categoria</a>
        <div>
          <a href="{{route('admin.posts.simone')}}" class="btn btn-primary mb-3">Post Simone</a>
          <a href="{{route('admin.posts.alessio')}}" class="btn btn-primary mb-3">Post Alessio</a>
          <a href="{{route('admin.posts.jacopo')}}" class="btn btn-primary mb-3">Post Jacopo</a>
        </div>
      </div> --}}
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Numero Post</th>
              </tr>
            </thead>
            <tbody class="table-light text-dark">
                @foreach ($tags as $tag)
                <tr>
                    <th scope="row">{{$tag->id}}</th>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->slug}}</td>
                    <td class="px-5">{{count($tag->posts)}}</td>
                    {{-- <td class="text-center">
                        <a href="{{route('admin.categories.show', ['tag' => $tag->id])}}" class="btn btn-success">Vedi</a>
                        <a href="{{route('admin.categories.edit', ['tag' => $tag->id])}}"  class="btn btn-warning">Modifica</a>
                        <form class="d-inline-block" action="{{route('admin.categories.destroy', ['tag' => $tag])}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>  --}}
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection