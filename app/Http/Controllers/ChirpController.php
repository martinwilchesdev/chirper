<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Chirp;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        //El metodo with carga a cada usuario y los mensajes que tiene asociados
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // La validacion en Laravel es una herramienta poderosa que permite al usuario proveer un mensaje que no pueda exceder el maximo de 255 caracteres
        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        // Se crea un registro que pertenece al usuario logueado haciendo uso de la relacion chirps
        $request->user()->chirps()->create($validated);

        // Se devuelve una respuesta de redireccion para enviar al usuario de vuelta a la ruta `chirps.index`
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function edit(Chirp $chirp): View
    {
        // Laravel automaticamente carga el modelo Chirp de la base de datos para que este pueda ser pasado directamente a la vista
        // Validacion de que el usuario que accede a la ruta esta autorizado
        Gate::authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        // Validacion de que el usuario que accede a la ruta esta autorizado
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        // Se actualiza en el base de datos el mensaje validado previamente
        $chirp->update($validated);

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        //
    }
}
