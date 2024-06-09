<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\BaseResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ResourceController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected const WITH_AUTHORIZATION = false;
    protected const MODEL_NAMESPACE = 'App\Models';
    protected BaseModel $model;

    protected string $viewFolderName;

    protected string $resourceLabel;

    protected string $resourceName;

    protected array $validations = [];

    public function __construct()
    {
        $this->model = $this->getModel();

        $this->viewFolderName = $this->viewFolderName ?? $this->model->getPlural();
        $this->resourceLabel = $this->resourceLabel ?? $this->model->getPlural(true);

        if (static::WITH_AUTHORIZATION) {
            $this->authorizeResource(class_basename($this->model));
        }
    }

    protected function getModel(): BaseModel 
    {
        $modelName = static::MODEL_NAMESPACE . '\\' . str_replace('Controller', '', class_basename(static::class));
        return new $modelName();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $models = $this->model
            ->when(
                $request->query('query'),
                fn (Builder $query) => $query->whereAny(
                    $this->model->getSearchFiels(), 'like', '%' . $request->query('query') . '%'
                    )
            )
            ->latest()
            ->latest('id')
            ->paginate()
            ->withQueryString();

        return inertia("$this->viewFolderName/Index", [
            //ex. employees
            $this->resourceLabel => $this->model->getResourceName()::collection($models),
            'query' => $request->query('query'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];

        foreach ($this->model->relations as $relation) {
            /** @var BaseModel $relation */
            $data[$relation->getPlural(true)] = fn() => $relation->getResourceName()::collection($relation->all());
        }

        return inertia("$this->viewFolderName/Create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validations);
        
        $model = $this->model->create($data);

        return redirect($model->showRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $modelId)
    {
        $model = $this->findResource($modelId);

        
        if (! Str::endsWith($model->showRoute(), $request->path())) {
            return redirect($model->showRoute($request->query()), status: 301);
        }

        if ($model->relations) {
            $model->load(...$model->relations);
        }
        
        return inertia("$this->viewFolderName/Show", [
            Str::singular($this->resourceLabel) => fn () => $this->model->getResourceName()::make($model),
        ]);
    }

    /**
     * Display the view to edit the specified resource.
     */
    public function edit($modelId)
    {
        $model = $this->findResource($modelId);

        if ($model->relations) {
            $model->load(...$model->relations);
        }
        
        return inertia("$this->viewFolderName/Edit", [
            Str::singular($this->resourceLabel) => fn () => $this->model->getResourceName()::make($model),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $modelId)
    {
        $data = $request->validate(array_intersect_key($this->validations, $request->all()));

        $model = $this->findResource($modelId);

        $model->update($data);

        return redirect($model->showRoute(['page' => $request->query('page')]))
            ->banner(class_basename(get_class($this->model)) . ' was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $modelId)
    {
        $this->findResource($modelId)->delete();
    
        return redirect(route($this->resourceLabel.'.index'))
            ->banner(class_basename(get_class($this->model)) . ' deleted.');
    }

    protected function findResource($modelId): BaseModel 
    {
        return $this->model->findOrFail($modelId);
    }
}
