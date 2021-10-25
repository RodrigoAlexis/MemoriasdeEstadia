@extends('layouts.app')

@section('content')
     

<div class="container">
        <h2 class="backTittle mb-0 col-12 col-sm-12 col-md-12 col-lg-12">Listado de entrega de memorias de estadia </h2>
    <nav class="navbar navbar-dark  backTittle">
        <!--Select GetGrupos-->
        <select class="custom-select col-12 col-sm-12 col-md-5 col-lg-5 " id="Grupo">
            <option value="">Todos los grupos</option>
        </select>
        
        <input id="search" class="form-control col-12 col-sm-12 col-md-5 col-lg-5" type="search" placeholder="Buscar" aria-label="Search">
    </nav>
    <!--tabla header-->
    <table class="table table-hover col-12 col-sm-12 col-md-12 col-lg-12 ">
        <thead class="thead-light" >
            <tr>
                <th >Alumno</th>
                <th >Matricula </th>
                <th >Grupo</th>
                <th >Nivel carrera</th>
                <th >Tutor</th>
            </tr>
        </thead>
        <!-- cuerpo de la tabla-->
            <tbody id="tbody">
                
            </tbody>
    </table>
</div>@csrf


@include('Director.modal')

    <script>
        $(function(){
            Grupos();
            Tutorados();
            
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tbody *").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $('#Grupo').on('change',function(){
               
                $('#tbody').children().remove();
                Tutorados(this.value);
            });
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
                            <td>${a.nombre_grupo}</td>
                            <td>${a.nivel_carrera}</td>
                            <td>${a.nombre_tutor}</td>
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
                    <a class="btn btn-secondary btn-block">${memoria.alumno}</a>
                    <a class="btn btn-danger btn-block">${memoria.matricula}</a>
                    <a class="btn btn-warning btn-block">${memoria.carrera_grupo}</a>
                    <a class="btn btn-primary btn-block">${memoria.nombre}</a>
                    <a class="btn btn-success btn-block">${memoria.file}</a>
                    <a class="btn btn-dark btn-block">${memoria.id_memoriaestadia}</a>
                    `
                });
                $('#info').children().remove();
                $('#info').append(template);
            });
        });

            
        });
    </script>
    
@endsection