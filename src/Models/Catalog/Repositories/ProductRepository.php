<?php
namespace Sigurd\mod_heurekacode\Models\Catalog\Repositories;

use App\Models\Catalog\Repositories\ProductRepository as parentRepository;

use Sigurd\mod_heurekacode\Models\Catalog\Product;
use App\Models\Catalog\ProductDetail;

use App\Models\Catalog\Transformations\ProductTransformable;
use App\Models\General\Lang;
use App\Models\PM\Image;
use App\Models\PM\PmString;
use App\Models\PM\Seo;
use App\Models\PM\Slug;
use App\Models\Base\Exceptions\BaseInvalidArgumentException;


use Illuminate\Database\QueryException;


class ProductRepository extends parentRepository
{

    use ProductTransformable;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }
    public function create(array $params)
    {
        try {

            $data = collect($params);

            /**
             * Vytvoření
             */
            $model = new Product;
            $model->parent_id = $data->get('parent_id');
            $model->category_id = $data->get('category_id');
            $model->manufacturer_id = $data->get('manufacturer_id');
            $model->supplier_id = $data->get('supplier_id');
            $model->tax_id = 1;
            $model->active = (int)$data->get('active');
            $model->type = (int)$data->get('type');
            $model->sku = NULL;
            $model->ean = NULL;

            $model->customizable = 1;
            $model->position = 0;
            $model->save();

            /** HEUREKA KOD **/
            $code = PmString::where('catalog_id' , $model->id)->where('catalog_type' , $this->alias)->first();
            if (is_null($code))
                $code = new PmString;
            $code->catalog_id = $model->id;
            $code->catalog_type = $this->alias;
            $code->value = (string)$data->get('codeheureka');
            $code->columnName = 'heureka';
            $code->save();

            /**
             * Přiřazení detailu(popisu)
             */
            foreach (Lang::all() as $element) { // Jazykové verze

                $detail = new ProductDetail;
                $detail->Product_id = $model->id;
                $detail->name = (string)$data->get('name_'.$element->id);
                $detail->description = (string)$data->get('description_'.$element->id);
                $detail->lang_id = $element->id;
                $detail->save();
            }


            /**
             * Přiřazení SEO
             */
            foreach (Lang::all() as $element) { // Jazykové verze

                $seo = new Seo;
                $seo->catalog_id = $model->id;
                $seo->catalog_type = Product::class;
                $seo->description = $data->get('seo_description_'.$element->id);
                $seo->keywords = $data->get('seo_keywords_'.$element->id);
                $seo->title = $data->get('seo_title_'.$element->id);
                $seo->lang_id = $element->id;
                $seo->save();
            }

            /**
             * Přiřazení obrázku
             */
            if (!empty($data->get('logo'))) {

                /* Upload obrázku a tvorba náhledů */
                $imageName = str_random(25).'.'.$data->get('logo')->extension();
                $this->makeThumb($model->id, 'products', $data->get('logo'), $imageName, 90, 90); // 90x90
                $this->makeThumb($model->id, 'products', $data->get('logo'), $imageName, 200, 200); // 200x200
                $this->makeThumb($model->id, 'products', $data->get('logo'), $imageName, 600, 600); // 600x600
                $this->makeThumb($model->id, 'products', $data->get('logo'), $imageName); // original

                /**
                 * Přiřazení obrázku
                 */
                $image = new Image;
                $image->catalog_id = $model->id;
                $image->catalog_type = Product::class;
                $image->path = $imageName;
                $image->alt = $data->get('name_1');
                $image->save();
            }

            /**
             * Přiřazení URL
             */
            $newSlug = $this->makeSlug($data->get('name_1'));

            $slug = new Slug;
            $slug->catalog_id = $model->id;
            $slug->catalog_type = Product::class;
            $slug->slug = $newSlug;
            $slug->save();

            return $model;

        } catch (QueryException $e) {
            throw new BaseInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    /**
     * Upravit
     *
     * @param array $params
     * @return bool
     */
    public function updateProduct(array $params)
    {
        try {

            $data = collect($params);

            $model = $this->findOneOrFail($this->model->id);

            /**
             * Vložení do db
             */
            $model->category_id = $data->get('category_id');
            $model->manufacturer_id = $data->get('manufacturer_id') > 0 ? $data->get('manufacturer_id') : null;
            $model->active = (int)$data->get('active');
            $model->type = (int)$data->get('type');
            $model->save();
            
            /** HEUREKA KOD **/
            $code = PmString::where('catalog_id' , $model->id)->where('catalog_type' , $this->alias)->first();
            if (is_null($code))
                $code = new PmString;
            $code->catalog_id = $model->id;
            $code->catalog_type = $this->alias;
            $code->value = (string)$data->get('codeheureka');
            $code->columnName = 'heureka';
            $code->save();



            /**
             * Přiřazení detailu(popisu)
             */
            foreach (Lang::all() as $element) { // Jazykové verze

                $detail = $model->detail()->where('lang_id', $element->id)->first();
                if (is_null($detail)) {
                    $detail = new ProductDetail;
                }
                $detail->product_id = $model->id;
                $detail->name = (string)$data->get('name_' . $element->id);
                $detail->description = (string)$data->get('description_' . $element->id);
                $detail->lang_id = $element->id;
                $detail->save();
            }


            /**
             * Přiřazení SEO
             */
            foreach (Lang::all() as $element) { // Jazykové verze

                $seo = $model->seo()->where('lang_id', $element->id)->first();
                if (is_null($seo)) {
                    $seo = new Seo;
                }
                $seo->catalog_id = $model->id;
                $seo->catalog_type = Product::class;
                $seo->description = $data->get('seo_description_' . $element->id);
                $seo->keywords = $data->get('seo_keywords_' . $element->id);
                $seo->title = $data->get('seo_title_' . $element->id);
                $seo->lang_id = $element->id;
                $seo->save();
            }


            // if (!empty($data->get('logo'))) {
            //
            //   /**
            //   * Odebrání původního obrázku
            //   */
            //   $this->deleteImage($this->model->id, Product::class, 'products');
            //
            //   $this->createImage($data->get('logo'), $data->get('name'), $this->model->id, Product::class, 'products');
            //
            // }

            /**
             * Přiřazení skladů
             */
            if ($data->has('stores')) {
                $stores = array();
                foreach ($data->get('stores') as $store => $quantity) {
                    if ($quantity > 0) {
                        $stores[$store] = array('quantity' => $quantity);
                    }
                }
                $model->stores()->sync($stores);
            } else {
                $model->stores()->detach();
            }

            /**
             * Přiřazení cen
             */
            $prices = array();

            /* Nákupní ceny */
            if ($data->has('original_prices')) {
                foreach ($data->get('original_prices') as $price_group => $price) {
                    if ($price > 0) {
                        $prices[$price_group]['original_price'] = $price;
                    }
                }
            }
            /* Prodejní ceny */
            if ($data->has('prices')) {
                foreach ($data->get('prices') as $price_group => $price) {
                    if ($price > 0) {
                        $prices[$price_group]['price'] = $price;
                    }
                }
            }
            /* Akční ceny */
            if ($data->has('sale_prices')) {
                foreach ($data->get('sale_prices') as $price_group => $price) {
                    if ($price > 0) {
                        $prices[$price_group]['sale_price'] = $price;
                    }
                }
            }

            /* Synchronizace cen */
            if (!empty($prices)) {
                $model->prices()->sync($prices);
            } else {
                $model->prices()->detach();
            }

            /**
             * Přiřazení štítků
             */
            $tags = $data->get('tags');
            if (!empty($tags)) {
                $model->tags()->sync($tags);
            } else {
                $model->tags()->detach();
            }


        } catch (QueryException $e) {
            throw new BaseInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

}