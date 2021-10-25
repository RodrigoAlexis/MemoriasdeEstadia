@extends('layouts.app')

@section('content')
<div class="container">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active tab-home" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link tab-archivo" id="archivos-tab" data-toggle="tab" href="#archivos" role="tab" aria-controls="archivos" aria-selected="false">Archivos</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('Estudiante.home')
        </div>
        <div class="tab-pane fade" id="archivos" role="tabpanel" aria-labelledby="archivos-tab">
            @include('Estudiante.archivos')
        </div>
    </div>
</div>
@endsection

<script>

if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, '/estudiante', window.location.href);
}

$(document).ready(function(){
    $('#Modal').modal({
        backdrop: 'static'
        });
    });
</script>