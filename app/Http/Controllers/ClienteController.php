<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Cliente::all()], 201);
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
                'email' => 'required|email|unique:clientes,email',
                'phone' => 'required|string',
                'birthdate' => 'required|date',
                'address' => 'required|string',
                'complement' => 'string',
                'neighborhood' => 'required|string',
                'postal_code' => 'required|string'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $cliente = new Cliente();
        $cliente->name = $validatedData['name'];
        $cliente->email = $validatedData['email'];
        $cliente->phone = $validatedData['phone'];
        $cliente->birthdate = $validatedData['birthdate'];
        $cliente->address = $validatedData['address'];
        $cliente->complement = $validatedData['complement'];
        $cliente->neighborhood = $validatedData['neighborhood'];
        $cliente->postal_code = $validatedData['postal_code'];
        $cliente->save();

        return response()->json(['message' => 'Cliente created successfully', 'data' => $cliente], 201);
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
            $cliente = Cliente::findOrFail($id);

            return response()->json(['data' => $cliente], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Cliente not found'], 404);
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
            $cliente = Cliente::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Cliente not found'], 404);
        }

        try {
            $validatedData = $request->validate([
                'name' => 'string',
                'email' => 'email',
                'phone' => 'string',
                'birthdate' => 'date',
                'address' => 'string',
                'complement' => 'string',
                'neighborhood' => 'string',
                'postal_code' => 'string'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $cliente->fill($validatedData);
        $cliente->save();

        return response()->json(['message' => 'Cliente updated successfully', 'data' => $cliente], 200);
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
            $cliente = Cliente::findOrFail($id);

            $cliente->delete();

            return response()->json(['message' => 'Cliente deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Cliente not found'], 404);
        }
    }
}
