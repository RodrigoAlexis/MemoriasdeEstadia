<?php
 
namespace App\Http\Controllers;
use vendor\guzzlehttp\guzzle\src\Client;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{

    public function __construct()
    {
    $this->middleware('auth');
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();   
    }
 
    public function index()
    {
        // Obtenemos todos los registros de la tabla files
        // y retornamos la vista files con los datos.
        $files = File::orderBy('created_at', 'desc')->get();
        
        return view('files', compact('files'));
    }
    public function vista(){
        $tableDrBx=DB::table('files')->get();
        return view('File/leerfile',['tableDrBx'=>$tableDrBx]);
    }
    public function store(Request $request)
    {
        Storage::disk('dropbox')->putFileAs('/', 
            $request->file('file'), 
            $request->file('file')->getClientOriginalName()
        );

        $response = $this->dropbox->createSharedLinkWithSettings(
            $request->file('file')->getClientOriginalName(), 
            ["requested_visibility" => "public"]
        );
 
        File::create([
            'name' => $response['name'],
            'extension' => $request->file('file')->getClientOriginalExtension(),
            'size' => $response['size'],
            'public_url' => $response['url']
        ]);
    
        return redirect('/fileDrBx');
    }
 
    public function download(File $file)
    {
        return Storage::disk('dropbox')->download($file->name);
    }
    public function destroy(File $file,$id_archivo)
    {
        $this->dropbox->delete($file->name);
        $file->delete();
        
        DB::table('archivo')
        ->where('id',$id_archivo)->delete();
 
        return back();
    }
    public function ArchivoPoliza($poliza){
        $files=DB::table('_archivo_cl_po_pa')->where('id_poliza',$poliza)->get();
        
        return $files;
    }
}