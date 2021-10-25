@extends('layouts.app')

@section('content')
<form  method="post" action="{{ url('/newUser') }}" >
    @csrf

    <div class="container">
        @isset($aviso)
            <a class="alert alert-danger">{{ $aviso }}</a><br>
        @endisset
        <h3>Nuevo usuario</h3>
        <div class="row">
            <!--Nombre-->
            <div class="input-group mb-3 col-lg-4 col-md-4 col-sm-12">
                <div class="input-group-prepend ">
                    <label class="input-group-text"  for="nombre">{{'Nombre(s)'}}</label>
                </div>
                <input type="text" name="nombre" id="nombre" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" value="{{ old('nombre')}}">
            </div>

            <!--Apellido paterno-->
            <div class="input-group mb-3 col-lg-4 col-md-4 col-sm-12">
                <div class="input-group-prepend">
                    <label class="input-group-text"  for="ap_paterno">{{'Apellido Paterno'}}</label>
                </div>
                <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control {{$errors->has('apellido_paterno')?'is-invalid':''}}" value="{{ old('apellido_paterno')}}"> 
            </div>
            
            <!--Apellido Materno-->
            <div class="input-group mb-3 col-lg-4 col-md-4 col-sm-12">
                <div class="input-group-prepend">
                    <label class="input-group-text"  for="apellido_materno">{{'Apellido Materno'}}</label>
                </div>
                <input type="text" name="apellido_materno" id="apellido_materno" class="form-control {{$errors->has('apellido_materno')?'is-invalid':''}}" value="{{ old('apellido_materno')}}">
            </div>
        </div>

            @error('nombre')
                <div class="p-2 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="p-2 close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
            @error('apellido_paterno')
                <div class="p-2 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="p-2 close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
            @error('apellido_materno')
                <div class="p-2 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="p-2 close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror

        <div class="row">
           
            <!--nacimiento-->
            <div class="input-group mb-3 col-lg-6 col-md-6 col-sm-6" >
                <div class="input-group-prepend">
                    <label class="input-group-text"  for="fecha_nacimiento">{{'Fecha de nacimiento'}}</label>
                </div>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control {{$errors->has('fecha_nacimiento')?'is-invalid':''}}" min="1950" max="2030"  value="{{ old('fecha_nacimiento')}}">
            </div>
        
            <!--Sexo-->
            <div class="input-group mb-3 col col-lg-6 col-md-6 col-sm-6">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="sexo">{{'Sexo'}} </label>
                </div>
                <select type="text" name="sexo" id="sexo" class="custom-select">
                    <option  value="M" >Masculino</option>
                    <option  value="F" >Femenio</option>
                </select>
            </div>
        </div>
        <div class="row">
            <!--Rol-->
            <div class="input-group mb-3 col col-lg-6 col-md-6 col-sm-6">
                <div class="input-group-prepend">
                    <label class="input-group-text" >{{'Asignación'}}</label>
                </div>
                <select  name="rol" id="rol" class="custom-select">
                    <option></option>
                    @isset($roles)
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->perfil }}"{{ old('rol') == $rol->perfil ? 'selected' : '' }}>{{ $rol->nombre }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <!--Carrera-->
            <div class="input-group mb-3 col col-lg-6 col-md-6 col-sm-6">
                <div class="input-group-prepend">
                    <label class="input-group-text" >{{'Carrera'}}</label>
                </div>
                <select name="carrera" id="carrera" class="custom-select">
                    @isset($carreras)
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}"{{ old('rol') == $carrera->id ? 'selected' : '' }}>{{ $carrera->nivel.'-'.$carrera->nombre }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="row" id="infoAlumno">
                <!--matricula-->
                <div  id="matricula" class="input-group mb-3 col-lg-6 col-md-6 col-sm-6" style="display: none">
                    <div class="input-group-prepend">
                        <label class="input-group-text"  for="nombre">{{'Matricula'}}</label>
                    </div>
                    <input maxlength="10" minlength="10" type="text" name="matricula" id="matriculaValue" class="form-control {{$errors->has('matricula')?'is-invalid':''}}" value="{{ old('matricula')}}">
                </div> 
            <!--clave-->
            <div id="clave" class="input-group mb-3 col-lg-6 col-md-6 col-sm-6" style="display: none">
                <div class="input-group-prepend">
                    <label class="input-group-text"  for="nombre">{{'Clave'}}</label>
                </div>
                <input maxlength="3" minlength="3" type="text" name="clave" id="claveValue" class="form-control {{$errors->has('clave')?'is-invalid':''}}" value="{{ old('clave')}}">
            </div> 
            
            <div class="input-group mb-3 col-lg-6 col-md-6 col-sm-6" >
                 <div class="input-group-prepend">
                <label class="input-group-text" >{{'Correo'}}</label>
            </div>
               <input type="mail" name="email" id="email" class="form-control" >
            </div>
        </div>
        @error('email')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @enderror
            @error('rol')
                <div class="p-2 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="p-2 close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
            @error('matricula')
                <div class="p-2 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="p-2 close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
            @error('clave')
                <div class="p-2 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="p-2 close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @enderror
        <div class="alert alert-info" >
            La contraseña del usuario será:<strong id="password"></strong>
        </div>
        
        
        <input type="submit" value="Crear usuario" class="btn btn-success btn-block">
    
    </div>
    
</form>

    <script>
        $( document ).ready(function() {
            if($('#rol').val()=='Alumno'){
                $('#matricula').show();
            }else if($('#rol').val()==''){
                $('#clave').hide();
            }else{
                $('#clave').show();
                $('#email').val( $('#nombre').val()+'.'+$('#apellido_paterno').val()+'@uth.edu.mx');
           
            }
            $('#rol').on('change', function() {
                $('#email').val('');
                $('#matriculaValue').val('');
                $('#claveValue').val('');
                if(this.value!='Alumno'){
                    $('#clave').show();
                    $('#matricula').hide();
                    $('#email').val( $('#nombre').val()+'.'+$('#apellido_paterno').val()+'@uth.edu.mx');
                }else{
                    $('#clave').hide();
                    $('#matricula').show();
                }
            });
            $('#matriculaValue').on('change',function(){
                $('#email').val( $('#matriculaValue').val()+'@uth.edu.mx');
                $('#password').text( $('#matriculaValue').val()+'UTH');
            });
            $('#claveValue').on('change',function(){
                $('#password').text( $('#claveValue').val()+'UTH');
            });
            });
    </script>

@endsection