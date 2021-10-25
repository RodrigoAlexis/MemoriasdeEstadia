@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active tab-home" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Crear grupo</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link tab-archivo" id="archivos-tab" data-toggle="tab" href="#archivos" role="tab" aria-controls="archivos" aria-selected="false">Alumnos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('Administrador.MakeGrupo.CrearGrupo')
    </div>
        <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="archivos-tab">
        @include('Administrador.newGrupo')
        </div>
    </div>
</div>
    
@endsection