<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //Asi se hacen las validaciones
        $request->validate([
            'message' => ['required', 'min:3', 'max:16']
        ]);

        // Arriba se llama el modelo Chirp para luego utilizarlo junto ala funcion 
        // create la cual inserta los datos mostrados y el message que viene del 
        // formulario.
        Chirp::create([
            'message' => $request->get('message'),
            'user_id' => auth()->id(),
        ]);

        session()->flash('status', __('Chirp created successfully'));

        // Redirecciona una vez se inserte los datos en la base de datos
        return to_route('chirps.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
