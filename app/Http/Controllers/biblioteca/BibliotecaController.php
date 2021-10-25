<?php

namespace App\Http\Controllers\Biblioteca;

use Illuminate\Support\Facades\DB;
use App\Models\Biblioteca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BibliotecaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $persona = DB::table('_vista_biblioteca')
        
        ->get();
       
        return view('Biblioteca.index',[ 'persona'=> $persona]);
        return view('Biblioteca.index');
}
public function GetMemorias(Request $request){
    if(isset($request->id_persona)){
        $Memorias=DB::table('_vista_biblioteca')->where('id_persona',$request->id_persona)->get();
    }else if(isset($request->matricula)){
        $Memorias=DB::table('_vista_biblioteca')->where('matricula',$request->matricula)->get();
    }else{
        $Memorias=DB::table('_vista_biblioteca')->get();
    }
    
    
    return response(json_encode($Memorias));
}
public function GetMemoria(Request $request){
    $Memoria=DB::table('_vista_biblioteca')->where('id_alumno',$request->id_alumno)->get();

    return response(json_encode($Memoria));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'texto' =>'required|max:250'
        ],[
            'texto.required' => 'necesita escribir un comentario',
            'texto.max' => 'por favor recorte su mensaje'
        ]);

        

        $comentarioBiblioteca=request()->except('_token');
        DB::table('comentario')->insert([
            'texto'=> $request->texto,
            'remitente'=>'Biblioteca',
            'id_memoria'=>'1'
        ]);
            return back()->with('texto','se a hecho el comentario');  

        $regresar=request()->except('_token');
        DB::table('revision')->insert([
            'quien_reviso'=> $request->quien_reviso,
            'id_memoriaestadia'=>$request->id_memoriaestadia
        ]);
            return back()->with('texto','se a hecho regresado la meoria');  

    }
    public function regresarMemoria(Request $request)
    {
        request()->validate([
            'texto' =>'required|max:250'
        ],[
            'texto.required' => 'necesita escribir un comentario',
            'texto.max' => 'por favor recorte su mensaje'
        ]);

        

        $comentarioBiblioteca=request()->except('_token');
        DB::table('comentario')->insert([
            'texto'=> $request->texto,
            'remitente'=>'Biblioteca',
            'id_memoria'=>'1'
        ]);
            return back()->with('texto','se a hecho el comentario');  

        $regresar=request()->except('_token');
        DB::table('revision')->insert([
            'quien_reviso'=> $request->quien_reviso,
            'id_memoriaestadia'=>$request->id_memoriaestadia
        ]);
            return back()->with('texto','se a hecho regresado la meoria');  

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      $memoria = DB::table('memoriaestadia')->where('id_alumno',$id)->get();

      return view('Biblioteca.tabla',['memoria'=>$memoria]);

    }
    public function memoria($id){

        $Meestadia = DB::table('memoriaestadia')->where('id_alumno',$id)->value('file');
        $decode =  base64_decode($Meestadia);
        $name='Memoria.pdf';
        file_put_contents($name,$decode);
            header('Content-Description: File Trasfer');
            header('Conetent-Type:application/pdf');
            header('Content-Disposition:inline; filename ="'.basname($name) .'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length:'.filesize($name));
            readfile($name);

            return view('Biblioteca.tabla',['name',$name]);

    }
    public function regresar(Request $request)
    {
        $regresar=request()->except('_token');
        DB::table('revision')->insert(
            [
                'quien_reviso'=>$request->quien_reviso,
                'id_memoriaestadia'=>'5'
            ]);
        return redirect('biblioteca.tabla');
    }


}
