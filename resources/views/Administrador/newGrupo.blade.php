
@error('tutorTutor')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
@error('Alumnos')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
@enderror

  @csrf
        <div class="row back">
           
          <div class=" col-12 col-sm-4 col-md-4 col-lg-4  ">
            <center><h2 class="backTittle">TUTORES</h2></center>
              <div id="tutores" class="comentarioss scrollbar-ripe-malinka">
              </div>
          </div>

          <div class=" col-12 col-sm-4 col-md-4 col-lg-4  ">
            <center><h2 class="backTittle">GRUPO</h2></center>
            <div id="grupoTutor" >
            </div>
            <div id="grupoAlumno" class="comentarioss scrollbar-ripe-malinka">
            </div>
            
          </div>
          
          <div class=" col-12 col-sm-4 col-md-4 col-lg-4" >
            <center><h2 class="backTittle">ALUMNOS </h2></center>
                <div id="alumnos" class="card-body comentarioss scrollbar-ripe-malinka">
                 
                </div>
                </div>
        </div>

      <script>
        $( document ).ready(function() {
          addAEvent();addAEventT();
          GetProfesores();
          GetAlumnos();

          $(document).on('click','.tutor',function(){
            $('#grupoTutor').children().remove();
            $('#grupoAlumno').children().remove();
            $('.tutor').show();
            $('#tutorTutor').val(this.id);
            grupo=$(this).attr('grupo');
            $('#grupoTutor').append('<a id="'+this.id+'" grupo="'+grupo+'"class="grupotu btn btn-dark btn-block m-1 " >'+$(this).attr('nombre')+'</a>');
              addAEventT();
              $(this).hide();
            GetTutorados($(this).attr('grupo'));
            
          });

          $(document).on('click','.grupoal',function(){
            
            $.ajax({
                url:'/DeleteAlumnos',
                method:'POST',
                data:{
                  _token:$('input[name="_token"]').val(),
                  id:$(this).attr('id')
                }
              }).done(function(response){
                console.log(response);
                $('#alumnos').children().remove();
                $('#grupoAlumno').children().remove();

                GetAlumnos();
                GetTutorados($('#grupoTutor').children().attr('grupo'));
              });
          });

          $(document).on('click','.alumno',function(){
            $('#grupoAlumno').append('<a id="'+this.id+'" class="grupoal btn btn-outline-danger btn-block m-1 p-1 ">'+$(this).attr('nombre')+'</a>');
              addAEvent();
              $(this).hide();
              
              $.ajax({
                url:'/InsertAlumnos',
                method:'POST',
                data:{
                  _token:$('input[name="_token"]').val(),
                  id_grupo:$('#grupoTutor').children().attr('grupo'),
                  id_alumno:$(this).attr('id')
                }
              }).done(function(response){
                $('#grupoAlumno').children().remove();
                GetTutorados($('#grupoTutor').children().attr('grupo'));
              });
             
          });

          $(document).on('click','.grupotu',function(){
            $('#grupoTutor').children().remove();
            $('#grupoAlumno').children().remove();
          });
          function GetTutorados(id_grupo){
           $.ajax({
             url:'/GetTutorados',
             method:'POST',
             data:{
               id_grupo:id_grupo,
               _token:$('input[name="_token"]').val()
             }
           }).done(function(response){
            console.log(response);
            let objs = JSON.parse(response);
            let template="";
            objs.forEach(tutorados => {
              template+=`
              <a id="${tutorados.id_persona}" grupo="${tutorados.id_grupo}" nombre="${tutorados.nombre}"
                class="btn  btn-success btn-block grupoal" >${tutorados.nombre}</a>
              `
            });
            $('#grupoAlumno').append(template);
           });
          }

          function GetProfesores(){
            $.ajax({
              url:'/GetProfesores',
              method:'POST',
              data:{
              id:1,
              _token:$('input[name="_token"]').val()
              }
              }).done(function(response){
                
                let objs = JSON.parse(response);
                let template='';
                objs.forEach(profes => {
                template+=`
                <a id="${profes.id_persona}" grupo="${profes.id_grupo}" nombre="${profes.nombre}"
                class="btn  btn-outline-dark btn-block tutor" >${profes.nombre}</a> `
              });
              $('#tutores').append(template);
            });
          }
          function GetAlumnos(){
            $.ajax({
              url:'/GetAlumnos',
              method:'POST',
              data:{_token:$('input[name="_token"]').val()}
            }).done(function(response){
              let objs = JSON.parse(response);
              let template="";
              objs.forEach(alumno => {
                template+=`
                <a id="${alumno.id_alumno}"  nombre="${alumno.nombre}"
                class="btn  btn-outline-secondary btn-block alumno" >${alumno.nombre}</a> `
              });
              $('#alumnos').append(template);
            })
            
          }
          function addAEvent(){
              $('.grupoal').unbind();
                $('.grupoal').on('click',function(){
                  $(this).remove();
                  $('#txt'+this.id).remove();
                  $('#'+this.id).show();
                });
          }
          function addAEventT(){
              $('.grupotu').unbind();
                $('.grupotu').on('click',function(){
                  $('#tutorTutor').val('');
                  $(this).remove();
                  $('#'+this.id).show();
                });
          }


        });
      </script>
