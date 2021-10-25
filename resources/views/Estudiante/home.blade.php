<!--Card de Estatus-->
<div class="row">
    <div class=" card col-3 col-lg-3 col-md-12 col-sm-12" style="height: 8rem;">
        <ul class="list-group list-group-flush" style="height: 2rem;">
            <li class="list-group-item">
                <h3>Estatus</h3>
            </li>
        </ul>
        <br>
        @foreach($estatus as $est)
            @if ($est->nombre_estatus == 'En revision TUTOR')
            <div class="alert alert-warning text-center" role="alert">
                {{$est->nombre_estatus}}
            </div>
            @elseif ($est->nombre_estatus == 'En revision DIRECTOR')
            <div class="alert alert-danger text-center" role="alert">
                {{$est->nombre_estatus}}
            </div>
            @elseif ($est->nombre_estatus == 'En revision BIBLIOTECA')
            <div class="alert alert-primary text-center" role="alert">
                {{$est->nombre_estatus}}
            </div>
            @elseif ($est->nombre_estatus == 'Aprobada')
            <div class="alert alert-success text-center" role="alert">
                {{$est->nombre_estatus}}
            </div>
            @endif
        @endforeach
    </div>
    

    <!--Card de Revision-->
    <div class="card  col-6 col-lg-6 col-md-12 col-sm-12" >
        <ul class="list-group list-group-flush" style="height: 3.5rem; ">
            <li class="list-group-item">
                <h3 class="text-center">Revisiones</h3>
            </li>
        </ul>
        
        <form method="post" action="{{ url('/estudiante') }}" enctype="multipart/form-data">
         @csrf
            <div class="card-body">
                <center>
                    <label for="Subir archivo"  style="font-weight: bold;">Título de la Memoria de Estadía</label>
                    <br>
                    <input type="text" class="form-control" name="nombreM" id="inline">
                    <input type="text" class="form-control" name="nombreM" id="disabled" style="display:none" disabled value="">
                    <br>
                    <br>
                    <br>
                    <label for="Subir archivo" style="font-weight: bold;">Subir Archivo</label>
                    <br>
                    <input type="file" class="form-control" name="revision" id="revision">
                    <br>
                    <br>
                    <br>
                    <br>
                </center>
            </div>
        
        <div class="card-footer">
            <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
        </div>
    </div>
    </form>
    
<!--Card de Comentarios-->
    <div class="card float-right col-3 col-lg-3 col-md-12 col-sm-12" >
            
        <ul class="list-group list-group-flush" style="height: 3.5rem;">
            <li class="list-group-item">
                <h3>Comentarios</h3>
            </li>
        </ul>

        <div class="card-body comentarios scrollbar-ripe-malinka">
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi temporibus quibusdam, excepturi exercitationem harum dolor ex molestiae cumque vitae labore quae placeat est ducimus culpa sit? Reprehenderit consequatur asperiores sed.</p>
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi temporibus quibusdam, excepturi exercitationem harum dolor ex molestiae cumque vitae labore quae placeat est ducimus culpa sit? Reprehenderit consequatur asperiores sed.</p>
        </div>

        <div class="card-footer">
            <textarea class="form-control" name="comentarios" id="comentarios" cols="10" rows="5" placeholder="Escribe aqui tus comentarios"></textarea>
            <br>
            <button type="submit" class="btn btn-success">Envíar</button>
        </div>

    </div>  
</div>

<Script>
$(document).ready(function(){
    $('#guardar').click(function(){
        $('#inline').hide();
        $('#disabled').show();
    });
});
</Script>



   
    
