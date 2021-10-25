<?php

namespace App\Http\Controllers\Tutores;

use App\Models\Tutores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tutorados=DB::table('_todo_alumno_grupo')->where()
        $user=auth()->user()->id;
       $tutorados=DB::table('_todo_alumno_grupo')->where('id_user',$user)->get();
       return view('Tutores.index',['tutorados'=>$tutorados]);
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

    public function regresar($id)
    {
        $memoria = DB::table('memoriaestadia')->where('id_alumno',$id)->get();
        $consulta=DB::table('_alumno_memoriestadia_revision')->where('id_alumno',$id)->value('id_memoria_estadia');
        $name= auth()->user()->name;
        DB::table('revision')->insert(
            [
                'quien_reviso'=>$name,
                'id_memoriaestadia'=>$consulta
            ]);
        return view('Tutores.view',['memoria'=>$memoria]);
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request=request();
        $id= auth()->user()->id;
        if($request->hasFile('txtFile')){
            if($request->file('txtFile')->isValid()){

                DB::table('documento_profesor')->insert([
                        'file'=>base64_encode(file_get_contents($request['txtFile']->path())),
                        'nombre'=>$request->select,
                        'id_profesor'=>$id
                ]);
            }
        }
      
       return redirect('/Tutores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    /*Abrir y descargar Memoria*/
    public function show($id)
    {
        $memoria = DB::table('memoriaestadia')->where('id_alumno',$id)->get();
        
        return view('Tutores.view',['memoria'=>$memoria]);
    }
    
    public function memoria($id)
    {
        $Mestadia= DB::table('memoriaestadia')->where('id_alumno',$id)->value('file');
        $decode=base64_decode($Mestadia);
        $name="Memoria.pdf";
        file_put_contents($name,$Mestadia);
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="'.basename($name).'"');
            header('Expires:0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' .filesize($name));
            readfile($name);
            
        return view('Tutores.view',['name',$name]);
    }

    public function download ($id)
    {
        $formato= DB::table('memoriaestadia')->where('id_alumno',$id)->value('file');
        $decode=base64_decode($formato);
        $name="Memoria De Estadia.pdf";
        file_put_contents($name,$formato);
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.basename($name).'"');
            header('Expires:0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' .filesize($name));
            readfile($name);
            
        return view('Tutores.view',['name',$name]);
    }


    /* Documentacion del alumno Formatos*/
    public function documentos($id)
    {
        $docs=DB::table('file_local')->where('id_alumno',$id)->get();
       
        return view('Tutores.Docs',['docs'=>$docs]);

    }
    public function prueba ($id)
    {
        $pdf=DB::table('file_local')->where('id_alumno',$id)->value('file');
        $decode=base64_decode($pdf);
        $file='documento.pdf';
        file_put_contents($file,$pdf);
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires:0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' .filesize($file));
            readfile($file);

            return view('Tutores.Docs',['file'=>$file]);

    }
   


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutores $tutores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    public function update( $id)
    {
        $memoria = DB::table('memoriaestadia')->where('id_alumno',$id)->get();
      
         DB::table('memoriaestadia')
              ->where('id_alumno', $id)
              ->update(['estatus' => '6'
              ]);
              
        return view('Tutores.view',['memoria'=>$memoria]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutores  $tutores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutores $tutores)
    {
        //
    }
}
