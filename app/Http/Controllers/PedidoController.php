<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Pedido::all()], 201);
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
                'cliente_id' => 'required|required|exists:clientes,id,deleted_at,NULL',
                'produto_id' => 'required|required|exists:produtos,id,deleted_at,NULL',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $pedido = new Pedido();
        $pedido->cliente_id = $validatedData['cliente_id'];
        $pedido->produto_id = $validatedData['produto_id'];
        $pedido->save();

        return response()->json(['message' => 'Pedido created successfully', 'data' => $pedido], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);

            return response()->json(['data' => $pedido], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Pedido not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Pedido not found'], 404);
        }

        try {
            $validatedData = $request->validate([
                'cliente_id' => 'exists:clientes,id,deleted_at,NULL',
                'produto_id' => 'exists:produtos,id,deleted_at,NULL',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $pedido->fill($validatedData);
        $pedido->save();

        return response()->json(['message' => 'Pedido updated successfully', 'data' => $pedido], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);

            $pedido->delete();

            return response()->json(['message' => 'Pedido deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Pedido not found'], 404);
        }
    }
}
