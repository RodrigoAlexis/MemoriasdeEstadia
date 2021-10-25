<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=auth()->user()->id;
        //$tutorados=DB::table('_todo_alumno_grupo')->where('id_user',$user)->get();
        $docprofesor = DB::table('_alumno_empleado_grupo_documentoprofesor')->where('id_user_alumno',$user)->get();
        $estatus = DB::table('_alumno_memoria_estatus')->where('id_persona',$user)->get();

        return view('Estudiante.index',['docprofesor'=>$docprofesor,'estatus'=>$estatus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $archivo=request();
        $user=auth()->user()->id;
        $id = DB::table('_alumno_persona_user')->where('id_user',$user)->value('id_alumno');

        if($archivo->txtFile){
            if($archivo->hasFile('txtFile')){
                if($archivo->file('txtFile')->isValid()){

                    DB::table('file_local')->insert([
                        'file'=>base64_encode(file_get_contents($archivo['txtFile']->path())),
                        'nombre'=>$archivo->select,
                        'id_alumno'=>$id
                        //'hash' => md5($datos['txtFile'])
                    ]);
                }
            }
        }else if($archivo->revision){
            if($archivo->hasFile('revision')){
                if($archivo->file('revision')->isValid()){
                    DB::table('memoriaestadia')->insert([
                        'file'=>base64_encode(file_get_contents($archivo['revision']->path())),
                        'nombre'=>$archivo->nombreM,
                        //'hash' => md5($datos['txtFile'])
                        'id_alumno'=>$id,
                        'estatus'=>'5'
                    ]);
                }
            }
        }
   
        return view('Estudiante.index');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=auth()->user()->id;
        $profesor = DB::table('_alumno_empleado_grupo_documentoprofesor')->where('id_user_alumno',$user)->value('file');

        $decode=base64_decode($profesor);
        $file='documento.pdf';
        file_put_contents($file,$decode);
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires:0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' .filesize($file));
            readfile($file);
        return view('Estudiante.index',['profesor'=>$profesor]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
