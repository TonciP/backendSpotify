<?php

namespace App\Http\Controllers;

use App\Models\biblioteca;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BibliotecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $listabiblioteca = biblioteca::all();
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
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            "titulo_cancion" => ['required', 'string'],
            "artista_id" => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $artista = new biblioteca($request->json()->all());
        $artista->save();
        return response()->json($request->all());
    }

    /**
     * subir cancion
     * */
    public function subirCancion(Request $request, $id){
        $objbiblioteca = biblioteca::find($id);
        if ($objbiblioteca == null){
            return response()->json(array(
                "menssage" => "Item not fount"
            ), Response::HTTP_NOT_FOUND);
        }
        if ($request->hasFile('cancion')){
            $file = $request->file('cancion');
            $mp3Name = $id . ".mp3";
            $file->move(public_path("music"), $mp3Name);

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
        $biblioteca = biblioteca::find($id);
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
    public function edit(biblioteca $biblioteca)
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
        $persona = biblioteca::find($id);
        if ($persona == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if ($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(), [
                "titulo_cancion" => ['required', 'string'],
                "artista_id" => ['required', 'string'],
                //"pathfile" => ['required', 'file']
            ]);
        } else {
            $validator = Validator::make($request->json()->all(), [
                "titulo_cancion" => ['required', 'string'],
                "artista_id" => ['required', 'string'],
                //"pathfile" => ['required', 'file']
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
        $persona = biblioteca::find($id);
        if ($persona == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $persona->delete();
        return response()->json(['success' => true]);
    }


}
