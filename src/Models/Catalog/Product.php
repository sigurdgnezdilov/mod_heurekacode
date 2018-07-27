<?php

namespace Sigurd\mod_heurekacode\Models\Catalog; // <= zmena namespace pro balicek

use App\Models\Catalog\Product as parentModel; // <= Aby se nemuseli psat vsechny metody modelu
use App\Models\Base\Interfaces\SluggableInterface ;
class Product extends parentModel implements SluggableInterface
{
    public function CodeHeureka(){
        $return =  $this->morphMany('App\Models\PM\PmString', 'catalog')->where('columnName', 'heureka');
        return $return;
    }

    public function getCodeHeurekaAttribute(){
        $return =$this->CodeHeureka()->first()['value'];
        return $return;
    }
}
