@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="my-5" action="{{route('admin.categories.update',  ['category' => $category->id])}}" method="POST">
            @csrf 
            @method('PUT')
            {{-- NAME --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $category->name)}}"/>
                @error('name')
                    <div class='invalid-feedback alert alert-danger p-1'>
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Modifica Categoria</button>
            <a class="btn btn-primary d-inline-block" href="{{route('admin.categories.index')}}">Annulla</a>
        </form>
    </div>
@endsection