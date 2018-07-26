<?php

namespace Sigurd\mod_heurekacode\Models\Catalog;


use App\Models\Base\Interfaces\SluggableInterface ;
use App\Models\Catalog\Product as parentModel;

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
