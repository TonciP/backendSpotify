<?php

namespace App\Http\Controllers;

use App\Models\genero;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $listabiblioteca = genero::all();
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
        $validator = Validator::make($request->json()->all(), [
            'nombre'=>'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $artista = new genero($request->json()->all());
        $artista->save();
        return response()->json($request->all());
    }
    /**
     * subir Imagen artista
     * */
    public function subirImagenGenero(Request $request, $id){
        $objartista = genero::find($id);
        if ($objartista == null){
            return response()->json(array(
                "menssage" => "Item not fount"
            ), Response::HTTP_NOT_FOUND);
        }
        if ($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $imgName = $id . ".png";
            $file->move(public_path("images/genero"), $imgName);

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
        $biblioteca = genero::find($id);
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
    public function edit(genero $biblioteca)
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
        $genero = genero::find($id);
        if ($genero == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        if ($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(), [
                'nombre'=>'required|string',
            ]);
        } else {
            $validator = Validator::make($request->json()->all(), [
                'nombre'=>'required|string',
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $genero->fill($request->json()->all());
        $genero->save();
        return response()->json($genero);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
        $persona = genero::find($id);
        if ($persona == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $persona->delete();
        return response()->json(['success' => true]);
    }
}
