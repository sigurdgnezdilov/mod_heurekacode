<?php

namespace Sigurd\mod_heurekacode\Controllers\Backend\Catalog;

use Sigurd\mod_heurekacode\Models\Catalog\Repositories\ProductRepository;
use App\Models\Catalog\Repositories\AttributeRepository;

use App\Models\Catalog\Requests\CreateProductRequest;
use App\Models\Catalog\Requests\CreateAttributeRequest;




use Sigurd\mod_heurekacode\Models\Catalog\Product;
use App\Models\Catalog\Attribute;
use App\Http\Controllers\Backend\Base\BaseController;
use Illuminate\Http\Request;

class ProductController extends BaseController
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
     * Systémový název
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingleName()
    {
        return "produkt";
    }

    /**
     * Systémový název 4. pád
     *
     * @return \Illuminate\Http\Response
     */
    public function getSingle4Name()
    {
        return "produkt";
    }


    /**
     * Zobrazení výpisu
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->repo->listProducts($request->toArray());

        $list = $list->map(function (Product $item) {
            return $item;
        })->all();

        return view($this->viewPath, [
            'list' => $this->repo->paginateArrayResults($list, $request->perPage ? $request->perPage : 50)
        ]);
    }

    /**
     * Zobrazení formuláře pro vytvoření.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->viewPath);
    }


    /**
     * Zpracování formuláře pro vytvoření.
     *
     * @param  CreateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $model = $this->repo->createProduct($request->except('_method'));
        session()->flash('message', \Lang::get('notifications.created'));
        session()->flash('messageType', 'success');
        return redirect()->route($this->getPath().'.edit', $model->id);
    }



    /**
     * Zobrazení karty.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {

      // $list = $this->repo->listSubCategories($id);
      // $list = $list->map(function (Product $item) {
      //     return $item;
      // })->all();
      //
      // return view($this->viewPath, [
      //     'item' => $this->repo->findOneOrFail($id),
      //     'list' => $this->repo->paginateArrayResults($list)
      // ]);
    }



    /**
     * Zobrazení formuláře pro editaci.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->viewPath, ['item' => $this->repo->findOneOrFail($id)]);
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
        $update->updateProduct($request->except('_method'));

        session()->flash('message', \Lang::get('notifications.edited'));
        session()->flash('messageType', 'success');
        return redirect()->route($this->getPath().'.edit', $id);
    }



    /**
     * Smazání.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->repo->delete($id);

        session()->flash('message', \Lang::get('notifications.deleted'));
        session()->flash('messageType', 'success');

        return redirect()->route($this->getPath().'.list');
    }


    /**
     * Přidání varianty
     *
     * @return \Illuminate\Http\Response
     */
    public function addVariant(Request $request)
    {

      $this->repo->createVariant($request->id, $request->data);

      return view('backend.catalog.products.components.variants', ['item' => $this->repo->findOneOrFail($request->id)]);

    }

    /**
     * Odebrání varianty
     *
     * @return \Illuminate\Http\Response
     */
    public function removeVariant(Request $request)
    {

      $this->repo->deleteVariant($request->id);

      return view('backend.catalog.products.components.variants', ['item' => $this->repo->findOneOrFail($request->parent_id)]);

    }

    /**
     * Přidání souvisejícího produktu
     *
     * @return \Illuminate\Http\Response
     */
    public function addRelated(Request $request)
    {

      $this->repo->addRelated($request->id, $request->related_id);

      return view('backend.catalog.products.components.relateds', ['item' => $this->repo->findOneOrFail($request->id)]);

    }

    /**
     * Odebrání souvisejícího produktu
     *
     * @return \Illuminate\Http\Response
     */
    public function removeRelated(Request $request)
    {

      $this->repo->removeRelated($request->id, $request->related_id);

      return view('backend.catalog.products.components.relateds', ['item' => $this->repo->findOneOrFail($request->id)]);

    }

    /**
     * Přidání atributu produktu
     *
     * @return \Illuminate\Http\Response
     */
    public function addAttribute(CreateAttributeRequest $request)
    {

      $attributeRepo = new AttributeRepository(new Attribute);
      $attributeId = $attributeRepo->createAttribute($request->except('_method'));

      $this->repo->attachAttribute($request->id, $attributeId);

      return view('backend.catalog.products.components.attributes', ['item' => $this->repo->findOneOrFail($request->id)]);

    }

    /**
     * Odebrání atributu produktu
     *
     * @return \Illuminate\Http\Response
     */
    public function removeAttribute(Request $request)
    {

      $this->repo->detachAttribute($request->parent_id, $request->id);
      return view('backend.catalog.products.components.attributes', ['item' => $this->repo->findOneOrFail($request->parent_id)]);

    }
}
