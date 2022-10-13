@extends('layouts.app')

@section('content')
    <div class="container">
      <a href="{{route('admin.tags.create')}}" class="btn btn-success mb-3">Crea Nuova Categoria</a>
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Numero Post</th>
                <th scope="col" class="text-center">Gestisci</th>
              </tr>
            </thead>
            <tbody class="table-light text-dark">
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td class="px-5">{{count($category->posts)}}</td>
                    <td class="text-center">
                        <a href="{{route('admin.categories.show', ['category' => $category->id])}}" class="btn btn-success">Vedi</a>
                        <a href="{{route('admin.categories.edit', ['category' => $category->id])}}"  class="btn btn-warning">Modifica</a>
                        <form class="d-inline-block" action="{{route('admin.categories.destroy', ['category' => $category])}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td> 
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection