<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public static function getSales( $banner ) {
    	
    	$json = file_get_contents('files/'. $banner .'.json');
    	return( $json );

    }

    public static function saveSales( $banner , $file) {
        
        // die(var_dump($file));
    	file_put_contents("/public/files/".$banner.".json", json_encode($file); 
        return;   	
    }

}
