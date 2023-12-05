<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\ViewModels\UpsertProjectViewModel;
use Illuminate\Http\Request;

final class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // El view model contiene toda la informacion que necesita la vista.
        // En este caso, el formulario para crear un proyecto.
        // Necesita el titulo, el texto del boton, y la ruta que procesara el formulario para guardar el proyecto
        $viewModel = new UpsertProjectViewModel;
        return view("projects.create", $viewModel->toArray()['form_data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $viewModel = new UpsertProjectViewModel($project);
        return view("projects.edit", $viewModel->toArray()['form_data']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
