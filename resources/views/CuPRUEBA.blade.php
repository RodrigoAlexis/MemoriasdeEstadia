@extends('layouts.app')

@section('content')

    <div class="container">
        @php
        $user= auth()->user();
        @endphp

        @if ($user->hasRole('Administrador'))
            <a class="btn btn-success btn-bolck">Solo Administrador</a>
        @endif
            @if ($user->hasRole('Alumno'))
                <a class="btn btn-danger btn-bolck">Solo Alumno</a>
            @endif

            @if ($user->hasRole('Profesor'))
                <a class="btn btn-info btn-bolck">Solo Profesor</a>
            @endif

            @if ($user->hasRole('Directivo'))
                <a class="btn btn-warning btn-bolck">Solo Director</a>
            @endif
        
    </div>

@endsection