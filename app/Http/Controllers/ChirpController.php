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
        // Valida que el usuario autenticado no es el que creo las tareas muestra un error
        $this->authorize('update',$chirp);

        return view('chirps.edit', [
            'chirp' => $chirp
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        $this->authorize('update',$chirp);


        //Asi se hacen las validaciones
        $validate = $request->validate([
            'task' => ['required', 'min:4', 'max:30'],
            'message' => ['required', 'min:3', 'max:150']
        ]);

        // Se validan de que esten bien y se actualiza
        $chirp->update($validate);

        // Retorna a la vista con un mensaje
        return to_route('chirps.index')
        ->with('status', __('Chirp update successfully'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return to_route('chirps.index')
        ->with('status', __('Chirp deleted successfully'));
    }
}
