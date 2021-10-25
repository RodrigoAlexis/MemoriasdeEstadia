<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdministradorController extends Controller
{
    public function index(){
        $alumnos=DB::table('alumno')->get();
        $personal=DB::table('empleado')->get();

        $Alumnos =DB::table('_todo_alumno_grupo')->pluck('id_alumno','id_grupo')->where('id_grupo','4');

        return view('Administrador.newGrupo',['alumnos'=>$alumnos,'personal'=>$personal]);
    }
    public function NewGrupo(Request $request){
        $rules = [
            'tutorTutor'=>'required',
            'Alumnos'=>'required',

        ];
        $messages = [
            'tutorTutor.required' => 'Agregue un tutor porfavor',
            'Alumnos.required' => 'el grupo debe tener almenos un alumno',
        ];
        
       $this->validate($request, $rules,$messages);
       
        echo($request->tutorTutor.'</br>');
        foreach ($request->Alumnos as $alumno) {
            echo($alumno.'</br>');
        }
    }
    public function home(){
        return view('Administrador.home');
    }
    public function GetProfesores(Request $request){
        if($request->tabla=='sin_grupo'){
            $profesores=DB::table('_todo_empleado_grupo')->where('id_grupo','N/A')->where('puesto',$request->perfil)->get();
        }
        else{
            $profesores=DB::table('_todo_empleado_grupo')->where('id_grupo','!=','N/A')->get();
        }
        

        return response(json_encode($profesores));
    }
    public function GetGrupos(Request $request){
        $grupos=DB::table('_grupo')->where('id_grupo','!=','N/A')->get();
       
        return response(json_encode($grupos));//devuelve response codificado en json
    }
    public function GetAlumnos(Request $request){
        $alumnos=DB::table('_todo_alumno_grupo')->where('id_grupo',NULL)->get();
        
        return response(json_encode($alumnos));
    }
    public function GetTutorados(Request $request){
        $tutorados=DB::table('_todo_alumno_grupo')->where('id_grupo',$request->id_grupo)->get();
        
        return response(json_encode($tutorados));
    }
    public function GetPerfiles(Request $request){
        $roles=DB::table('roles')->where('perfil','!=','Alumno')->where('perfil','!=','tutor')->where('perfil','!=','biblioteca')->get();
        
        return response(json_encode($roles));
    }
    public function GetCuatrimestre(Request $request){
        $cuatri=DB::table('_cuatrimestre_carrera')->where('grado_cuatrimestre','11')->orWhere('grado_cuatrimestre','6')->where('id_carrera',16)->get();
        
        return response(json_encode($cuatri));
    }
    public function InsertGrupo(Request $request){
        DB::table('grupo')->insert([
            'nombre'=>$request->grupo,
            'tutor'=>$request->id_tutor,
            'id_cuatrimestreCarrera'=>$request->cuatrimestre,
            'id_especialidad'=>$request->id_especialidad
        ]);
    }
    public function DropGrupo(Request $request){
        DB::table('grupo')->delete($request->id);
    }
    public function InsertAlumnos(Request $request){
        
        DB::table('grupo_alumno')->insert([
            'id_grupo'=>$request->id_grupo,
            'id_alumno'=>$request->id_alumno
        ]);
        echo('success');
    }
    public function DeleteAlumnos(Request $request){
        $delete=DB::table('grupo_alumno')->select('id')->where('id_alumno',$request->id)->first();
   
        DB::table('grupo_alumno')->delete($delete->id);
    }

}
 