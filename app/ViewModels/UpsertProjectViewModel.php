<?php
namespace App\ViewModels;

use App\Models\Project;

final class UpsertProjectViewModel extends ViewModel
{
    public function __construct(public ?Project $project = null) {}

    /**
     * Este metodo orquestra la informacion que se le enviara a la vista
     */
    public function formData(): array
    {
        if (!is_null($this->project))
        {
            return $this->updateFormData();
        }

        return $this->createFormData();
    }

    /**
     * Data necesaria en la vista[formulario] para crear un proyecto
     */
    protected function createFormData(): array
    {
        $project = new Project;
        $title = __('Crear proyecto');
        $textButton = __('Crear');
        $route = route('projects.store');
        return compact('title', 'textButton', 'route', 'project');
    }

    /**
     * Data necesaria en la vista[formulario] para actualizar un proyecto
     */
    protected function updateFormData(): array
    {
        $project = $this->project;
        $update = true;
        $title = __('Editar proyecto');
        $textButton = __('Actualizar');
        $route = route('projects.update', ['project' => $this->project]);
        return compact('project', 'update', 'title', 'textButton', 'route');
    }
}
