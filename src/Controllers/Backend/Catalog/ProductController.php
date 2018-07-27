<?php

namespace Sigurd\mod_heurekacode\Controllers\Backend\Catalog; // <= zmena namespace pro balicek

use Sigurd\mod_heurekacode\Models\Catalog\Repositories\ProductRepository; // <= zmena namespace pro balicek
use App\Http\Controllers\Backend\Catalog\ProductController as parentController; // <= Aby se nemuseli psat vsechny metody kontroleru


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
