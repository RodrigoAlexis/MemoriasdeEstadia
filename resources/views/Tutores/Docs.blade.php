@extends('layouts.app')

@section('content')
<div class="container">
    <center>
        <h2>Documentación</h2>
    </center>
            <table class="table">
                <thead class="thead-light" >
                    <tr>
                        <th >#</th>
                        <th >Archivo</th>
                        <th >Acción </th>
                    </tr>
                </thead>
                        <tbody >
                            @foreach($docs as $docs)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$docs->nombre}}</td>
                                   
                                    <td>
                                        <a class="btn btn-outline-secondary" target="" href="{{ url('descargar/'.$docs->id_alumno) }}">
                                            Descargar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
            </table>
</div>
@endsection