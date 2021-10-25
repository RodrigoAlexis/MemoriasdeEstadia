@extends('layouts.app')


@section('content')

<div class="container">

<h4>Biblioteca</h4>
           
<br>
        
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active tab-tabla" id="tabla-tab" data-toggle="tab" href="#tabla" role="tab" aria-controls="tabla" aria-selected="true">tabla</a>
        </li>
        <li class="nav-item" role="presntation">
            <a class="nav-link tab-busqueda" id="busqueda-tab" data-toggle="tab" href="#busqueda" role="tab" aria-controls="busqueda" aria-selected="false">busqueda</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
         
        <div class="tab-pane fade show active" id="tabla" role="tabpanel" aria-labelledby="tabla-tab">
           
            @include('biblioteca.tabla')
        </div>
        
    </div>
</div>


@endsection