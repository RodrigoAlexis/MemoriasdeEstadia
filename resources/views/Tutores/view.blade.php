@extends('layouts.app')

@section('content')
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>

    <div class="container">
    <center>
    <h2>Memoria De Estadia</h2>
    <center>
        <div class="row">
                <div class=" col-lg-7 col-md-7 col-sm-7">
                    
                        <div class="embed-responsive embed-responsive-16by9" >
                            <iframe src="" style="height:500px;width:600px;" title="iframe"></iframe>
                        </div> 
                </div>
                @foreach($memoria as $memoria)
                <table class="table table-borderless  col-lg-2   col-md-2 col-sm-9 hidden-xs">
                    <center>
                   
                        <tr>
                            <td>
                                <a type="button" target="_blank"  href="{{ url('revision/'.$memoria->id_alumno) }}" class="btn btn-outline-info btn-md"  style=" width: 125px;">  Ver
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </a>   
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a type="button" href="{{ url('download/'.$memoria->id_alumno) }}" class="btn btn-outline-primary btn-md" style=" width: 125px;">Descargar
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud-download-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                   
                            <tr>
                                <td>
                                    <form action="{{url('regresar/'.$memoria->id_alumno)}}" method="post">
                                    @csrf
                                        <button type="submit" class="btn btn-outline-secondary btn-md" style=" width: 125px;">Regresar
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.5 8.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <form action="{{ url('Tutores/'.$memoria->id_alumno) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                        <button type="submit"  class="btn btn-outline-success btn-md" style=" width: 125px;">Aprobar
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    </center>
                </table>
                @endforeach
                    <div class="card float-right  col-lg-3    col-md-9 col-sm-7 "  style="width: 15rem;">
                        <ul class="list-group list-group-flush" style="height: 3.5rem;">
                            <li class="list-group-item">
                                <h3 class="text-center">Comentarios</h3>
                             </li>
                        </ul>
                        <div class="card-body comentarios scrollbar-ripe-malinka" >
                            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi temporibus quibusdam, excepturi exercitationem harum dolor ex molestiae cumque vitae labore quae placeat est ducimus culpa sit? Reprehenderit consequatur asperiores sed.</p>
                        </div>
                        <div class="card-footer">
                            <textarea class="form-control" name="comentarios" id="comentarios" cols="10" rows="4" placeholder="Escribe aqui tus comentarios"></textarea>
                                <br>
                                <button type="submit" class="btn btn-success">Envíar</button>
                        </div>
    
                    </div>  
                   
        </div>
    </div>
</body>
@endsection

