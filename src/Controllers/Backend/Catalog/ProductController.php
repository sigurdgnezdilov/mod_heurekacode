<?php

namespace Sigurd\mod_heurekacode\Controllers\Backend\Catalog;

use Sigurd\mod_heurekacode\Models\Catalog\Repositories\ProductRepository;
use App\Http\Controllers\Backend\Catalog\ProductController as parentController;


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


}
