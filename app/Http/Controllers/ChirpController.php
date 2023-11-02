<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //Aqui estamos mostrando la vista index dentro de la carpeta Chirps, luego creamos un array donde accedemos al modelo y traemos todos los datos para mostralos en esta vista.
    public function index()
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);

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
            'task' => ['required', 'min:4', 'max:30'],
            'message' => ['required', 'min:3', 'max:150']
        ]);


        // Acceder al usuario AUTENTICADO, luego accerder a la relacion con sus CHIRPS y crear una tarea con los valores resividos.
        auth()->user()->chirps()->create([
            'task' => $request->get('task'),
            'message' => $request->get('message'),
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
        return view('chirps.edit', [
            'chirp' => $chirp
        ]);

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
