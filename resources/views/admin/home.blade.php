@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Benvenuto {{Auth::user()->name}}</h1>
        <h3>Sei registrato con la mail {{Auth::user()->email}}</h3>
    </div>

@endsection