<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    /**
     * @var string
     * p.e. 'products'
     */
    protected string $resource;

    /**
     * @var string
     * p.e. ProductRequest::class
     */
    protected string $formRequest;

    /**
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;


    /**
     * @var string
     * p.e. 'Product stored successfully.'
     */
    protected string $messageStored;

    /**
     * @var string
     * p.e. 'Product updated successfully.'
     */
    protected string $messageUpdated;

    /**
     * @var string
     * p.e. 'Product deleted successfully.'
     */
    protected string $messageDeleted;

    abstract protected function formCreateMetaData(): array;
    abstract protected function formUpdateMetaData(): array;

    public function index(): View
    {
        return view($this->resource . '.index')->with([
           $this->resource => $this->repository->paginated()
        ]);
    }

    public function create(Request $request): View
    {
        $metaData = $this->formCreateMetaData();
        return view($this->resource . '.create')->with($metaData);
    }

    public function store(int $id): RedirectResponse
    {
        app($this->formRequest); // execute the form request
        $this->repository->create();
        return redirect()->route($this->resource . '.index')->with('success', __($this->messageStored));
    }

    public function edit(): View
    {
        $metaData = $this->formUpdateMetaData();
        return view($this->resource . '.edit')->with($metaData);
    }

    public function update(int $id): RedirectResponse
    {
        app($this->formRequest); // execute the form request
        $this->repository->update($id);
        return redirect()->route($this->resource . '.index')->with('success', __($this->messageUpdated));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->repository->delete($id);
        return redirect()->route($this->resource . '.index')->with('success', __($this->messageDeleted));
    }
}
