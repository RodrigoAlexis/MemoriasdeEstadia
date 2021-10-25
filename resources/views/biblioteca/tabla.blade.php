@extends('layouts.app')

@section('content')
    
<div class="container">

 <h3 >biblioteca</h3><br>     
        
        </nav>
    <!--tabla header-->
    <table class="table table-hover col-12 col-sm-12 col-md-12 col-lg-12 ">
        <thead class="thead-light" >
            <tr>
              
            <th>Nombre de persona</th>
            <th>matricula</th>
            <th>Nombre de la memoria</th>
            <th>fecha</th>
            <th>estatus</th>

            
            </tr>
        </thead>
        <!-- cuerpo de la tabla-->
            <tbody id="tbody">
                
            </tbody>
    </table>
    <div id="footer">
             @if (session('texto'))
                 <!!div class"alert alert-success"!!>
                  <p> {{session('texto')}}</p>  
                  </div>
             @endif
            
        </div>
</div>@csrf


@include('biblioteca.modal')

    <script>
        $(function(){
            Grupos();
            Tutorados();
            
            function Grupos(){ 
                $.ajax({
                    url:'/GetGrupos',//url hacia donde se hace la peticion
                    method:'POST',
                    data:{
                        _token:$('input[name="_token"]').val()//@csrf token necesarion en laravel
                    }
                }).done(function(response){//cando confirma que esta hecho la peticion
                    //console.log(response);//escribir en consola el resultado
                    let temp="";//declaracion del html que se va agregar
                    JSON.parse(response).forEach(g => {//froeach del arreglo
                        temp+=`<option value="${g.id_grupo}">Grupo: ${g.nombre_grupo}</option>`
                        });
                    $('#Grupo').append(temp);//al select grupo el html
                });
            }
            function Tutorados(id_grupo,nivel){ 
                $.ajax({
                    url:'/GetMemorias',
                    method:'POST',
                    data:{
                        id_grupo:id_grupo,//name del imput : el valor del campo 
                        nivel:nivel,
                        _token:$('input[name="_token"]').val()
                    }
                }).done(function(response){
                    let temp="";
                    JSON.parse(response).forEach(a => {
                        temp+=`
                        <tr id="${a.id_alumno}" class="memoria" data-toggle="modal" data-target="#exampleModal"data-toggle="tooltip" data-placement="top" title="Click me">
                            <td>${a.alumno}</td>
                            <td>${a.matricula}</td>
                            <td>${a.nombre}</td>
                            <td>${a.fecha}</td>
                            <td>${a.estatus}</td>


                        </tr>
                        `
                        
                    });
                    $('#tbody').append(temp);
                });
            }

        $(document).on('click','.memoria',function(){
            $.ajax({
                url:'/GetMemoria',
                method:'POST',
                data:{
                    id_alumno:this.id,
                    _token:$('input[name="_token"]').val()
                }
            }).done(function(response){
                let template="";
                let objs = JSON.parse(response);
                objs.forEach(memoria => {
                    template+=`
                    <form method="post" action="">
                    {{csrf_field()}}
                    <br>
                    <label for="nombreDePersona">id: ${memoria.id_alumno}  </label><br>
                        <label for="nombreDePersona">Nombre de la persona: ${memoria.alumno}</label><br>
                        <label for="nombreDePersona">matricula: ${memoria.matricula}</label><br>
                        <label for="nombreDePersona">Nombre de la memoria: ${memoria.nombre}</label><br>
                         <button type="submit" class="btn btn-warning">Regresar memoria
                        </button>
                       </form>
                    `
                });
                $('#info').children().remove();
                $('#info').append(template);
            });
        });

            
        });
    </script>
    
@endsection