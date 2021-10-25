<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class DirectorController extends Controller
{
    public function index(){
        return view('Director.home');
    }
    public function GetMemorias(Request $request){
        if(isset($request->nivel)){
            $Memorias=DB::table('_alumno_memoriaEstadia_revisionn')->where('nivel_carrera',$request->nivel)->get();
        }else if(isset($request->id_grupo)){
            $Memorias=DB::table('_alumno_memoriaEstadia_revisionn')->where('id_grupo',$request->id_grupo)->get();
        }
        else if(isset($request->id_grupo)&isset($request->nivel)){
            $Memorias=DB::table('_alumno_memoriaEstadia_revisionn')->where('nivel_carrera',$request->nivel)->where('id_grupo',$request->id_grupo)->get();
        }
        else{
            $Memorias=DB::table('_alumno_memoriaEstadia_revisionn')->get();
        }
        
        
        return response(json_encode($Memorias));
    }
    public function GetMemoria(Request $request){
        $Memoria=DB::table('_alumno_memoriaEstadia_revisionn')->where('id_alumno',$request->id_alumno)->get();

        return response(json_encode($Memoria));
    }

}
