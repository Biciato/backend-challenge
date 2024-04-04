<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Produto::all()], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
                'thumb' => 'required|url',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $produto = new Produto();
        $produto->name = $validatedData['name'];
        $produto->price = $validatedData['price'];
        $produto->thumb = $validatedData['thumb'];
        $produto->save();

        return response()->json(['message' => 'Produto created successfully', 'data' => $produto], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $produto = Produto::findOrFail($id);

            return response()->json(['data' => $produto], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Produto not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $produto = Produto::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Produto not found'], 404);
        }

        try {
            $validatedData = $request->validate([
                'name' => 'string',
                'price' => 'numeric',
                'thumb' => 'url',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $produto->fill($validatedData);
        $produto->save();

        return response()->json(['message' => 'Produto updated successfully', 'data' => $produto], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $produto = Produto::findOrFail($id);

            $produto->delete();

            return response()->json(['message' => 'Produto deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Produto not found'], 404);
        }
    }
}
