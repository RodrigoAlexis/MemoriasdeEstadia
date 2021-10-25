
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header backTittle">
          <h5 class="modal-title" id="exampleModalLabel">Crear Grupo</h5>
          <button  class="btn btn-danger"type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
          </div>
          <div class="row">
            <div id="profesSinGrupo" class="col-12 col-sm-12 col-md-6 col-lg-6"> 
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label id="tipoEmpleado" class="input-group-text" for="inputGroupSelect01">Personal</label>
                </div>
                <select class="custom-select" id="Perfiles" >
                </select>
              </div>

              <div class="input-group mb-3">
                <select class="custom-select" id="Ntutor" required>
              </select>
              </div>
            
            </div>
            <div id="" class="col-12 col-sm-12 col-md-6 col-lg-6">
            <input id="nombre_grupo" type="text" class="form-control mb-3 " placeholder="LETRA del grupo" required>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label id="tipoEmpleado" class="input-group-text" for="inputGroupSelect01">Cuatrimestre</label>
              </div>
              <select class="custom-select" id="Cuatrimestre">
              </select>
            </div>


            </div>
          </div>
          
        </div><div id="InsertSuccess" class="alert alert-success" style="display: none" >
          Se agrego el grupo con exito
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button id="SaveChanges" type="button" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
@csrf
  

  <script>

    $(function(){
      
      $('#grupoP').on('click',function(){
        $('#Perfiles').on('change',function(){
          $('#Ntutor').children().remove();
          Personal(this.value);
        });
        
        function Personal(perfil){
          $.ajax({
                url:'/GetProfesores',
                method:'POST',
                data:{
                    tabla:'sin_grupo',
                    perfil:perfil,
                    _token:$('input[name="_token"]').val(),
                }
            }).done(function(response){
              let profes="";
              JSON.parse(response).forEach(profe => {
                profes+=`
                  <option value="${profe.id}">${profe.nombre}</option>
                `
              });
              $('#Ntutor').append(profes);
            });
        }

        

      });

      $('#SaveChanges').on('click',function(){
        
        $.ajax({
          url:'/InsertGrupo',
          method:'POST',
          data:{
            id_tutor:$('#Ntutor').val(),
            grupo:$('#nombre_grupo').val(),
            cuatrimestre:$('#Cuatrimestre').val(),
            _token:$('input[name="_token"]').val()
          }
        }).done(function(response){
          $("#InsertSuccess").show();
          location.reload()
          
          setTimeout(function () {
            $("#InsertSuccess").hide();
            
          }, 3500);
          
        });
        
      });
    });
   
  </script>