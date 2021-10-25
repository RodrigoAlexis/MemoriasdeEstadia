@csrf


    <br>
<button id="grupoP" class="btn btn-tittle btn-block" data-toggle="modal" data-target="#exampleModal"><h5>AGREGAR GRUPO</h5></button>
<br>
    <div id="Grupos" class="row"></div>
    
@include('Administrador.MakeGrupo.modalNewGrupo')



<script>
    $(function() {
        GetGrupos();
        GetPerfiles();
        Cuatrimestre();

        function GetGrupos(){
            $.ajax({
                url:'/GetGrupos',
                method:'POST',
                data:{
                    id:1,
                    _token:$('input[name="_token"]').val(),
                }
            }).done(function(response){
                let grupos="";
                JSON.parse(response).forEach(grupo => {
                    grupos+=`
                    <div class="card col-12 col-sm-12 col-md-4 col-lg-3 back">
                        <div  class="card-header backTittle">
                            <h5>Grupo: ${grupo.nombre_grupo}</h5>
                        <h6>
                            ${grupo.nombre_tutor}
                        </h6>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">${grupo.nivel_carrera+'.   '+grupo.carrera_grupo}</h5>
                            
                            <a id="${grupo.id_grupo}" class="btn btn-outline-danger dropClass">Eliminar grupo</a>
                        </div>
                    </div>
                    `
                });
                $('#Grupos').append(grupos);
            });

        }
        function GetPerfiles(){
          $.ajax({
            url:'/GetPerfiles',
            method:'POST',
            data:{
              _token:$('input[name="_token"]').val()
            }
          }).done(function(response){
             let template= "";
             JSON.parse(response).forEach(rol => {
               template+=`
               <option value="${rol.nombre}">${rol.nombre}</option>
               `
             });
             $('#Perfiles').append(template);
          });
        }
        function Cuatrimestre(){
          $.ajax({
                url:'/GetCuatrimestre',
                method:'POST',
                data:{
                    _token:$('input[name="_token"]').val(),
                }
            }).done(function(response){
              let cuatriT="";
              JSON.parse(response).forEach(cuatri => {
                cuatriT+=`
                  <option value="${cuatri.id_cuatrimestre_carrera}">${cuatri.nivel_carrera}--${cuatri.siglas_carrera}--${cuatri.grado_cuatrimestre}°  </option>
                `
              });
              $('#Cuatrimestre').append(cuatriT);
            });
        }

        $(document).on('click','.dropClass',function(){
            let myId = this.id;
            $.ajax({
                url:'/DropGrupo',
                method:'POST',
                data:{id:myId,
                _token:$('input[name="_token"]').val(),}
            }).done(function(response){
                $('#Grupos').children().remove();
                GetGrupos();
            });
            
        });
        
    });
</script>