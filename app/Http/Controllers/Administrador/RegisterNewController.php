<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterNewController extends Controller
{
    
    public function __construct(){
      //
    }
    public function index(){
        $roles=DB::table('roles')->where('perfil','!=','tutor')->get();
        $carreras=DB::table('carrera')->get();
        return view('Administrador.NewRegistro',['roles'=>$roles,'carreras'=>$carreras]);
    }
    protected function create(HttpRequest $request)
    {
        
        if($request->rol==''){
            $rules = [
                'nombre' => 'required|max:50',
                'apellido_paterno'=>'required|max:50',
                'apellido_materno'=>'required|max:50',
                'rol'=>'required'
            ];
        }else{
            if($request->rol=='Alumno'){
                $rules = [
                    'nombre' => 'required|max:50',
                    'apellido_paterno'=>'required|max:50',
                    'apellido_materno'=>'required|max:50',
                    'matricula' => 'required|numeric',
                    'email'=>'unique:users'
                ];

            }else{
                $rules = [
                    'nombre' => 'required|max:50',
                    'apellido_paterno'=>'required|max:50',
                    'apellido_materno'=>'required|max:50',
                    'clave'=>'required|numeric|unique:empleado',
                    'email'=>'unique:users'
                ];
            }
        }
        $messages = [
            'nombre.required' => 'Agrega el nombre porfavor',
            'nombre.max' => 'Son demasiados caracteres en el campo nombre, borrale algunos porfavor',
            'apellido_paterno.required' => 'Agrega el apellido paterno porfavor',
            'apellido_paterno.max' => 'Son demasiados caracteres en el campo apellido paterno, borrale algunos porfavor',
            'apellido_materno.required' => 'Agrega el apellido materno porfavor',
            'apellido_materno.max' => 'Son demasiados caracteres en el campo apellido materno, borrale algunos porfavor',
            'matricula.required'=>'El alumno debe tener matricula asignada',
            'matricula.max'=>'La matricula solo debe contener 10 digitos',
            'matricula.numeric'=>'La matricula solo deben ser numeros',
            'clave.required'=>'El usuario debe tener una clave',
            'clave.max'=>'La clave debe constar de SOLO 3 digitos',
            'clave.numeric'=>'La clave debe ser numerica',
            'rol.required'=>'Es necesario asignarle un rol al usuario',
            'email.unique'=>'Este correo YA existe',
            'clave.unique'=>'Esta clave de empleado YA existe'
        ];
        $this->validate($request, $rules,$messages);

        
            User::create([
                'name' =>$request->nombre.$request->apeliido_paterno,
                'email' => $request->email,
                'password' => Hash::make($request->matricula.$request->clave.'UTH'),
            ]);

            
            $ultimoUser=DB::table('users')->select(DB::raw('MAX(id) as id'))->first();
            
            DB::table('persona')->insert([
                'nombre'=>$request->nombre,
                'genero'=>$request->sexo,
                'apellido_paterno'=>$request->apellido_paterno,
                'apellido_materno'=>$request->apellido_materno,
                'fecha_nacimiento'=>$request->fecha_nacimiento,
                'id_user'=>$ultimoUser->id
            ]);
            $ultimaPersona=DB::table('persona')->select(DB::raw('MAX(id) as id'))->first();
            
            $rol=$request->rol;
            $estatus=DB::table('estatus')->where('nombre','=','regular')->first();
            $estatusEmpleado=DB::table('estatus')->where('nombre','=','Activo')->first();
            
            if($rol=='Alumno'){
                DB::table('alumno')->insert([
                    'matricula'=>$request->matricula,
                    'correo_institucional'=>$request->email,
                    'id_persona'=>$ultimaPersona->id,
                    'estatus'=>$estatus->id
                ]);
                $ultimoMiembro=DB::table('alumno')->select(DB::raw('MAX(id) as id'))->first();
                DB::table('Carrera_alumno')->insert([
                    'id_alumno'=>$ultimoMiembro->id,
                    'id_carrera'=>$request->carrera
                ]);
            } 
            else{
                DB::table('empleado')->insert([
                    'clave'=>$request->clave,
                    'email'=>$request->email,
                    'nombre_puesto'=>$request->rol,
                    'id_persona'=>$ultimaPersona->id,
                    'estatus'=>$estatusEmpleado->id
                ]);
                $ultimoMiembro=DB::table('empleado')->select(DB::raw('MAX(id) as id'))->first();
                DB::table('Carrera_empleado')->insert([
                    'id_empleado'=>$ultimoMiembro->id,
                    'id_carrera'=>$request->carrera
                ]);
            }
    }
}
