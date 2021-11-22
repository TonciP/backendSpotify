<?php

namespace App\Http\Controllers;

use App\Models\artista;
use App\Models\biblioteca;
use App\Models\genero;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $listabiblioteca = artista::all();
        return response()->json($listabiblioteca);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Storage::put('public/', $request->file());
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // pah file mp3

        $validator = Validator::make($request->json()->all(), [
            'nombre'=>'required|string',
            'genero_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $artista = new artista($request->json()->all());
        $artista->save();
        return response()->json($request->all());
    }
    /**
     * subir Imagen artista
     * */
    public function subirImagenArtista(Request $request, $id){
        $objartista = artista::find($id);
        if ($objartista == null){
            return response()->json(array(
                "menssage" => "Item not fount"
            ), Response::HTTP_NOT_FOUND);
        }
        if ($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $imgName = $id . ".png";
            $file->move(public_path("images/artista"), $imgName);

            //$biblioteca = new biblioteca($request->json()->all());
            //$biblioteca->save();

            return response()->json([
                "res" => "success"
            ]);
        }

        return response()->json([
            "message" => "Image not found"
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
        $biblioteca = artista::find($id);
        if ($biblioteca == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($biblioteca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function edit(artista $biblioteca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
        $persona = artista::find($id);
        if ($persona == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if ($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(), [
                "nombre" => ['required', 'string'],
                "genero_id" => ['required', 'integer']
            ]);
        } else {
            $validator = Validator::make($request->json()->all(), [
                "nombre" => ['required', 'string'],
                "genero_id" => ['required', 'integer']
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $persona->fill($request->json()->all());
        $persona->save();
        return response()->json($persona);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
        $persona = artista::find($id);
        if ($persona == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $persona->delete();
        return response()->json(['success' => true]);
    }
    /**
     * showArtistaGenero
     *
     */

    public function showArtistaGenero($id){
        $persona = artista::with('genero')->where('genero_id',$id)->get();
        if ($persona == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($persona);
    }
    /**
     * mostrar canciones segun artista
     */

    public function showBibliotecaArtista($id){
        $artista = artista::with('genero')->with('canciones')->where('id',$id)->get();
        if ($artista == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($artista);
    }
    /*
     * obtener todos los archivos dentro de un directorio
     * $directories = Storage::directories($directory);
     * */
    public function mostraArchivoPath(Request $request){
        $validator = Validator::make($request->json()->all(), [
            "path" => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $path = $request->path;
        $directories = Storage::files("music/".$path);
        return response()->json([
            $directories
        ]);
    }

}
