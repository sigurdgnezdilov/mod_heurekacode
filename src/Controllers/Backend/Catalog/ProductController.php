<?php

namespace Sigurd\mod_heurekacode\Controllers\Backend\Catalog; // <= zmena namespace pro balicek

use Sigurd\mod_heurekacode\Models\Catalog\Repositories\ProductRepository; // <= zmena namespace pro balicek
use App\Http\Controllers\Backend\Catalog\ProductController as parentController; // <= Aby se nemuseli psat vsechny metody kontroleru
use App\Models\Catalog\Requests\CreateProductRequest;
use Illuminate\Http\Request;

class ProductController extends parentController
{

    /**
     * @var ProductRepositoryInterface
     */
    private $repo;


    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepository $repo)
    {

        parent::__construct($repo);
        $this->repo = $repo;

    }


    /**
     * Zpracování formuláře pro editaci.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $model = $this->repo->findOneOrFail($id);
        $update = new ProductRepository($model);
        $update->update($request->except('_method'));

        session()->flash('message', \Lang::get('notifications.edited'));
        session()->flash('messageType', 'success');
        return redirect()->route($this->getPath().'.edit', $id);
    }

    /**
     * Zpracování formuláře pro vytvoření.
     *
     * @param  CreateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $model = $this->repo->create($request->except('_method'));
        session()->flash('message', \Lang::get('notifications.created'));
        session()->flash('messageType', 'success');
        return redirect()->route($this->getPath().'.edit', $model->id);
    }


}
