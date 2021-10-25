<div class=" text-center col-12" >
        <h1>Descargar y Agregar Documentación</h1>
        <h5>( Carta de presentación, Carta de Aceptación, Evaluación SAC-F-05, Formato de Estadía)</h5>
    <br>
</div>
<div class="row">
    <div class="col-6">

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre del Archivo</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   @foreach($docprofesor as $doc)
        <tr>
            <td>{{$doc->nombre_documento_profesor}}</td>
            <td>
                <a href="{{url('estudiante/'.$doc->id_user_alumno)}}" style="background-color:#621132; color:#FFFFFF;" type="button" class="btn">
                    <svg width="1.2em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7.5 1.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4a.5.5 0 0 0-1 0v3.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 11.293V7.5z"/>
                    </svg> Descargar
                </a>
            </td>
        </tr>
@endforeach
  </tbody>
</table>
    </div>

    <div class="col-6 col-lg-6 col-md-8 col-sm-12">
        <form method="post" action="{{ url('/estudiante') }}" enctype="multipart/form-data">
            @csrf
            <select class="custom-select " id="select" name="select" onchange="showDiv(this)">
                <option value="0">Selecciona una opción</option>
                <option value="Carta de aceptacion">Carta de Aceptación</option>
                <option value="Evaluacion SAC-F-05">Evaluación SAC-F-05</option>
            </select>
        <br>
        <br>
        <div>
            <table class="table">
                <tr>
                    <th>
                        <div id="subir" style="display:none">
                            <label for="">Sube tu archivo</label>
                            <br>
                            <input type="file" name="txtFile" id="txtFile" class="form-control">
                        </div>
                        <br>                        <br>
                        <center>
                            <button type="submit" class="btn btn-success" id="button" style="display:none">Subir</button>
                        </center>        
                    </th>  
                </tr>
            </table>
            
        </div>
        </form>
    </div>
</div>


<script>
function showDiv(select){
    if(select.value=='0'){
        document.getElementById('subir').style.display = "none";
        document.getElementById('button').style.display = "none";
    }else if(select.value=='Carta de aceptacion'){
        document.getElementById('subir').style.display = "inline";
        document.getElementById('button').style.display = "inline";
    }else if(select.value=='Evaluacion SAC-F-05'){
        document.getElementById('subir').style.display = "inline";
        document.getElementById('button').style.display = "inline";
    }
}
</script>