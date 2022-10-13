@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="my-5" action="{{route('admin.tags.update',  ['tag' => $tag->id])}}" method="POST">
            @method('PUT')
            @csrf 
            {{-- NAME --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $tag->name)}}"/>
                @error('name')
                    <div class='invalid-feedback alert alert-danger p-1'>
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Modifica Tag</button>
            <a class="btn btn-primary d-inline-block" href="{{route('admin.tags.index')}}">Annulla</a>
        </form>
    </div>
@endsection